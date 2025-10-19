<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Acticle;
class Blogdetail extends Component
{
    public $blogID=null;
    public function mount($id){
        $this->blogID=$id;
    }
    public function render()
    {
        $article=Acticle::findOrfail($this->blogID);
        return view('livewire.blogdetail',['article'=>$article]);
    }
}
