<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $fillable = [
        'streaming',
        'ld',
        'sd',
        'hsd',
    ];

    public function video()
    {
        return $this->belongsToMany(Video::class, 'video_source', 'source_id', 'video_id');
    }
}
