<?php

namespace App\Livewire\Docs\Topics;

use App\Models\Docs\Category;
use App\Models\Docs\Subcategory;
use App\Models\Docs\Topic;
use Livewire\Component;

class Create extends Component
{
    public $title = '';
    public $content = '';
    public $video_url = '';
    public $category_id = '';
    public $subcategory_id = '';

    public $categories = [];
    public $subcategories = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category_id' => 'required|exists:docs_categories,id',
        'subcategory_id' => 'nullable|exists:docs_subcategories,id',
        'video_url' => 'nullable|url',
    ];

    public function mount()
    {
        $this->categories = Category::orderBy('name')->get();

        // Jika kategori sudah dipilih sebelumnya (misal saat edit reuse form), tampilkan subcategory
        if ($this->category_id) {
            $this->subcategories = Subcategory::where('category_id', $this->category_id)->orderBy('name')->get();
        } else {
            $this->subcategories = collect();
        }
    }


    public function updatedCategory_id($value)
    {
        $this->subcategory_id = '';
        $this->subcategories = Subcategory::where('category_id', $value)->orderBy('name')->get();
    }

    // mengubah '' menjadi null begitu user memilih kosong.
    public function updatedSubcategory_id($value)
    {
        $this->subcategory_id = $value ?: null;
    }

    public function store()
    {
        $this->validate();

        Topic::create([
            'title' => $this->title,
            'content' => $this->content,
            'video_url' => $this->video_url,
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id !== '' ? $this->subcategory_id : null,
        ]);

        $this->dispatch('topic-created');
    }

    public function render()
    {
        return view('livewire.docs.topics.create', [
            'categories' => $this->categories,
            'subcategories' => $this->subcategories,
        ]);
    }
}
