<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{
    use HasFactory;

    protected $table = 'komoditas';

    protected $fillable = [
        'nama',
        'deskripsi',
        'image_url',
    ];

    protected $appends = ['imageUrl'];

    public function getImageUrlAttribute()
    {
        return $this->attributes['image_url'] ?? null;
    }
}
