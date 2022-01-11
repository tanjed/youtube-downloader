<?php

namespace App\Http\Controllers;

use App\Services\Downloader;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use YouTube\YouTubeDownloader;

class YoutubeController extends Controller
{
    public function search(Request $request)
    {
        $payload = $this->getVideo($request->q);
//        dd($payload);
        return view('home',compact('payload'));
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
        $audible = $audioFormats[count($audioFormats) - 1];
        $payload = [
            'id' => $info['videoId'],
            'thumbnail' => $thumbnail['url'],
            'name' => $info['title'],
            'duration' => gmdate("H:i:s", $info['lengthSeconds']),
            'audio' => [],
            'video' => [],
            'audible' => [
                'mimeType' => $audible->mimeType,
                'url' => $audible->url,
                'contentLength' => $audible->contentLength
            ]
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


    public function convertToMP3(Request $request)
    {
        set_time_limit(0);
        $id = $request->id;
        $url = Downloader::get($request);
        $fileName = $id.'_'.$request->bit.'.mp3';
        $mp3FilePath = public_path($fileName);
        shell_exec("ffmpeg -i {$url} -ar 44100 -ac 2 -b:a {$request->bit}k {$mp3FilePath}");
        unlink($url);
        return [
            'success' => true,
            'url' => $fileName,
        ];
    }

    public function downloadResource(Request $request)
    {
        $file = $request->file;
        return response()->download($file)->deleteFileAfterSend(true);
    }

}
