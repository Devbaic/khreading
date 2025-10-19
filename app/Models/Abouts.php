<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Abouts extends Model
{
    use HasFactory;
    protected $table='abouts';
    protected $fillable = [
        'title',
        'content',
        'image'
    ];
}
