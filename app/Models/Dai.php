<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dai extends Model
{
    use HasFactory;

    protected $fillable = [
        'enabled_override',
        'enabled',
    ];

    public function video()
    {
        return $this->belongsToMany(Video::class, 'video_dai', 'dai_id', 'video_id');
    }
}
