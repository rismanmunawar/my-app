<?php

namespace App\Livewire\Articles;

use App\Models\Article;
use Livewire\Component;

class Show extends Component
{
    public Article $article;

    public function mount(Article $article)
    {
        $this->article = $article;
    }

    public function render()
    {
        return view('livewire.articles.show');
    }
}