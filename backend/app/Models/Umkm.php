<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'alamat',
        'harga',
        'kontak',
        'image_url',
    ];

    protected $appends = ['imageUrl'];

    public function getImageUrlAttribute()
    {
        return $this->attributes['image_url'] ?? null;
    }
}
