<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model
{
    use HasFactory;

    protected $table = 'perangkat_desas';

    protected $fillable = [
        'jabatan',
        'nama',
        'image_url',
    ];

    protected $appends = ['imageUrl'];

    public function getImageUrlAttribute()
    {
        return $this->attributes['image_url'] ?? null;
    }
}
