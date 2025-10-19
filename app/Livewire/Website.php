<?php

namespace App\Livewire;
use App\Models\Book;
use Livewire\Component;
use App\Models\Banner;
class Website extends Component
{
    public function render()
    {
        $banners=Banner::orderBy('image','ASC')->get();
        $books = Book::orderBy('name', 'ASC')->get();
        return view('livewire.website',
            ['books' => $books],['banners'=>$banners]);
    }
}
