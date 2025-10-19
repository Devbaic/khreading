<?php

use App\Livewire\Website;
use Illuminate\Support\Facades\Route;
use App\Livewire\Books;
use App\Livewire\Team;
use App\Livewire\Blog;
use App\Livewire\Faq;
use App\Livewire\Blogdetail;
use App\Livewire\About;
use App\Livewire\Contact;
Route::get('/', Website::class)->name('home');
Route::get('/books', Books::class)->name('books');
Route::get('/team', Team::class)->name('team');
Route::get('/blog',Blog::class)->name('blog');
Route::get('/blog/{id}',Blogdetail::class)->name('blogDetail');
Route::get('/faq',Faq::class)->name('faq');
Route::get('/about', About::class)->name('about');
Route::get('/contact',Contact::class)->name('contact');

