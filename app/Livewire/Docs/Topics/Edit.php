<?php

namespace App\Livewire\Docs\Topics;

use App\Models\Docs\Topic as DocsTopic;
use App\Models\Docs\Category;
use App\Models\Docs\Subcategory;
use Livewire\Component;

class Edit extends Component
{
    public $topicId;

    public $title;
    public $content;
    public $video_url;
    public $category_id;
    public $subcategory_id;

    public $categories = [];
    public $subcategories = [];

    public function mount($topicId)
    {

        $this->topicId = $topicId;

        $topic = DocsTopic::findOrFail($topicId);

        $this->title = $topic->title;
        $this->content = $topic->content;
        $this->video_url = $topic->video_url;
        $this->category_id = $topic->category_id;
        $this->subcategory_id = $topic->subcategory_id;

        $this->categories = Category::all();
        $this->loadSubcategories();
    }

    public function updatedCategoryId()
    {
        $this->subcategory_id = null;
        $this->loadSubcategories();
    }

    protected function loadSubcategories()
    {
        $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:docs_categories,id',
            'subcategory_id' => 'nullable|exists:docs_subcategories,id',
            'content' => 'required|string',
            'video_url' => 'nullable|url',
        ];
    }

    public function update()
    {
        $this->validate();

        $topic = DocsTopic::findOrFail($this->topicId);

        $topic->update([
            'title' => $this->title,
            'content' => $this->content,
            'video_url' => $this->video_url,
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
        ]);

        // Emit event ke parent untuk kembali ke tabel
        $this->dispatch('back-to-table');
        session()->flash('success', 'Topik berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.docs.topics.edit');
    }
}
