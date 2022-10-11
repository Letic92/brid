@include('layout.header')
<div class="container-fluid">
    <div class="row">
        <video
            id="{{ $video->id }}"
            class="video-js"
            controls
            preload="auto"
            poster="{{ $video->image }}"
            data-setup="{}"
            class="video-js vjs-theme-city"
        >
            @switch(TRUE)
                @case(isset($video->source()->first()->hsd))
                <source src="{{ $video->source()->first()->hsd }}" type="video/mp4"/>
                @break
                @case(isset($video->source()->first()->sd))
                <source src="{{ $video->source()->first()->sd }}" type="video/mp4"/>
                @break
                @case(isset($video->source()->first()->ld))
                <source src="{{ $video->source()->first()->ld }}" type="video/mp4"/>
                @break
                @case(isset($video->source()->first()->streaming))
                <source src="{{ $video->source()->first()->streaming }}" type="application/x-mpegURL"/>
                @break
                @default
                <source src="{{ $video->webp }}" type="video/mp4"/>
            @endswitch
            <p class="vjs-no-js">
                To view this video please enable JavaScript, and consider upgrading to a
                web browser that
                <a href="https://videojs.com/html5-video-support/" target="_blank"
                >supports HTML5 video</a
                >
            </p>
        </video>
    </div>
    <div class="row" style="text-align: center">
        <div class="col">
            <h3>{{ $video->name }}</h3>
            <hr>
            <h3>Description:</h3>
            <br>
            <h3>{{ $video->description }}</h3>
            <hr>
            <h3>Duration: {{ $video->duration }} sec.</h3>
            <hr>
            <h3>Tags:</h3>
            <br>
            <h1>{{ $video->tags }}</h1>
            <hr>
            <h3>Likes: {{ $video->likes }}</h3>
            <hr>
            @if (url()->previous())
                <a href="{{ url()->previous() }}" class="btn btn-success"><-Back</a>
            @else
                <a href="{{ route('index') }}" class="btn btn-success">All videos</a>
            @endif
        </div>
    </div>
</div>
@include('layout.footer')
