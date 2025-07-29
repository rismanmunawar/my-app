<?php

namespace App\Livewire\Articles;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public string $title = '';
    public string $category = '';
    public string $status = '';
    public string $content = '';
    public function save()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Article::create([
            'author_id' => Auth::id(),
            'title' => $this->title,
            'content' => $this->content,
            'published_at' => now(),
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function render()
    {
        return view('livewire.articles.create');
    }
}