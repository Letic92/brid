<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pixel extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_quartile',
    ];

    public function video()
    {
        return $this->belongsToMany(Video::class, 'video_pixel', 'pixel_id', 'video_id');
    }
}
