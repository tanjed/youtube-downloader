<?php

namespace App\Services;

use Curl\Client;
use Illuminate\Support\Str;

class Downloader
{
    const PART_LENGTH = 50000;
    public function downloader($object)
    {
        $info = $this->getMimeType($object->mimeType);
        $fileName = Str::random(10);
        $filePath =  public_path("{$fileName}.{$info['extension']}");
        $url = $object->url;
        $length = $object->contentLength;
        $start = 0;
        $curlObj = new Client();
        do{
            $end = min(($start + self::PART_LENGTH), $length);
            $part = $curlObj->get($url,[],['range' => "bytes={$start}-{$end}"]);
            $start = $start + self::PART_LENGTH + 1;
            file_put_contents($filePath,$part->body, FILE_APPEND);
        }while($end !== $length);

        return $filePath;
    }

    private function getMimeType($mimeType)
    {
        $mimeType = collect(explode(';',$mimeType))->first();
        $extension = explode('/',$mimeType)[1];
        return [
            'extension' => $extension,
            'mimType' => $mimeType
        ];
    }
}
