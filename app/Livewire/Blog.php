<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Acticle;
use App\Models\Categorie;

class Blog extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $categorySlug;

    public function render()
    {
        $categories = Categorie::all();

        if ($this->categorySlug) {
            $category = Categorie::where('slug', $this->categorySlug)->first();
            $blogs = Acticle::orderBy('title', 'ASC')->paginate(2)->get();
        } else {
            $blogs = Acticle::orderBy('title', 'ASC')->paginate(2);
        }

        return view('livewire.blog', [
            'blogs' => $blogs,
            'categories' => $categories,
        ]);
    }


}


