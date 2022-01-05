<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use YouTube\YouTubeDownloader;

class YoutubeController extends Controller
{
    public function search(Request $request)
    {
        dd($this->getVideo($request->q));
    }

    private function getVideo($url)
    {
        $youtube = new YouTubeDownloader();
        $video = $youtube->getDownloadLinks($url);
        $info = collect($video->getInfo())->first();
        $videoFormats = $video->getCombinedFormats();
        $audioFormats = $video->getAudioFormats();
        return $this->formatPayload($info,$videoFormats,$audioFormats);
    }


    private function formatPayload($info,$videoFormats,$audioFormats)
    {
        $thumbnail = collect($info['thumbnail']['thumbnails'])->last();
        return [
            'id' => $info['videoId'],
            'thumbnail' => $thumbnail['url'],
            'name' => $info['title'],
            'duration' => gmdate("H:i:s", $info['lengthSeconds']),
            'download_options' => []
        ];
    }
}
