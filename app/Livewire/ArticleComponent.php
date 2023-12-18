<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\Attributes\Url;

class ArticleComponent extends Component
{
    public $articles = [];

    #[Url('search')]
    public $search = '';

    public function render()
    {
        if (!$this->search)
        {
            $this->articles = Article::latest()->get();
        }else
        {
            $this->articles = Article::where('title', 'like', '%' . $this->search . '%')
                                      ->orWhere('content', 'like', '%' . $this->search . '%')
                                      ->orWhereHas('category', function($classQuery){
                                        $classQuery->where('name', 'like', '%' . $this->search . '%');
                                      })
                                      ->get();
        }

        return view('livewire.article-component');
    }

}
