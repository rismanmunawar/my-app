<div class="tabs tabs-lift text-sm">
    {{-- Tab: Topics --}}
    <input type="radio" name="docs_tabs" class="tab !bg-white !text-black !border-gray-300" aria-label="Topics" checked />
    <div class="tab-content bg-white border border-gray-300 p-6 text-black">
        @livewire('docs.topics.index')
    </div>

    {{-- Tab: Categories --}}
    <input type="radio" name="docs_tabs" class="tab !bg-white !text-black !border-gray-300" aria-label="Categories" />
    <div class="tab-content bg-white border border-gray-300 p-6 text-black">
        @livewire('docs.categories.index')
    </div>

    {{-- Tab: Subcategories --}}
    <input type="radio" name="docs_tabs" class="tab !bg-white !text-black !border-gray-300"
        aria-label="Subcategories" />
    <div class="tab-content bg-white border border-gray-300 p-6 text-black">
        @livewire('docs.subcategories.index')
    </div>
</div>
