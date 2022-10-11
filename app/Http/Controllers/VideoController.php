<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function getVideo(Request $request)
    {
        $video = Video::find($request->only('video_id'))->first();

        if ($video) {
            SEOMeta::setTitle('Video | ' . $video->name);
            OpenGraph::setTitle('Video | ' . $video->name);
            JsonLd::setTitle('Video | ' . $video->name);

            SEOMeta::addMeta('video:published_time', $video->publish, 'property');

            OpenGraph::addImage($video->image);
            OpenGraph::addImage(['url' => $video->image, 'size' => 300]);
            OpenGraph::addImage($video->image, ['height' => 300, 'width' => 300]);

            if (isset($video->descriptio)) {
                SEOMeta::setDescription($video->descriptio);
                OpenGraph::setDescription($video->descriptio);
                JsonLd::setDescription($video->descriptio);
            } else {
                SEOMeta::setDescription('Description');
                OpenGraph::setDescription('Description');
                JsonLd::setDescription('Description');
                return view('video', ['video' => $video]);
            }

            if (isset($video->tags)) {
                SEOMeta::setKeywords(explode(',', $video->tags));
            }

            SEOMeta::setCanonical(route('video', ['video_id' => $video->id]));
            OpenGraph::setUrl(route('video', ['video_id' => $video->id]));
            OpenGraph::addProperty('type', 'video');

            JsonLd::setType('video');
            JsonLd::addImage($video->image);

            return view('video', ['video' => $video]);
        } else {
            return redirect('/')->with('error', 'Video doesnt exist');
        }
    }
}
