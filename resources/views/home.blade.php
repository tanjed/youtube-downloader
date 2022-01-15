@extends('master',['from' => 'HOME'])
@section('title','Download TikTok Video without watermark online for free')
@section('content')
    <div class="bg-theme text-center">
        <div class="container m-auto">
            <div class="mb-4">
                <h1>YouTube to MP3</h1>
            </div>
            <div class="row">
                <div class="col-12 col-lg-10 mx-auto">
                    <form id="go" class="form-group" action="{{route('search')}}" method="GET">
                        {{csrf_field()}}
                        <div class="has-search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                            </svg>
                            <input name="q" type="text" class="form-control form-control-lg" placeholder="Search keywords or paste link here..." aria-label="Search" required="" />
                            <button class="btn btn-lg btn-primary text-light border" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(isset($payload))
    <div id="video-part">
        <section class="video-details">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <img src="{{$payload['thumbnail']}}" class="figure-img img-fluid rounded w-100" alt="{{$payload['name']}}">
                        <h5>{{$payload['name']}}</h5>
                        <p class="mb-"><b>{{$payload['author']}}</b></p>
                        <p class="mb-2">Duration: {{$payload['duration']}}</p>
                    </div>
                    <div class="col-lg-5">
                        <div id = "video-info">
                            <form id="media-convert">
                                <div class="row">
                                    <div class="col">
                                        <select class="form-control form-control-small" id="media-option">
                                            <optgroup label="Video">
                                                @foreach($payload['video'] as $index => $video)
                                                    <option
                                                        data-type="VIDEO"
                                                        data-url="{{$video['url']}}"
                                                        data-clength="{{$video['contentLength']}}"
                                                        data-mtype="{{$video['mimeType']}}" {{$index == (count($payload['video'])-1) ? "selected" : ""}}>
                                                        {{$video['mimeTypeShort']}} {{$video['resolution']}}</option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Audio">
                                                @foreach($payload['audio'] as $audio)
                                                    <option
                                                        data-type="AUDIO"
                                                        data-url="{{$audio['url']}}"
                                                        data-clength="{{$audio['contentLength']}}"
                                                        data-mtype="{{$audio['mimeType']}}">
                                                        {{$audio['mimeTypeShort']}} {{$audio['bit']}}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="MP3">
                                                <option
                                                    data-url="{{$payload['audible']['url']}}"
                                                    data-clength="{{$payload['audible']['contentLength']}}"
                                                    data-mtype="{{$payload['audible']['mimeType']}}"
                                                    data-type="MP3"
                                                    data-bit="64">mp3 64kbps</option>
                                                <option
                                                    data-url="{{$payload['audible']['url']}}"
                                                    data-clength="{{$payload['audible']['contentLength']}}"
                                                    data-mtype="{{$payload['audible']['mimeType']}}"
                                                    data-type="MP3"
                                                    data-bit="128">mp3 128kbps</option>
                                                <option
                                                    data-url="{{$payload['audible']['url']}}"
                                                    data-clength="{{$payload['audible']['contentLength']}}"
                                                    data-mtype="{{$payload['audible']['mimeType']}}"
                                                    data-type="MP3"
                                                    data-bit="192">mp3 192kbps</option>
                                                <option
                                                    data-url="{{$payload['audible']['url']}}"
                                                    data-clength="{{$payload['audible']['contentLength']}}"
                                                    data-mtype="{{$payload['audible']['mimeType']}}"
                                                    data-type="MP3"
                                                    data-bit="256">mp3 256kbps</option>
                                                <option
                                                    data-url="{{$payload['audible']['url']}}"
                                                    data-clength="{{$payload['audible']['contentLength']}}"
                                                    data-mtype="{{$payload['audible']['mimeType']}}"
                                                    data-type="MP3"
                                                    data-bit="320">mp3 320kbps</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <button class="btn btn-success w-100" id="request-convert-button" type="submit">Convert</button>
                                    </div>
                                </div>
                            </form>

                            <div id="media-download" style="display: none">
                                <form action="{{route('download')}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="url" id="media-download-url">
                                    <button type="submit" class="btn btn-success w-100">Download</button>
                                </form>
                                <br>
                                <a href="/" class="btn btn-primary w-100">Continue</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5 container m-auto ">
            <div class="row text-left ">
                <div class="col-12">
                    <h2 class="text-center mb-4">Tips for Download YouTube Video</h2>
                    <ul class="pl-4">
                        <li>Select the format you want and click "Download" button.</li>
                        <li>In new window, press "CTRL + S" to save video OR right click to video, then select "Save as Video".</li>
                        <li>If our
                            <a href="" class="text-decoration-none">Chrome Extension</a> is installed, the video download become even easier.
                            In fact, it takes place immediately when the "Download" button is clicked.
                            In addition, a specific file name is also created for the video grabbed.</li>
                        <li>It is strongly recommended to have the <a href="" class="text-decoration-none">Chrome Extension</a> installed.</li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
    @endif
    <section class="container m-auto">
        <div class="tiktok">
            <div style="width: 100%;">
                <div class="tiktok-logo">
                    <a href="https://savett.cc" target="black">
                        <img src="https://savett.cc/static/images/favicon.ico" alt="TikTok Downloader" />
                    </a>
                    <div class="tiktok-video">
                        <p>
                            <a href="https://savett.cc" class="text-decoration-none" target="black">TikTok Video Downloader</a>
                        </p>
                        <p class="tiktok-watermark">
                            <a href="https://savett.cc" target="black" class="text-decoration-none">TikTok Downloader - Download and Save TikTok Videos Without Watermark.</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-5 pb-4 container m-auto">
        <h2 class="text-center mb-4">How to Convert YouTube to MP3 Music</h2>
        <div class="row m-auto text-left">
            <div class="col-md-4">
                <div class="icon">
                    <div class="icon-size rounded-circle text-primary me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor">
                            <path d="M0 0h24v24H0V0z" fill="none"></path>
                            <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm-1 4H8c-1.1 0-1.99.9-1.99 2L6 21c0 1.1.89 2 1.99 2H19c1.1 0 2-.9 2-2V11l-6-6zM8 21V7h6v5h5v9H8z"></path>
                        </svg>
                    </div>
                    <div class="icon-text">
                        <h5>Copy Video URL</h5>
                        <p class="text-muted">Copy a video URL or an artist name from YouTube or any other video sites.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="icon">
                    <div class="icon-size rounded-circle text-primary me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor">
                            <g>
                                <path d="M0,0h24v24H0V0z" fill="none"></path>
                            </g>
                            <g>
                                <g>
                                    <path d="M4,18h16c1.1,0,1.99-0.9,1.99-2L22,5c0-1.1-0.9-2-2-2H4C2.9,3,2,3.9,2,5v11C2,17.1,2.9,18,4,18z M4,5h16v11H4V5z"></path>
                                    <rect height="2" width="22" x="1" y="19"></rect>
                                    <path
                                        d="M13.97,7.53c-1.37-1.37-3.58-1.37-4.95,0s-1.37,3.58,0,4.95c1.18,1.18,3,1.34,4.36,0.47l2.09,2.09l1.06-1.06l-2.09-2.09 C15.31,10.53,15.16,8.71,13.97,7.53z M12.91,11.41c-0.78,0.78-2.05,0.78-2.83,0c-0.78-0.78-0.78-2.05,0-2.83s2.05-0.78,2.83,0 C13.69,9.37,13.69,10.63,12.91,11.41z"
                                    ></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="icon-text">
                        <h5>Paste Video URL</h5>
                        <p class="text-muted">Paste the YouTube URL into search box and press the 'Search' button.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="icon">
                    <div class="icon-size rounded-circle text-primary me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor">
                            <path d="M0 0h24v24H0V0z" fill="none"></path>
                            <path
                                d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM19 18H6c-2.21 0-4-1.79-4-4 0-2.05 1.53-3.76 3.56-3.97l1.07-.11.5-.95C8.08 7.14 9.94 6 12 6c2.62 0 4.88 1.86 5.39 4.43l.3 1.5 1.53.11c1.56.1 2.78 1.41 2.78 2.96 0 1.65-1.35 3-3 3zm-5.55-8h-2.9v3H8l4 4 4-4h-2.55z"
                            ></path>
                        </svg>
                    </div>
                    <div class="icon-text">
                        <h5>Download MP3 File</h5>
                        <p class="text-muted">Select a target MP3 quality and press 'Download' to save the MP3 file.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-2 container m-auto">
        <div class="row text-left">
            <div class="col-12">
                <h2 class="text-center">Top YouTube to MP3 Converter Online</h2>
                <p>
                    320YTMp3 enables you to download and convert YouTube video to MP3 music with high quality up to 320kbps. All popular formats supported include MP4, MP3, FLV, M4V, WMV and WEBM. You can freely download video from YouTube and
                    convert them to MP3 audio with no limitation.
                </p>
            </div>
        </div>
    </section>
    <section class="py-2 container m-auto">
        <div class="row text-left">
            <div class="col-12">
                <h2 class="text-center">Multiple Features and Rich Video Sources</h2>
                <p>
                    320YTMp3 provides playlist downloading and is compatible with all browsers. In addition, it is totally free of software registration and installation. Except YouTube, you could grab your favorite audio/video from 1000+ sites
                    such as Facebook, Vimeo, Dailymotion etc.
                </p>
            </div>
        </div>
    </section>
    @if(isset($payload))
    <script>
        $('#media-convert').submit((e) => {
            e.preventDefault()
            $('#request-convert-button').html('Converting...')
            const selected = $('#media-option').find(':selected');
            let id = "{{ $payload['id'] }}"
            let url = selected.data('url');
            let mimeType = selected.data('mtype');
            let contentLength = selected.data('clength');
            let bit = selected.data('bit');
            let type = selected.data('type')
            let name = "{{$payload['name']}}"

            let data = {
                'url' : url,
                'mimeType' : mimeType ,
                'contentLength' : contentLength,
                'id' : id,
                'bit' : bit,
                'type' : type,
                'name' : name
            };
            axios.post("{{route('convert')}}", data)
                .then(function (response) {
                    if(response.data.success)
                    {
                        $('#media-convert').hide()
                        $('#media-download').show()
                        $('#media-download-url').val(response.data.url)
                    }
                    else
                    {
                        $('#media-convert').html('Error')
                    }
                })
            .catch(function () {
                $('#media-convert').html('Error')
            })

        });
    </script>
    @endif
    <script crossorigin="anonymous" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script crossorigin="anonymous" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>

@endsection
