<?php

namespace App\Jobs;

use App\Http\Controllers\RefreshVideoController;
use App\Models\CustomParams;
use App\Models\Dai;
use App\Models\Pixel;
use App\Models\Snapshot;
use App\Models\Source;
use App\Models\Track;
use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RefreshVideoListJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $json;
    private $type;
    public function __construct($json, $type)
    {
        $this->json = $json;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        RefreshVideoController::refreshVideos($this->json, $this->type);
    }
}
