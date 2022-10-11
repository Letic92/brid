<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'image',
        'thumbnail',
        'duration',
        'publish',
        'mime_type',
        'monetize',
        'age_gate_id',
        'webp',
        'live_stream',
        'live_image',
        'video_background',
        'is_360',
        'credits',
        'carousel_click_through_url',
        'thumb',
        'tags',
        'likes',
    ];

    public function snapshots()
    {
        return $this->belongsToMany(Snapshot::class, 'video_snapshot', 'video_id', 'snapshot_id');
    }

    public function dai()
    {
        return $this->belongsToMany(Dai::class, 'video_dai', 'video_id', 'dai_id');
    }

    public function source()
    {
        return $this->belongsToMany(Source::class, 'video_source', 'video_id', 'source_id');
    }

    public function tracks()
    {
        return $this->belongsToMany(Track::class, 'video_track', 'video_id', 'track_id');
    }

    public function customParams()
    {
        return $this->belongsToMany(CustomParams::class, 'video_custom_parameters', 'video_id', 'custom_params_id');
    }

    public function pixel()
    {
        return $this->belongsToMany(Pixel::class, 'video_pixel', 'video_id', 'pixel_id');
    }

    public function getPublishAttribute($value)
    {
        return date( 'Y.m.d', strtotime($value));
    }
}
