@extends('layouts.front.app')

@section('title', 'Social Wall')

@section('content')
    <div class="social-wall-final-block">
        <div class="container">
            <div class="social-wall-final-subblock">
                <h1>Thank you for submitting your photo and message!</h1>
                <p>Your photo and message will have to be approved by a moderator before it is being posted to the social wall.</p>
                <h6>Thank you for your patience.</h6>
                <div class="button-block">
                    <a href="{{ url('social-wall') }}" class="btn-back-to-social-wall">
                        <img src="{{asset('assets/images/back-to-social-wall.png')}}" class="img-fluid" />
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
