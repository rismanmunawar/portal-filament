<x-filament::widget>
    <x-filament::card class="space-y-4">
        <h2 class="text-base font-semibold">📢 Latest Announcements</h2>

        @php
        $announcement = $this->getAnnouncements()->first();
        @endphp

        @if ($announcement)
        <div class="space-y-2 bg-gray-50 dark:bg-gray-900 p-4 rounded-lg shadow-sm">
            {{-- Badges --}}
            <div class="flex flex-wrap items-center gap-2 text-sm mb-2">
                {{-- Type Badge --}}
                @php
                $typeColors = [
                'info' => ['text' => 'text-blue-700', 'bg' => 'bg-blue-100', 'border' => 'border-blue-600'],
                'success' => ['text' => 'text-green-700', 'bg' => 'bg-green-100', 'border' => 'border-green-600'],
                'warning' => ['text' => 'text-amber-700', 'bg' => 'bg-amber-100', 'border' => 'border-amber-600'],
                'danger' => ['text' => 'text-red-700', 'bg' => 'bg-red-100', 'border' => 'border-red-600'],
                'default' => ['text' => 'text-zinc-700', 'bg' => 'bg-zinc-100', 'border' => 'border-zinc-600'],
                ];
                $type = $announcement->type ?? 'default';
                $color = $typeColors[$type] ?? $typeColors['default'];
                @endphp
                {{-- Category Badge --}}
                @if ($announcement->category?->name)
                <span class="px-2 py-0.5 text-xs font-semibold rounded-full text-indigo-700 bg-indigo-100 border border-indigo-600">
                    {{ $announcement->category->name }}
                </span>
                @endif


            </div>
            {{-- Judul --}}
            <div class="text-sm font-semibold">{{ $announcement->title }}</div>

            {{-- Konten --}}
            <div class="text-sm prose dark:prose-invert max-w-none">
                {!! $announcement->content !!}
            </div>
            <div class="flex flex-wrap items-center gap-2 text-sm mb-2">
                {{-- Attachment Badge --}}
                @if ($announcement->attachment_path)
                @php
                $ext = pathinfo($announcement->attachment_path, PATHINFO_EXTENSION);
                $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                @endphp
                <a
                    href="{{ Storage::url($announcement->attachment_path) }}"
                    class="flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-full text-zinc-700 bg-zinc-100 border border-zinc-600"
                    target="_blank"
                    @if(!$isImage) download @endif>
                    📎 <span>{{ $isImage ? 'Lihat Gambar' : 'Lampiran' }}</span>
                </a>
                @endif
            </div>
            {{-- Footer Info --}}
            <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                Oleh {{ $announcement->author->name ?? '-' }} <br>
                {{ $announcement->starts_at?->format('d M Y H:i') }}
            </div>
        </div>
        </div>
        @else
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Tidak ada pengumuman aktif saat ini.
        </div>
        @endif
    </x-filament::card>
</x-filament::widget>