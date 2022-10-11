<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function getVideo(Request $request)
    {
        $video = Video::find($request->only('video_id'))->first();

        if ($video) {
            return view('video', ['video' => $video]);
        } else {
            return redirect('/')->with('error', 'Video doesnt exist');
        }
    }
}
