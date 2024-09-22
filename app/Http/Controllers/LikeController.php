<?php

namespace App\Http\Controllers;

use App\Models\users\Article;
use App\Models\users\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Article $article)
    {
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
        return redirect()->back();
    }
   
}
