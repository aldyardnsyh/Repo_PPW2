<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuRating extends Model
{
    use HasFactory;

    protected $table = 'buku_ratings';

    protected $fillable = ['buku_id', 'user_id', 'rating'];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
