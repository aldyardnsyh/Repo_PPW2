<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'buku_id',
    ];

    // Assuming your table name is 'favourites'
    protected $table = 'favourites';
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
