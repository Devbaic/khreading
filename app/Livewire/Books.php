<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;

class Books extends Component
{
    public function render()
    {
        // Load books with their typebook relationship to avoid N+1 query
        $books = Book::with('typebook')->orderBy('name', 'ASC')->get();

        return view('livewire.books', [
            'books' => $books,
        ]);
    }
}
