<div class="photobooth-4 photobooth-upload-image-block d-none">
    <div class="container">
        <div class="photobooth-upload-image-subblock">
            <h1>Upload an image</h1>
            <div class="drag-area">
                <input type="hidden" name="image_type" value="" />
                <div class="drag-area-inner">
                    <div class="icon">
                        <img src="{{asset('assets/images/upload-icon.png')}}" class="img-fluid" />
                    </div>
                    <header>Drop your image here, or <label for="upload-image" type="button">browse</label></header>
                </div>
                <input id="upload-image" name="image" type="file" hidden>
            </div>
            <div class="button-block">
                <a href="#" class="btn-back photobooth-select-step" data-step="2">
                    <img src="{{asset('assets/images/back.png')}}" class="img-fluid" />
                </a>
            </div>
        </div>
    </div>
</div>
