<?php

namespace App\Livewire\Docs\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Docs\Category as DocsCategory;

class Index extends Component
{
    use WithPagination;

    public $name;
    public $search = '';
    public $categoryIdBeingEdited = null;
    public $isEditing = false;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = DocsCategory::query()
            ->when($this->search, fn($query) =>
            $query->where('name', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate(10);

        return view('livewire.docs.categories.index', compact('categories'));
    }

    public function create()
    {
        $this->validate(['name' => 'required|string|max:255']);

        DocsCategory::create(['name' => $this->name]);
        $this->reset('name');
        $this->resetPage(); // resetPage() supaya pagination balik ke halaman 1 saat ada perubahan:
        session()->flash('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $category = DocsCategory::findOrFail($id);
        $this->name = $category->name;
        $this->categoryIdBeingEdited = $id;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate(['name' => 'required|string|max:255']);
        $category = DocsCategory::findOrFail($this->categoryIdBeingEdited);
        $category->update(['name' => $this->name]);

        $this->resetForm();
        session()->flash('success', 'Kategori berhasil diperbarui.');
    }

    public function delete($id)
    {
        DocsCategory::destroy($id);
        session()->flash('success', 'Kategori dihapus.');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset(['name', 'categoryIdBeingEdited', 'isEditing']);
    }
}
