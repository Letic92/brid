<?php

namespace App\Http\Controllers;

use App\Models\CustomParams;
use App\Models\Dai;
use App\Models\Pixel;
use App\Models\Snapshot;
use App\Models\Source;
use App\Models\Track;
use App\Models\Video;
use Illuminate\Http\Request;

class RefreshVideoController extends Controller
{
    public function refreshVideos($json, $type)
    {
        try {
            switch ($type) {
                case "url":
                    $json = file_get_contents($json);
                    break;
                case "file":
                    $json = file_get_contents(storage_path() . "/" . $json);
                    break;
                default:

            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return redirect()->back()->with('error', 'error');
        }

        foreach ($data['Video'] as $video) {
            $videoObj = Video::find($video['id']);

            if ($videoObj) {
                $videoObj->name = $video['name'];
                $videoObj->description = $video['description'];
                $videoObj->image = $video['image'];
                $videoObj->thumbnail = $video['thumbnail'];
                $videoObj->duration = $video['duration'];
                $videoObj->publish = $video['publish'];
                $videoObj->mime_type = isset($video['mimeType']) ? $video['mimeType'] : null;
                $videoObj->monetize = $video['monetize'];
                $videoObj->age_gate_id = $video['age_gate_id'];
                $videoObj->webp = $video['webp'];
                $videoObj->live_stream = $video['livestream'];
                $videoObj->live_image = $video['liveimage'];
                $videoObj->video_background = $video['video_background'];
                $videoObj->is_360 = $video['is360'];
                $videoObj->credits = $video['credits'];
                $videoObj->carousel_click_through_url = $video['carousel_clickthrough_url'];
                $videoObj->thumb = $video['thumb'];
                $videoObj->tags = $video['tags'];
                $videoObj->likes = $video['likes'];
                $videoObj->save();
            } else {
                $videoObj = Video::create([
                    'name' => $video['name'],
                    'description' => $video['description'],
                    'image' => $video['image'],
                    'thumbnail' => $video['thumbnail'],
                    'duration' => $video['duration'],
                    'publish' => $video['publish'],
                    'mime_type' => isset($video['mimeType']) ? $video['mimeType'] : null,
                    'monetize' => $video['monetize'],
                    'age_gate_id' => $video['age_gate_id'],
                    'webp' => $video['webp'],
                    'live_stream' => $video['livestream'],
                    'live_image' => $video['liveimage'],
                    'video_background' => $video['video_background'],
                    'is_360' => $video['is360'],
                    'credits' => $video['credits'],
                    'carousel_click_through_url' => $video['carousel_clickthrough_url'],
                    'thumb' => $video['thumb'],
                    'tags' => isset($video['tags']) ? $video['tags'] : null,
                    'likes' => $video['likes'],
                ]);
            }

            if ($videoObj) {
                if (empty($video['snapshots'])) {
                    if (!$videoObj->snapshots()->get()->isEmpty()) {
                        $videoObj->snapshots()->deatach();
                    }
                } else {
                    if ($videoObj->snapshots()->get()->isEmpty()) {
                        $snapshotObj = Snapshot::create([
                            'sd' => isset($video['snapshots']['sd']) ? $video['snapshots']['sd'] : null,
                            'sh' => isset($video['snapshots']['sh']) ? $video['snapshots']['sh'] : null,
                        ]);
                    } else {
                        $snapshotObj = $videoObj->snapshots()->first();
                        $snapshotObj->sd = isset($video['snapshots']['sd']) ? $video['snapshots']['sd'] : null;
                        $snapshotObj->sh = isset($video['snapshots']['sh']) ? $video['snapshots']['sh'] : null;
                        $snapshotObj->save();
                    }

                    if ($snapshotObj) {
                        $videoObj->snapshots()->sync($snapshotObj->id);
                    }
                }

                if (empty($video['dai'])) {
                    if (!$videoObj->dai()->get()->isEmpty()) {
                        $videoObj->dai()->deatach();
                    }
                } else {
                    if ($videoObj->dai()->get()->isEmpty()) {
                        $daiObj = Dai::create([
                            'enabled_override' => $video['dai']['enabled_override'],
                            'enabled' => $video['dai']['enabled'],
                        ]);
                    } else {
                        $daiObj = $videoObj->dai()->first();
                        $daiObj->enabled_override = $video['dai']['enabled_override'];
                        $daiObj->enabled = $video['dai']['enabled'];
                        $daiObj->save();
                    }

                    if ($daiObj) {
                        $videoObj->dai()->sync($daiObj->id);
                    }
                }

                if (empty($video['source'])) {
                    if (!$videoObj->source()->get()->isEmpty()) {
                        $videoObj->source()->deatach();
                    }
                } else {
                    if ($videoObj->source()->get()->isEmpty()) {
                        $sourceObj = Source::create([
                            'streaming' => isset($video['source']['streaming']) ? $video['source']['streaming'] : null,
                            'ld' => isset($video['source']['ld']) ? $video['source']['ld'] : null,
                            'sd' => isset($video['source']['sd']) ? $video['source']['sd'] : null,
                            'hsd' => isset($video['source']['hsd']) ? $video['source']['hsd'] : null,
                        ]);
                    } else {
                        $sourceObj = $videoObj->source()->first();
                        $sourceObj->streaming = isset($video['source']['streaming']) ? $video['source']['streaming'] : null;
                        $sourceObj->ld = isset($video['source']['ld']) ? $video['source']['ld'] : null;
                        $sourceObj->sd = isset($video['source']['sd']) ? $video['source']['sd'] : null;
                        $sourceObj->hsd = isset($video['source']['hsd']) ? $video['source']['hsd'] : null;
                        $sourceObj->save();
                    }

                    if ($sourceObj) {
                        $videoObj->source()->sync($sourceObj->id);
                    }
                }

                if (empty($video['tracks'])) {
                    if (!$videoObj->tracks()->get()->isEmpty()) {
                        $videoObj->tracks()->deatach();
                    }
                } else {
                    if ($videoObj->tracks()->get()->isEmpty()) {
                        $trackObj = Track::create([
                            'kind' => isset($video['tracks']['kind']) ? $video['tracks']['kind'] : null,
                            'src' => isset($video['tracks']['src']) ? $video['tracks']['src'] : null,
                        ]);
                    } else {
                        $trackObj = $videoObj->tracks()->first();
                        $trackObj->kind = isset($video['tracks']['kind']) ? $video['tracks']['kind'] : null;
                        $trackObj->src = isset($video['tracks']['src']) ? $video['tracks']['src'] : null;
                        $trackObj->save();
                    }

                    if ($trackObj) {
                        $videoObj->tracks()->sync($trackObj->id);
                    }
                }

                if (empty($video['customParams'])) {
                    if (!$videoObj->customParams()->get()->isEmpty()) {
                        $videoObj->customParams()->deatach();
                    }
                } else {
                    if ($videoObj->customParams()->get()->isEmpty()) {
                        $customParamsObj = CustomParams::create([
                            'content' => $video['customParams']['content'],
                        ]);
                    } else {
                        $customParamsObj = $videoObj->customParams()->first();
                        $customParamsObj->content = $video['customParams']['content'];
                        $customParamsObj->save();
                    }

                    if ($customParamsObj) {
                        $videoObj->customParams()->sync($customParamsObj->id);
                    }
                }

                if (empty($video['pixel'])) {
                    if (!$videoObj->pixel()->get()->isEmpty()) {
                        $videoObj->pixel()->deatach();
                    }
                } else {
                    if ($videoObj->pixel()->get()->isEmpty()) {
                        $pixelObj = Pixel::create([
                            'first_quartile' => $video['pixel']['first_quartile'],
                        ]);
                    } else {
                        $pixelObj = $videoObj->pixel()->first();
                        $pixelObj->first_quartile = $video['pixel']['first_quartile'];
                        $pixelObj->save();
                    }

                    if ($pixelObj) {
                        $videoObj->pixel()->sync($pixelObj->id);
                    }
                }
            } else {

            }
        }
    }
}
