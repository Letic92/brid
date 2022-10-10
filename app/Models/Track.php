<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'kind',
        'src',
    ];

    public function video()
    {
        return $this->belongsToMany(Video::class, 'video_track', 'track_id', 'video_id');
    }
}
