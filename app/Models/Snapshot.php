<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Snapshot extends Model
{
    use HasFactory;

    protected $fillable = [
        'sd',
        'th',
    ];

    public function video()
    {
        return $this->belongsToMany(Video::class, 'video_snapshot', 'snapshot_id', 'video_id');
    }
}
