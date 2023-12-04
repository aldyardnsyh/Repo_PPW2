<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = ['id', 'judul', 'penulis', 'harga', 'tgl_terbit', 'created_at', 'updated_at', 'filename', 'filepath','buku_seo','foto'];

    protected $dates = ['tgl_terbit'];

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function photos() {
        return $this->hasMany(Buku::class, 'buku_id', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(BukuRating::class);
    }

    public function calculateAverageRating()
{
    $ratings = $this->ratings()->pluck('rating')->toArray();

    $a = array_count_values($ratings)[1] ?? 0;
    $b = array_count_values($ratings)[2] ?? 0;
    $c = array_count_values($ratings)[3] ?? 0;
    $d = array_count_values($ratings)[4] ?? 0;
    $e = array_count_values($ratings)[5] ?? 0;

    $totalRating = $a + 2 * $b + 3 * $c + 4 * $d + 5 * $e;
    $totalUsers = count($ratings);

    return $totalUsers > 0 ? $totalRating / $totalUsers : 0;
}

public function favourites()
    {
        return $this->hasMany(Favourite::class, 'buku_id');
    }

}