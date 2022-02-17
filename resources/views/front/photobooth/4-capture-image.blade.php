<div class="photobooth-4 photobooth-capture-image-block d-none">
    <div class="container">
        <div class="photobooth-capture-image-subblock">
            <h1>Capture Photo:</h1>
            <div class="row">
                <div class="col-xs-12">
                    <img src="{{asset('assets/images/capture-photo.png')}}" class="d-none" id="photobooth-captured-gif-image" />
                    <video id="photobooth-capture-webcam" autoplay playsinline width="400" height="400" style="width: 400px;"></video>
                    <canvas id="photobooth-capture-canvas" class="d-none"></canvas>
                    <audio id="photobooth-capture-snapSound" src="{{ asset("assets/audio/snap.wav") }}" preload = "auto"></audio>
                </div>
                <div class="col-xs-6">
                    <div class="button-block">
                        <a href="#" class="btn photobooth-take-image d-none">
                            <img src="{{asset('assets/images/upload.png')}}" class="img-fluid d-none" data-button-type="gif" />
                            <img src="{{asset('assets/images/next.png')}}" class="img-fluid next-img d-none" data-button-type="classic" />
                        </a>
                        <a href="#" class="btn photobooth-start-camera">
                            <img src="{{asset('assets/images/take-photo.png')}}" class="img-fluid" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
