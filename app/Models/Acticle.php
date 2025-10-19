<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Acticle extends Model
{
    use HasFactory;
    protected $table = 'acticles';
    protected $fillable = ['title','category_id','image','content','author','status'];
    public function category()
    {
        return $this->belongsTo(Categorie::class,'category_id');
    }
}
