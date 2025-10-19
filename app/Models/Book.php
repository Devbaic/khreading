<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Book extends Model
{
use HasFactory;
    protected $table = 'books';
    protected $fillable = [
        'image',
        'name',
        'typebook_id',
        'author',
        'filebook',
        'description',
        'status',
        'flip_url'
    ];

    public function typebook()
    {
        return $this->belongsTo(Kind::class);
    }
}
