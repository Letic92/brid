<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomParams extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
    ];

    public function video()
    {
        return $this->belongsToMany(Video::class, 'video_custom_parameters', 'custom_params_id', 'video_id');
    }
}
