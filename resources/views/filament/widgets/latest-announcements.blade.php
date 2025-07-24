<x-filament::widget>
    <x-filament::card>
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Latest IT Info & Updates</h2>
        </div>
        <div class="space-y-4">
            @foreach ($this->getAnnouncements() as $announcement)
            <div class="group rounded-lg p-4 border transition 
            border-gray-200 dark:border-gray-700 
            bg-white dark:bg-gray-800 
            text-gray-800 dark:text-gray-200 
            hover:bg-gray-100 dark:hover:bg-gray-700">
                <h3 class="text-sm font-semibold text-green-700 dark:text-green-400 
                               group-hover:text-green-900 dark:group-hover:text-green-200 transition">
                    {{ $announcement->title }}
                </h3>

                <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">
                    {{ $announcement->created_at->format('n/j/Y') }}
                </div>

                <div class="text-sm text-gray-700 dark:text-gray-200 line-clamp-3">
                    {{ \Illuminate\Support\Str::limit(strip_tags($announcement->content), 200) }}
                </div>
            </div>
            @endforeach
        </div>
    </x-filament::card>
</x-filament::widget>