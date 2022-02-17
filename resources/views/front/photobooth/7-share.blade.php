@extends('layouts.front.app')

@section('title', 'Virtual Photobooth Share')

@section('content')
<div class="photobooth-7 photobooth-share-block">
    <div class="container">
        <div class="photobooth-share-subblock">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-block">
                        <img src="{{asset('storage' . $photobooth['image_path'])}}" class="img-fluid frame-image" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-block">
                        <h6>Nice shot! Do you like this shot?</h6>
                        <h5>Share on:</h5>
                        <ul class="social-block">
                            <li>
                                <a href="#" class="shareOn" data-route="photobooth" data-type="download" data-id="{{ $id }}">
                                    <img src="{{asset('assets/images/social-icon1.png')}}" class="img-fluid" />
                                </a>
                            </li>
                            <li>
                                <a href="#" class="shareOn" data-route="photobooth" data-type="linkedIn" data-id="{{ $id }}">
                                    <img src="{{asset('assets/images/social-icon2.png')}}" class="img-fluid" />
                                </a>
                            </li>
                            <li>
                                <a href="#" class="shareOn" data-route="photobooth" data-type="whatsApp" data-id="{{ $id }}">
                                    <img src="{{asset('assets/images/social-icon3.png')}}" class="img-fluid" />
                                </a>
                            </li>
                            <li>
                                <a href="#" class="shareOn" data-route="photobooth" data-type="twitter" data-id="{{ $id }}">
                                    <img src="{{asset('assets/images/social-icon4.png')}}" class="img-fluid" />
                                </a>
                            </li>
                            <li>
                                <a href="#" class="shareOn" data-route="photobooth" data-type="facebook" data-id="{{ $id }}">
                                    <img src="{{asset('assets/images/social-icon5.png')}}" class="img-fluid" />
                                </a>
                            </li>
                            <li>
                                <a href="#" class="shareOn" data-route="photobooth" data-type="email" data-id="{{ $id }}">
                                    <img src="{{asset('assets/images/social-icon6.png')}}" class="img-fluid" />
                                </a>
                            </li>
                            <?php /* <li>
                                <a href="#" class="shareOn" data-route="photobooth" data-type="instagram" data-id="{{ $id }}">
                                    <img src="{{asset('assets/images/social-icon7.png')}}" class="img-fluid" />
                                </a>
                            </li> */ ?>
                        </ul>
                        <div class="button-block">
                            <div class="button-subblock">
                                <a href="{{ url('photobooth') }}" class="btn-retake">
                                    <img src="{{asset('assets/images/retake.png')}}" class="img-fluid" />
                                </a>
                            </div>
                            <div class="button-subblock">
                                <a href="{{ route('photobooth.share.socialWall', $id) }}" class="btn-share-on-social-wall">
                                    <img src="{{asset('assets/images/share-on-social-wall.png')}}" class="img-fluid" />
                                </a>
                            </div>
                        </div>
                        <h4>Do Tag us with #astar30 <br />when you share your photos.</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
