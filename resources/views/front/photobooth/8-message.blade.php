@extends('layouts.front.app')

@section('title', 'Virtual Photobooth')

@section('content')
    <div class="photobooth-message-block">
        <div class="container">
            <div class="photobooth-message-subblock">
                <div class="row">
                    <div class="col-md-6">
                        <div class="left-block">
                            <img src="{{asset('assets/images/frame-image.png')}}" class="img-fluid frame-image" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-block">
                            <h6>Please enter your message:</h6>
                            <form>
                                <textarea class="form-control">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</textarea>
                            </form>
                            <div class="button-block">
                                <div class="button-subblock">
                                    <a href="{{ url('photobooth-final') }}" class="btn-share-on-social-wall"><img src="{{asset('assets/images/share-on-social-wall.png')}}" class="img-fluid" /></a>
                                </div>
                                <div class="button-subblock">
                                    <a href="{{ url('photobooth-share') }}" class="btn-back"><img src="{{asset('assets/images/back-full.png')}}" class="img-fluid" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
