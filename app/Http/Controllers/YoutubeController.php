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
        $payload = [
            'id' => $info['videoId'],
            'thumbnail' => $thumbnail['url'],
            'name' => $info['title'],
            'duration' => gmdate("H:i:s", $info['lengthSeconds']),
            'audio' => [],
            'video' => []
        ];

        foreach ($videoFormats as $format)
        {
            $payload['video'][] = [
                'mimeType' => $this->getMimeType($format->mimeType),
                'resolution' => $format->width.'x'.$format->height,
                'url' => $format->url,
            ];
        }
        foreach ($audioFormats as $format)
        {
            $payload['audio'][] = [
                'mimeType' => $this->getMimeType($format->mimeType),
                'bit' => (int)($format->audioSampleRate/1000). 'kbps',
                'url' => $format->url,
            ];
        }

        return $payload;

    }

    private function getMimeType($combinedType)
    {
        $mimeType = explode(';',$combinedType);
        return explode('/',$mimeType[0])[1];
    }
}
