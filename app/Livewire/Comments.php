<?php

namespace App\Livewire;

use App\Models\users\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comments extends Component
{
    public $art;
    public $comment;
    public $comment_id;
    public $oldcomment;
    public function mount($art)
    {
        $this->art = $art;
    }
    public function render()
    {
        return view('livewire.comments');
    }
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
    public function store()
    {
        $this->validate([
            'comment' => 'required',
        ]);
        if ($this->comment_id) {
            // dd($this->oldcomment);
            $this->oldcomment->update([
                'comment' => $this->comment,
            ]);
        } else {
            Comment::create([
                'comment' => $this->comment,
                'article_id' => $this->art->id,
                'user_id' => Auth::user()->id,
            ]);
        }
        $this->comment = '';
        $this->comment_id = null;
        $this->oldcomment = null;
        $this->render();
    }

    public function update($id)
    {
        $this->comment_id = $id;
        $this->oldcomment = Comment::find($id);
        $this->comment = $this->oldcomment ->comment ;
        // dd($this->comment_id);
    }
}
