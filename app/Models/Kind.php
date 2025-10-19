<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Kind extends Model
{
    use HasFactory;
    protected $table='typebooks';
    protected $fillable=[
        'image',
        'name',
        'description',
    ];
}
