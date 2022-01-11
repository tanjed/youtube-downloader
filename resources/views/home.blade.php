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
                    <form id="go" class="form-group" action="{{route('search')}}" method="POST">
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
                        <p class="mb-2">Duration: {{$payload['duration']}}</p>
                    </div>
                    <div class="col-lg-5">
                        <div id = "video-info">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#MP3" role="tab" aria-controls="profile" aria-selected="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
                                            <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"></path>
                                            <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"></path>
                                        </svg>
                                        MP3</a>
                                </li>


                                <li class="nav-item" role="presentation">
                                    <a class="nav-link " id="home-tab" data-toggle="tab" href="#MP4" role="tab" aria-controls="home" aria-selected="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-play-btn" viewBox="0 0 16 16">
                                            <path d="M6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814l-3.5-2.5z"></path>
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"></path>
                                        </svg>
                                        Video</a>
                                </li>


                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#Audio" role="tab" aria-controls="contact" aria-selected="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-music-note-beamed" viewBox="0 0 16 16">
                                            <path d="M6 13c0 1.105-1.12 2-2.5 2S1 14.105 1 13c0-1.104 1.12-2 2.5-2s2.5.896 2.5 2zm9-2c0 1.105-1.12 2-2.5 2s-2.5-.895-2.5-2 1.12-2 2.5-2 2.5.895 2.5 2z"/>
                                            <path fill-rule="evenodd" d="M14 11V2h1v9h-1zM6 3v10H5V3h1z"/>
                                            <path d="M5 2.905a1 1 0 0 1 .9-.995l8-.8a1 1 0 0 1 1.1.995V3L5 4V2.905z"/>
                                        </svg>
                                        Audio</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade " id="MP4" role="tabpanel" aria-labelledby="home-tab">
                                    @foreach($payload['video'] as $video)
                                    <div class="form-row py-3 border-bottom">
                                        <div class="col-12 col-md-6 mt-lg-0">{{$video['mimeType']}} {{$video['resolution']}}</div>
                                        <div class="col-12 col-md-6 mt-lg-0">
                                            <a id="mp4-dl-btn" target="_blank"  href="{{$video['url']}}" rel="nofollow" class="btn btn-primary" download>Download</a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>


                                <div class="tab-pane fade show active" id="MP3" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="form-row pt-3">
                                        <div class="col-12 col-lg-6 mt-2 mt-lg-0">
                                            <div class="form-inline">
                                                <input type="hidden" id="audio-contentLength" value="{{$payload['audible']['contentLength']}}">
                                                <input type="hidden" id="audio-url" value="{{$payload['audible']['url']}}">
                                                <input type="hidden" id="audio-id" value="{{$payload['id']}}">
                                                <input type="hidden" id="audio-mimeType" value="{{$payload['audible']['mimeType']}}">
                                                <select class="form-control" id="audio-bit">
                                                    <optgroup label="MP3">
                                                        <option value="64">mp3 64kbps</option>
                                                        <option value="128" selected>mp3 128kbps</option>
                                                        <option value="192">mp3 192kbps</option>
                                                        <option value="256">mp3 256kbps</option>
                                                        <option value="320">mp3 320kbps</option>
                                                    </optgroup>
                                                </select>
                                                <button class="btn btn-primary" id="audio-convert">
                                                  Convert
                                                </button>
                                                <form action="{{route('download')}}" style="display: none" id="audio-download">
                                                    <input type="hidden" id="audio-download-url" name="url">
                                                    <button class="btn btn-primary" type="submit">
                                                        Download
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-2 mt-lg-0">
                                        </div>
                                        <div id="mp3-dl-result" class="alert alert-danger d-none mt-2" role="alert" disabled></div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="Audio" role="tabpanel" aria-labelledby="contact-tab">
                                    @foreach($payload['audio'] as $audio)
                                    <div class="form-row py-3 border-bottom">
                                        <div class="col-12 col-md-6 mt-lg-0">{{$audio['mimeType']}} {{$audio['bit']}}</div>
                                        <div class="col-12 col-md-6 mt-lg-0">
                                            <a id="mp4-dl-btn" target="_blank" href="{{$audio['url']}}" rel="nofollow" class="btn btn-primary" download>Download</a>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5 container m-auto ">
            <div class="row text-left">
                <div class="col-12">
                    <h2 class="text-center mb-4">Tips for Download YouTube Video</h2>
                    <ul class="pl-4">
                        <li>Select the format you want and click "Download" button.</li>
                        <li>In new window, press "CTRL + S" to save video OR right click to video, then select "Save as Video".</li>
                        <li>If our
                            <a href="/en33/plugin">Chrome Extension</a> is installed, the video download become even easier.
                            In fact, it takes place immediately when the "Download" button is clicked.
                            In addition, a specific file name is also created for the video grabbed.</li>
                        <li>It is strongly recommended to have the <a href="/en33/plugin">Chrome Extension</a> installed.</li>
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
                            <a href="https://savett.cc" target="black">TikTok Video Downloader</a>
                        </p>
                        <p class="tiktok-watermark">
                            <a href="https://savett.cc" target="black">TikTok Downloader - Download and Save TikTok Videos Without Watermark.</a>
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
                    <div class="icon-size rounded-circle text-primary mr-3">
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
                    <div class="icon-size rounded-circle text-primary mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor">
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
                    <div class="icon-size rounded-circle text-primary mr-3">
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
    <script>
        $('#audio-convert').click(function(){
            $('#audio-convert').html('Converting...')

            let id = $('#audio-id').val();
            let url = $('#audio-url').val();
            let mimeType = $('#audio-mimeType').val();
            let contentLength = $('#audio-contentLength').val();
            let bit = $('#audio-bit').val();
            let data = {
                'url' : url,
                'mimeType' : mimeType ,
                'contentLength' : contentLength,
                'id' : id,
                'bit' : bit
            };
            axios.post("{{route('convert')}}", data)
                .then(function (response) {
                    console.log(response)
                    if(response.data.success)
                    {
                        $('#audio-convert').hide()
                        $('#audio-download-url').val(response.data.url)
                        $('#audio-download').show()
                    }
                    else
                    {
                        $('#audio-convert').html('Error')
                    }
                })
            .catch(function () {
                $('#audio-convert').html('Error')
            })
        })
    </script>

    <script crossorigin="anonymous" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script crossorigin="anonymous"
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script crossorigin="anonymous"
            src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ef98087bce3a2e3"
            async="async"></script>
    <script type="text/javascript" src="/static/js/dark-2c78c10e90.js"></script>

@endsection
