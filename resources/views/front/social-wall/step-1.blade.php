<div class="social-wall-step-1 social-wall-step1-subblock">
    <h1>Step 1: Upload an image</h1>
    <div class="drag-area">
        <input type="hidden" name="image_type" value="" />
        <input type="hidden" name="file_extensions" value="jpeg,jpg,png,gif" />
        <div class="drag-area-inner">
            <div class="icon">
                <img src="{{asset('assets/images/upload-icon.png')}}" class="img-fluid" />
            </div>
            <header>Drop your image here, or <label for="upload-image" type="button">browse</label></header>
        </div>
        <input id="upload-image" name="image" type="file" hidden>
    </div>
    <div class="button-block">
        <a href="{{ url('social-wall') }}" class="btn-back">
            <img src="{{asset('assets/images/back.png')}}" class="img-fluid" />
        </a>
        <a href="javascript:void(0)" class="btn-next social-wall-select-step" data-step="2">
            <img src="{{asset('assets/images/next.png')}}" class="img-fluid" />
        </a>
    </div>
</div>
