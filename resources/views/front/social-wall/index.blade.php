@extends('layouts.front.app')

@section('title', 'Social Wall')

@section('content')
    <div class="social-wall-block">
        <div class="container">
            <div class="social-wall-heading-block">
                <div class="row">
                    <div class="col-md-8 col-lg-9">
                        <div class="left-block">
                            <h4>Share a message or photo to celebrate A*STAR's 30th Anniversary!</h4>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="right-block">
                            <a href="{{ url('social-wall-upload') }}">
                                <img src="{{asset('assets/images/share.png')}}" class="img-fluid" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social-wall-subblock">
                <div class="masonry">
                    @if(isset($social_walls) && count($social_walls))
                        @foreach ($social_walls as $value)
                            <div class="item-wrapper">
                                <div class="item">
                                    <h1>{{ (!empty($value->user->name) ? $value->user->name : '') }}</h1>
                                    <img src="{{ asset('storage/images/social-wall/'.$value->image) }}" class="img-fluid "/>
                                    <p>{{ $value->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="item-wrapper">
                            <div class="item">
                                <h1>John Tan</h1>
                                <img src="{{asset('assets/images/social-wall-image.png')}}" class="img-fluid" />
                                <p>Lorem ipsum dolor sit amet lorem ipsum</p>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item">
                                <h1>Jane lee</h1>
                                <img src="{{asset('assets/images/social-wall-image.png')}}" class="img-fluid" />
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item">
                                <h1>Amy Tan</h1>
                                <img src="{{asset('assets/images/social-wall-image.png')}}" class="img-fluid" />
                                <p>Lorem ipsum dolor sit amet lorem ipsum</p>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item">
                                <h1>Agnes ng</h1>
                                <img src="{{asset('assets/images/social-wall-image.png')}}" class="img-fluid" />
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item">
                                <h1>Jane lee</h1>
                                <img src="{{asset('assets/images/social-wall-image.png')}}" class="img-fluid" />
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item">
                                <h1>John Tan</h1>
                                <img src="{{asset('assets/images/social-wall-image.png')}}" class="img-fluid" />
                                <p>Lorem ipsum dolor sit amet lorem ipsum</p>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item">
                                <h1>Agnes ng</h1>
                                <img src="{{asset('assets/images/social-wall-image.png')}}" class="img-fluid" />
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item">
                                <h1>Amy Tan</h1>
                                <img src="{{asset('assets/images/social-wall-image.png')}}" class="img-fluid" />
                                <p>Lorem ipsum dolor sit amet lorem ipsum</p>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item">
                                <h1>John Tan</h1>
                                <img src="{{asset('assets/images/social-wall-image.png')}}" class="img-fluid" />
                                <p>Lorem ipsum dolor sit amet lorem ipsum</p>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item">
                                <h1>Jane lee</h1>
                                <img src="{{asset('assets/images/social-wall-image.png')}}" class="img-fluid" />
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item">
                                <h1>Amy Tan</h1>
                                <img src="{{asset('assets/images/social-wall-image.png')}}" class="img-fluid" />
                                <p>Lorem ipsum dolor sit amet lorem ipsum</p>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item">
                                <h1>Agnes ng</h1>
                                <img src="{{asset('assets/images/social-wall-image.png')}}" class="img-fluid" />
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item">
                                <h1>John Tan</h1>
                                <img src="{{asset('assets/images/social-wall-image.png')}}" class="img-fluid" />
                                <p>Lorem ipsum dolor sit amet lorem ipsum</p>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item">
                                <h1>Jane lee</h1>
                                <img src="{{asset('assets/images/social-wall-image.png')}}" class="img-fluid" />
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item">
                                <h1>Amy Tan</h1>
                                <img src="{{asset('assets/images/social-wall-image.png')}}" class="img-fluid" />
                                <p>Lorem ipsum dolor sit amet lorem ipsum</p>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item">
                                <h1>Agnes ng</h1>
                                <img src="{{asset('assets/images/social-wall-image.png')}}" class="img-fluid" />
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
