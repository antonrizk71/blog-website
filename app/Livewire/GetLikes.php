<?php

namespace App\Livewire;

use App\Models\users\Article;
use Livewire\Component;

class GetLikes extends Component
{
    public $article;
    public $likes;
    public function mount($id)
    {
        $this->article=Article::find($id);
        $this->likes=$this->get_likes();
    }
    public function get_likes()
    {
        $this->likes=$this->article->likes;
    }
    
    public function render()
    {
        return view('livewire.get-likes');
    }
    public function getListeners()
    {
        return [
            'refreshLikes' => 'updateLikes'
        ];
    }
}
