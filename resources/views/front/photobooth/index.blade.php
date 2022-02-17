@extends('layouts.front.app')

@section('title', 'Virtual Photobooth')

@section('content')
    {!! Form::open(['name' => 'photobooth_form', 'route' => 'photobooth.store', 'method' => 'post', 'files' => true]) !!}
    <div id="photobooth-steps">
        @include('front.photobooth.1-start')
        @include('front.photobooth.2-select-photo')
        @include('front.photobooth.3-select-option')
        @include('front.photobooth.4-capture-image')
        @include('front.photobooth.4-upload-image')
        @include('front.photobooth.5-select-frame')
        @include('front.photobooth.6-select-sticker')
    </div>
    <div class="background-loader">
        <img src="{{ asset('assets/images/loader-circular.gif') }}" alt="loader" />
    </div>
    {!! Form::close() !!}
@endsection
