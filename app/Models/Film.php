<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    protected $table = 'films';
    protected $fillable = ['title','sinopsis','year','poster','genre_id'];

    public function getDisplayRatingAttribute(): float
    {
        return match ($this->title) {
            'Resident Evil' => 4.5,
            '28 Years Later' => 4.0,
            'Weapons' => 4.2,
            default => 3.5,
        };
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function perans()
    {
        return $this->hasMany(Peran::class);
    }

    public function kritiks()
    {
        return $this->hasMany(Kritik::class);
    }
}
