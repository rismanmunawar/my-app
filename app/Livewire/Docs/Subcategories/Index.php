<?php

namespace App\Livewire\Docs\Subcategories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Docs\Subcategory;
use App\Models\Docs\Category;

class Index extends Component
{
    use WithPagination;

    public $name;
    public $category_id;
    public $subcategoryIdBeingEdited = null;
    public $isEditing = false;
    public $search = '';

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $subcategories = Subcategory::with('category')
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate(10);

        $categories = Category::all();

        return view('livewire.docs.subcategories.index', compact('subcategories', 'categories'));
    }

    public function create()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:docs_categories,id',
        ]);

        Subcategory::create([
            'name' => $this->name,
            'category_id' => $this->category_id,
        ]);

        $this->reset(['name', 'category_id']);
        session()->flash('success', 'Subkategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $this->name = $subcategory->name;
        $this->category_id = $subcategory->category_id;
        $this->subcategoryIdBeingEdited = $id;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:docs_categories,id',
        ]);

        $subcategory = Subcategory::findOrFail($this->subcategoryIdBeingEdited);
        $subcategory->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
        ]);

        $this->resetForm();
        session()->flash('success', 'Subkategori diperbarui.');
    }

    public function delete($id)
    {
        Subcategory::destroy($id);
        session()->flash('success', 'Subkategori dihapus.');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset(['name', 'category_id', 'subcategoryIdBeingEdited', 'isEditing']);
    }
}
