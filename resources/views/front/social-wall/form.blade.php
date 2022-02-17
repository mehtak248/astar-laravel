
@extends('layouts.front.app')

@section('title', 'Social Wall')

@section('content')
    <div class="social-wall-step1-block w-100">
        <div class="container">
            {!! Form::open(['name' => 'social-wall_form', 'route' => 'social-wall.store', 'method' => 'post', 'files' => true]) !!}
            <div id="social-wall-steps">
                @include('front.social-wall.step-1')
                @include('front.social-wall.step-2')
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
