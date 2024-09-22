<?php

namespace App\Livewire;

use App\Models\users\Article;
use Livewire\Component;

class ArticleStatus extends Component
{
    public $article;
    public $status;

    public function mount($articleId)
    {
        $this->article = Article::find($articleId);
        $this->status = $this->article->status;
    }

    public function updateStatus($newStatus)
    {
        $this->article->update(['status' => $newStatus]);
        $this->status = $newStatus;
    }

    public function render()
    {
        return view('livewire.article-status');
    }
}
