<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\users\Article;
use App\Models\users\Category;

class Search extends Component
{
    use WithPagination;

    public $searchTerm = '';
    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        $articles = Article::where('title', 'like', '%' . $this->searchTerm . '%')
            ->with(['admin', 'likes'])
            ->paginate(3);
        return view('livewire.search', [
            'articles' => $articles,
            'categories' => $this->categories,
        ]);
    }
}
