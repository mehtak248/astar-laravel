@extends('layouts.front.app')

@section('title', 'Social Wall')

@section('content')
    <div class="social-wall-step1-block w-100">
        <div class="container">
            {!! Form::open(['name' => 'social-wall_form', 'route' => ['photobooth.share.socialWall.store', $id], 'method' => 'post']) !!}
            <div id="social-wall-steps">
                @include('front.social-wall.step-2', ['show' => true, 'route' => url()->previous()])
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
