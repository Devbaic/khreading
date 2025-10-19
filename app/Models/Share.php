<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Share extends Model
{
    use HasFactory;
    protected $table = 'share';
    protected $fillable = [
        'image',
        'name_share',
        'name_book',
        'description',
        'filebook',
        'typebook_id',
        'status',
    ];
    public function typebook()
    {
        return $this->belongsTo(Kind::class);
    }
}
