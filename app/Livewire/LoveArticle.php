<?php

namespace App\Livewire;

use App\Models\users\Article;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoveArticle extends Component
{
    public $article_id;

    public function mount($id)
    {
        $this->article_id = $id;
    }
    public function handelclick()
    {  
        $article=Article::find( $this->article_id);
        $user = Auth::user();
        $existLike = $article->likes()->where('user_id', $user->id)->first();
    
        if ($existLike) {
            $existLike->delete();
        } else {
            $article->likes()->create([
                'user_id' => $user->id,
                'article_id'=>$article->id,
            ]);
        }
    }
    public function render()
    {
        $article=Article::find( $this->article_id);
        return view('livewire.love-article',compact('article'));
    }
  
}
