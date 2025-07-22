<x-filament::page>
    <div x-data="{ tab: 'category' }" class="space-y-4">

        <!-- Tabs Header -->
        <div class="flex space-x-2 border-b">
            <button @click="tab = 'category'" :class="{ 'border-b-2 border-primary-500': tab === 'category' }" class="px-4 py-2">Category</button>
            <button @click="tab = 'subcategory'" :class="{ 'border-b-2 border-primary-500': tab === 'subcategory' }" class="px-4 py-2">Sub Category</button>
            <button @click="tab = 'subsubcategory'" :class="{ 'border-b-2 border-primary-500': tab === 'subsubcategory' }" class="px-4 py-2">Sub Sub Category</button>
            <button @click="tab = 'topic'" :class="{ 'border-b-2 border-primary-500': tab === 'topic' }" class="px-4 py-2">Topic</button>
        </div>

        <!-- Tabs Content -->
        <div x-show="tab === 'category'">
            @livewire(\App\Filament\Resources\Docs\DocsCategoryResource\Pages\ListDocsCategories::class)
        </div>

        <div x-show="tab === 'subcategory'" x-cloak>
            @livewire(\App\Filament\Resources\Docs\DocsSubCategoryResource\Pages\ListDocsSubCategories::class)
        </div>

        <div x-show="tab === 'subsubcategory'" x-cloak>
            @livewire(\App\Filament\Resources\Docs\DocsSubSubCategoryResource\Pages\ListDocsSubSubCategories::class)
        </div>

        <div x-show="tab === 'topic'" x-cloak>
            @livewire(\App\Filament\Resources\Docs\DocsTopicResource\Pages\ListDocsTopics::class)
        </div>

    </div>
</x-filament::page>