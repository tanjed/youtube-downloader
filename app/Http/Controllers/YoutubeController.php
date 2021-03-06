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
        if (!$request->q)
            return redirect('/');
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
            'author' => $info['author'],
            'duration' => gmdate("H:i:s", $info['lengthSeconds']),
            'audio' => [],
            'video' => [],
            'audible' => [
                'mimeType' => $audible->mimeType,
                'mimeTypeShort' => $this->getMimeType($audible->mimeType),
                'url' => $audible->url,
                'contentLength' => $audible->contentLength
            ]
        ];

        foreach ($videoFormats as $format)
        {
            $payload['video'][] = [
                'mimeType' => $format->mimeType,
                'mimeTypeShort' => $this->getMimeType($format->mimeType),
                //'resolution' => $format->width.'x'.$format->height,
                'resolution' => $format->height.'p',
                'url' => $format->url,
                'contentLength' => $format->contentLength
//                'size' => ($format->contentLength / 1000000).' MB'
            ];
        }
        foreach ($audioFormats as $format)
        {
            $payload['audio'][] = [
                'mimeType' => $format->mimeType,
                'mimeTypeShort' => $this->getMimeType($format->mimeType),
                'bit' => (int)($format->audioSampleRate/1000). 'kbps',
                'url' => $format->url,
                'contentLength' => $format->contentLength
//                'size' => ($format->contentLength / 1000000).' MB'
            ];
        }

        return $payload;

    }

    private function getMimeType($combinedType)
    {
        $mimeType = explode(';',$combinedType);
        return explode('/',$mimeType[0])[1];
    }

    public function clean($string) {
        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $string);
        return preg_replace('/-+/', '-', $string); // Removes special chars.
    }

    public function downloadMedia(Request $request)
    {
        set_time_limit(0);
        $id = $this->clean($request->name);
        $url = Downloader::get($request);
        if ($request->type != 'MP3')
        {
            return [
                'success' => true,
                'url' => $url,
            ];
        }
        $fileName = $id.'.mp3';
        $mp3FilePath = public_path($fileName);
        $frequency = $this->getFrequencyFromBit($request->bit);
        shell_exec("ffmpeg -i {$url} -ar {$frequency} -ac 2 -b:a {$request->bit}k {$mp3FilePath}");
        unlink($url);
        return [
            'success' => true,
            'url' => $mp3FilePath,
            'command' => "ffmpeg -i {$url} -ar {$frequency} -ac 2 -b:a {$request->bit}k {$mp3FilePath}"
        ];
    }


    public function convertToMP3(Request $request)
    {
        set_time_limit(0);
        $id = $request->id;
        $url = Downloader::get($request);
        $fileName = $id.'_'.$request->bit.'.mp3';
        $mp3FilePath = public_path($fileName);
        $frequency = $this->getFrequencyFromBit($request->bit);
        shell_exec("ffmpeg -i {$url} -ar {$frequency} -ac 2 -b:a {$request->bit}k {$mp3FilePath}");
       // unlink($url);
        return [
            'success' => true,
            'url' => $mp3FilePath,
            'command' => "ffmpeg -i {$url} -ar {$frequency} -ac 2 -b:a {$request->bit}k {$mp3FilePath}"
        ];
    }

    public function downloadResource(Request $request)
    {
        $file = $request->url;
        return response()->download($file)->deleteFileAfterSend(true);
    }

    private function getFrequencyFromBit($bit) : int
    {
        switch ($bit)
        {
            case 64 :
            default :
                return 8000;
            case  128 :
                return 16000;
            case 192 :
                return 32000;
            case 256 :
                return 44100;
            case 320 :
                return 48000;
        }
    }

}
