<div class="social-wall-step-2 social-wall-step2-block{{ empty($show) ? " d-none" : ""  }}">
    <div class="container">
        <div class="social-wall-step2-subblock">
            <div class="social-wall-top-block">
                <h1>Step 2: Enter your message</h1>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="button-block">
                @if (!empty($route))
                    <a href="{{ $route }}" class="btn-back">
                        <img src="{{ asset('assets/images/back.png') }}" class="img-fluid" />
                    </a>
                @else
                    <a href="#" class="btn-back social-wall-select-step" data-step="1">
                        <img src="{{ asset('assets/images/back.png') }}" class="img-fluid" />
                    </a>
                @endif
                <a href="javascript:void(0)" class="btn-next social-wall-submit">
                    <img src="{{asset('assets/images/social-submit.png')}}" class="img-fluid" />
                </a>
            </div>
        </div>
    </div>
</div>
