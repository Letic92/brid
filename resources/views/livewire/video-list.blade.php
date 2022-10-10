<div class="container-fluid">
    <div class="row">
        @if ($videos->isEmpty())
            <div class="col">
                <form wire:submit.prevent="refreshVideos">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" wire:model.defer="json" aria-label="Url json"
                               placeholder="Url json.." value="{{ $search }}">
                        <div class="input-group-prepend">
                            <button class="btn btn-dark">Refresh</button>
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Sort by</span>
                    </div>
                    <select class="form-select" id="list-select">
                        <option value="name" @if ($sort == 'name') selected @endif>Title</option>
                        <option value="image" @if ($sort == 'image') selected @endif>Image</option>
                        <option value="thumbnail" @if ($sort == 'thumbnail') selected @endif>Thumbnail</option>
                        <option value="duration" @if ($sort == 'duration') selected @endif>Duration</option>
                        <option value="publish" @if ($sort == 'publish') selected @endif>Publish</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <form>
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" wire:model="search" aria-label="Search.."
                               placeholder="Search.." value="{{ $search }}">
                    </div>
                </form>
            </div>
            <div class="col" wire:key="list-button">
                <button class="btn btn-dark" wire:click="videosLower60">Video < 60</button>
            </div>
            <div class="col" wire:key="list-exclude-button">
                <button class="btn btn-success" wire:click="$set('excluded_selected_videos', [])">Reset selected
                    excluded videos
                </button>
            </div>
        @endif
    </div>
    <div class="row">
        <table class="table table-hover table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">UnSelect</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Thumbnail</th>
                <th scope="col">Duration</th>
                <th scope="col">Publish</th>
            </tr>
            </thead>

            <tbody>
            @forelse($videos as $video)
                @switch(TRUE)
                    @case($video->duration <= 60)
                    <tr class="table-dark" wire:key="video-{{ $video->id }}">
                    @break
                    @case(60 < $video->duration && $video->duration <= 120)
                    <tr class="table-warning" wire:key="video-{{ $video->id }}">
                    @break
                    @case($video->duration > 120)
                    <tr class="table-danger" wire:key="video-{{ $video->id }}">
                    @break
                    @default
                    <tr wire:key="video-{{ $video->id }}">
                        @endswitch
                        <th scope="row">{{ $loop->index }}</th>
                        <td><input type="checkbox" wire:model="excluded_selected_videos" value="{{ $video->id }}"></td>
                        <td>{{ $video->name }}</td>
                        <td>
                            <img src="{{ $video->image }}" alt="{{ $video->name }}">
                        </td>
                        <td>
                            <img src="{{ $video->thumbnail }}" alt="{{ $video->name }}">
                        </td>
                        <td>{{ $video->duration }}</td>
                        <td>{{ $video->publish }}</td>
                    </tr>
                    @empty
                        <tr>
                            <th scope="row" class="table-">0</th>
                            <th>EMPTY</th>
                            <th>EMPTY</th>
                            <th>EMPTY</th>
                            <th>EMPTY</th>
                            <th>EMPTY</th>
                            <th>EMPTY</th>
                        </tr>
                    @endforelse
            </tbody>
        </table>
    </div>
</div>
