<x-filament::page>
    <div class="space-y-6">

        {{-- Search & Filter --}}
        <div class="flex flex-wrap gap-4 items-center">
            {{-- Search --}}
            <input
                wire:model.live="search"
                type="text"
                placeholder="Cari judul atau isi..."
                class="text-sm rounded-md border-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:text-white w-64">
        </div>

        {{-- Announcements --}}
        @php $announcements = $this->getAnnouncements(); @endphp

        @forelse ($announcements as $announcement)
        @php
        $badgeColors = [
        'info' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
        'success' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
        'warning' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
        'danger' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
        ];

        $typeColor = $badgeColors[$announcement->type] ?? 'bg-gray-100 text-gray-800';
        $categoryName = $announcement->category->name ?? 'Tanpa Kategori';
        $authorName = $announcement->author->name ?? '-';
        @endphp

        <x-filament::card class="space-y-4">
            {{-- Header --}}
            <div class="flex items-center justify-between flex-wrap gap-2">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-medium px-2 py-1 rounded-full {{ $typeColor }} border border-indigo-400">
                        {{ ucfirst($announcement->type) }}
                    </span>

                    <span class="text-xs font-medium px-2 py-1 rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200 border border-indigo-400">
                        {{ $categoryName }}
                    </span>

                    {{-- Tampilkan badge Baru hanya untuk item pertama --}}
                    @if ($loop->first)
                    <span class="text-xs font-medium px-2 py-1 rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                        Baru
                    </span>
                    @endif
                </div>

                @if ($announcement->is_pinned)
                <span class="text-sm text-yellow-500 font-medium flex items-center gap-1">
                    📌 <span>Pinned</span>
                </span>
                @endif
            </div>

            {{-- Title --}}
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ $announcement->title }}
            </h3>

            {{-- Content --}}
            <div class="prose dark:prose-invert max-w-none text-sm">
                {!! $announcement->content !!}
            </div>

            {{-- Attachment --}}
            @if ($announcement->attachment_path)
            <a href="{{ Storage::url($announcement->attachment_path) }}"
                target="_blank"
                class="inline-flex items-center gap-1 text-sm text-primary-600 hover:underline dark:text-primary-400">
                📎 <span>Lihat Lampiran</span>
            </a>
            @endif

            {{-- Footer --}}
            <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                Oleh <strong>{{ $authorName }}</strong> •
                Tayang: {{ $announcement->starts_at?->format('d M Y') ?? '-' }}
                @if ($announcement->ends_at)
                s/d {{ $announcement->ends_at->format('d M Y') }}
                @endif
            </div>
        </x-filament::card>
        @empty
        <div class="text-center text-gray-500 dark:text-gray-400 text-sm py-10">
            Tidak ada pengumuman yang cocok.
        </div>
        @endforelse

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $announcements->links() }}
        </div>

    </div>
</x-filament::page>