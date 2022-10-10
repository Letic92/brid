<?php

namespace App\Http\Livewire;

use App\Http\Controllers\RefreshVideoController;
use App\Models\Video;
use Livewire\Component;

class VideoList extends Component
{
    public $videos;
    public $sort = 'name';
    public $search;
    public $videosLower60 = false;
    public $excluded_selected_videos = [];
    public $json;

    protected $listeners = [
        'changeOrder',
        'videosLower60',
    ];

    protected $queryString = [
        'sort',
        'search',
    ];

    public function changeOrder($order)
    {
        $this->sort = $order;
    }

    public function videosLower60()
    {
        $this->videosLower60 = true;
    }

    public function refreshVideos()
    {
        RefreshVideoController::refreshVideos($this->json, 'url');

        return redirect()->with('success', 'success message');
    }

    public function render()
    {
        $this->videos = Video::whereNotIn('id', $this->excluded_selected_videos)
            ->when(!empty($this->search), function ($query) {
                return $query->where('name', 'LIKE', '%' . $this->search . '%' ?? '')->orWhere('duration', '=', $this->search ?? '');
            })
            ->when($this->videosLower60, function ($query) {
                return $query->where('duration', '<', '60');
            })->orderBy($this->sort)->get();
        return view('livewire.video-list');
    }
}
