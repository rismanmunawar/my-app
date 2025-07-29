<?php

namespace App\Livewire\Articles;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Article $article;
    public $title;
    public $content;
    public $published_at;
    public $image;
    public $oldImagePaths = [];
    public string $category = '';
    public string $status = '';
    public function mount(Article $article)
    {
        $this->article = $article;
        $this->title = $article->title;
        $this->content = $article->content;
        $this->published_at = optional($article->published_at)->format('Y-m-d');
        $this->oldImagePaths = $this->extractImagePaths($article->content);
        $this->category = $article->category ?? '';
        $this->status = $article->status ?? 'draft';
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function update()
    {
        $this->validate();

        // Hapus gambar utama lama jika diganti
        if ($this->image) {
            if ($this->article->image && Storage::disk('public')->exists($this->article->image)) {
                Storage::disk('public')->delete($this->article->image);
            }

            $path = $this->image->store('uploads/articles', 'public');
            $this->article->image = $path;
        }

        // Hapus gambar Markdown yang sudah tidak digunakan
        $newImagePaths = $this->extractImagePaths($this->content);
        $deletedImages = array_diff($this->oldImagePaths, $newImagePaths);
        foreach ($deletedImages as $url) {
            $filePath = str_replace('/storage/', '', parse_url($url, PHP_URL_PATH));
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
        }

        $this->article->update([
            'title' => $this->title,
            'content' => $this->content,
            'published_at' => $this->published_at,
        ]);

        session()->flash('success', 'Artikel berhasil diperbarui.');
        return redirect()->route('articles.index');
    }

    private function extractImagePaths($content)
    {
        preg_match_all('/!\[.*?\]\((.*?)\)/', $content, $matches);
        return $matches[1] ?? [];
    }

    public function render()
    {
        return view('livewire.articles.edit');
    }
}