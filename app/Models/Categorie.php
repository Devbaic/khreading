<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Categorie extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name','slug','status'];
}
