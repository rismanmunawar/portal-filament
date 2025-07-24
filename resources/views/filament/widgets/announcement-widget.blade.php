<x-filament::page>
    {{-- Widget pengumuman --}}
    <x-filament::grid :columns="['md' => 3]" class="mb-6">
        <x-filament::grid.column span="md:4">
            <livewire:filament.widgets.latest-announcements />
        </x-filament::grid.column>

        {{-- Komentar --}}
        <x-filament::grid.column span="md:8">
            <div class="bg-white shadow rounded-xl p-6">
                <h3 class="text-lg font-bold mb-4">Comments & Replies</h3>

                {{-- Form komentar --}}
                <form wire:submit.prevent="postComment">
                    <textarea wire:model.defer="newComment" class="w-full border rounded p-2" rows="3" placeholder="Write your comment..."></textarea>
                    <x-filament::button type="submit" class="mt-2">Post Comment</x-filament::button>
                </form>

                {{-- List komentar --}}
                <div class="mt-6 space-y-4">
                    @foreach ($comments as $comment)
                    <div class="border p-3 rounded bg-gray-50">
                        <div class="text-sm font-semibold">{{ $comment->user->name }}</div>
                        <div class="text-sm text-gray-600">{{ $comment->created_at->diffForHumans() }}</div>
                        <div class="mt-1 text-sm">{{ $comment->content }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </x-filament::grid.column>
    </x-filament::grid>
</x-filament::page>