<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class CommentTime extends Component
{
   
    public $createdAt;
    public $time;
    public function mount($created_at)
    {
        $this->createdAt = Carbon::parse($created_at);
        $this->changetime();
    }
    public function changetime()
    {
        $this->time= $this->createdAt->diffForHumans();
    }
    public function render()
    {
        return view('livewire.comment-time');
    }
}
