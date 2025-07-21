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
    protected static ?string $navigationLabel = 'Upload Monitoring';
    protected static ?string $title = 'Upload Monitoring Data';
    protected static ?string $navigationGroup = 'Monitoring';

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

        $path = $data['file'];
        $file = Storage::disk('local')->path($path);

        MonitorZndsu::truncate();

        $import = new MonitoringImport();
        Excel::import($import, $file);

        $sheet = $import->rows;
        $user = Auth::user();
        $uploadedAt = $data['uploaded_at'];

        $dateColumns = $sheet->first()?->keys()?->filter(fn($key) => preg_match('/^\d{2}$/', $key)) ?? [];

        foreach ($sheet as $row) {
            $plant = trim(strtoupper($row['plants'] ?? ''));
            $name = $row['plant_name'] ?? null;

            if (!$plant || !$name) {
                continue;
            }

            $dataDist = DataDist::whereRaw('UPPER(TRIM(plant)) = ?', [$plant])->first();

            $rowData = [
                'user_id'     => $user->id,
                'plant'       => $plant,
                'name_dist'   => $name,
                'rom_id'      => $dataDist->rom_id ?? null,
                'nom_id'      => $dataDist->nom_id ?? null,
                'it_id'       => $dataDist->it_id ?? null,
                'uploaded_at' => $uploadedAt,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];

            $hasError = false;

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

            MonitorZndsu::create($rowData);
        }

        Notification::make()
            ->title('Upload Berhasil')
            ->body('Data berhasil diupload dan disimpan.')
            ->success()
            ->send();
    }
}
