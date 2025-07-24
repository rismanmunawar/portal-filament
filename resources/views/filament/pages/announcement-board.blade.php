<x-filament::page>
    <div class="space-y-6">
        <div class="flex justify-between items-center mb-4">
            <input
                type="text"
                wire:model.live="search"
                placeholder="Search announcements..."
                class="w-full max-w-md border border-gray-300 dark:border-gray-600 rounded-md px-4 py-2 text-sm bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" />
        </div>


        @forelse ($this->announcements as $announcement)
        <div class="border rounded-lg p-4 border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $announcement->title }}</h2>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                By {{ $announcement->user->name }} –
                {{ $announcement->created_at->diffForHumans() }}
                <span class="text-xs">({{ $announcement->created_at->translatedFormat('d F Y, H:i') }})</span>
            </div>
            <div class="mt-2 text-sm text-gray-700 dark:text-white">
                {!! $announcement->content !!}
            </div>


            @if ($announcement->attachment_path)
            <div class="mt-2 text-sm text-gray-500">
                📎 <a
                    href="{{ Storage::url($announcement->attachment_path) }}"
                    class="text-blue-600 hover:text-blue-800 underline"
                    target="_blank"
                    download>
                    Download Lampiran
                </a>
            </div>
            @endif


            <div class="mt-4 space-y-2">
                <h3 class="font-semibold text-sm text-gray-600 dark:text-gray-400">Comments</h3>
                @forelse ($announcement->comments as $comment)
                <div class="text-sm bg-gray-100 dark:bg-gray-800 dark:text-gray-200 rounded p-2">
                    <strong>{{ $comment->user->name }}</strong>: {{ $comment->comment }}
                </div>
                @empty
                <div class="text-sm text-gray-400 dark:text-gray-500">No comments yet.</div>
                @endforelse
            </div>

            <form wire:submit.prevent="addComment({{ $announcement->id }})" class="mt-4">
                <textarea
                    wire:model.defer="newComments.{{ $announcement->id }}"
                    class="w-full p-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 text-sm"
                    rows="3"
                    placeholder="Write a comment..."></textarea>

                <x-filament::button type="submit" class="mt-2">Comments</x-filament::button>
            </form>
        </div>
        @empty
        <div class="text-sm text-gray-500 dark:text-gray-400">
            No announcements found.
        </div>
        @endforelse

        <div class="mt-6">
            {{ $this->announcements->links() }}
        </div>
    </div>
</x-filament::page>