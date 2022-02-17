@extends('layouts.front.app')

@section('title', 'Virtual Photobooth')

@section('content')
    <div class="photobooth-final-block">
        <div class="container">
            <div class="photobooth-final-subblock">
                <h1>Thank you for submitting your photo and message!</h1>
                <p>Your photo and message will have to be approved by a moderator before it is being posted to the social wall.</p>
                <h6>Thank you for your patience.</h6>
                <div class="button-block">
                    <a href="{{ url('photobooth') }}" class="btn-take-another-photo">
                        <img src="{{asset('assets/images/take-another-photo.png')}}" class="img-fluid" />
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
