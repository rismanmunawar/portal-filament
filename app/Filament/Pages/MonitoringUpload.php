<?php

namespace App\Filament\Pages;

use App\Imports\MonitoringImport;
use App\Models\Master\DataDist;
use App\Models\Monitor\MonitorZndsu;
use Filament\Forms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class MonitoringUpload extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';
    protected static string $view = 'filament.pages.monitoring-upload';
    protected static ?string $navigationLabel = 'Upload Data Monitoring';
    protected static ?string $title = 'Upload Data Monitoring';
    protected static ?string $navigationGroup = 'Data Monitoring';

    public $file;
    public $uploaded_at;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\FileUpload::make('file')
                ->label('Upload Excel File (.xls/.xlsx)')
                ->acceptedFileTypes([
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                ])
                ->required()
                ->disk('local'),

            Forms\Components\DatePicker::make('uploaded_at')
                ->default(now())
                ->required(),
        ];
    }

    public function mount(): void
    {
        $this->form->fill([
            'uploaded_at' => now(),
        ]);

        $this->uploaded_at = now()->toDateString();
    }

    public function submit()
    {
        $data = $this->form->getState();

        // Ambil path file yang sudah diupload
        $path = $data['file'];
        $file = Storage::disk('local')->path($path);

        // Kosongkan tabel monitoring sebelum upload baru
        MonitorZndsu::truncate();

        // Jalankan proses import Excel
        $import = new MonitoringImport();
        Excel::import($import, $file);

        $sheet = $import->rows;
        $user = Auth::user();
        $uploadedAt = $data['uploaded_at'];

        // Ambil kolom tanggal (01 - 31) dari header sheet
        $dateColumns = $sheet->first()?->keys()?->filter(fn($key) => preg_match('/^\d{2}$/', $key)) ?? [];

        foreach ($sheet as $row) {
            $plant = trim(strtoupper($row['plants'] ?? ''));
            $name = $row['plant_name'] ?? null;

            // Lewati baris kosong atau tidak valid
            if (!$plant || !$name) {
                continue;
            }

            // Cari data distribusi berdasarkan plant
            $dataDist = DataDist::whereRaw('UPPER(TRIM(plant)) = ?', [$plant])->first();

            $rowData = [
                'user_id'     => $user->id,
                'plant'       => $plant,
                'name_dist'   => $name,
                'rom_id'      => optional($dataDist)->rom_id,
                'nom_id'      => optional($dataDist)->nom_id,
                'it_id'       => optional($dataDist)->it_id,
                'uploaded_at' => $uploadedAt,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];

            $hasError = false;

            // Loop isi hari per bulan (01 - 31)
            foreach ($dateColumns as $day) {
                $raw = strtoupper(trim((string)($row[$day] ?? '')));

                $status = match (true) {
                    str_contains($raw, '@0V@') => 'done',
                    str_contains($raw, '@02@') => 'error',
                    str_contains($raw, '@3O@'), $raw === '' => 'libur',
                    default => 'libur',
                };

                if ($status === 'error') {
                    $hasError = true;
                }

                $dayKey = 'day_' . str_pad($day, 2, '0', STR_PAD_LEFT);
                $rowData[$dayKey] = $status;
            }

            $rowData['has_error'] = $hasError;

            // Simpan ke database
            MonitorZndsu::create($rowData);
        }

        // Notifikasi sukses
        Notification::make()
            ->title('Upload Berhasil')
            ->body('Data berhasil diupload dan disimpan.')
            ->success()
            ->send();
    }
}
