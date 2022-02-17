@extends('layouts.front.app-home')

@section('title', 'Home')

@section('content')
    <a href="{{ auth()->check() ? route('gallery') : 'javascript:;' }}" target="_blank" class="btn-enter" {{ auth()->check() ? '' : 'data-bs-toggle=modal data-bs-target=#checkinModal' }}>
        <img src="{{asset('assets/images/enter.png')}}" class="img-fluid" />
    </a>
    @if (!auth()->check())
        <div class="modal checkin-modal" id="checkinModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="banner-block">
                            <div class="container">
                                <div class="common-block">
                                    <span class="close" data-bs-dismiss="modal" aria-label="Close">&times;</span>
                                    <div class="quiz-checkin-block">
                                        <div class="container">
                                            <div class="quiz-checkin-subblock">
                                                <p>We would appreciate it if you could check in for our records and no personal details will be collected unless consent is given to be on our mailing list. Thank you!</p>
                                                <h1>Guest Check-In</h1>
                                                <div class="quiz-checkin-form-block">
                                                    {!! Form::open(['name' => 'checkin_form_home', 'route' => 'checkinSubmit', 'method' => 'post']) !!}
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>First Name<sup>*</sup></label>
                                                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Email Address<sup>*</sup></label>
                                                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" />
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Age Group<sup>*</sup></label>
                                                                    <div class="select-box">
                                                                        <select name="age_group" class="form-control">
                                                                            <option value="1">0-20</option>
                                                                            <option value="2">20-40</option>
                                                                            <option value="3">40-60</option>
                                                                            <option value="4">60-80</option>
                                                                            <option value="5">80 And Above</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Designation<sup>*</sup></label>
                                                                    <input type="text" name="designation" class="form-control" value="{{ old('designation') }}" />
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Organization/School<sup>*</sup></label>
                                                                    <input type="text" name="school" class="form-control" value="{{ old('school') }}" />
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>How did you get to know about the website?<sup>*</sup></label>
                                                                    <div class="select-box">
                                                                        <select name="know_about" class="form-control">
                                                                            <option value="1">Social Site</option>
                                                                            <option value="2">Email OR Newsletter</option>
                                                                            <option value="3">Friends</option>
                                                                            <option value="4">Others</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Mailing Address<sup>*</sup></label>
                                                                    <input type="text" name="mailing_address" class="form-control" value="{{ old('mailing_address') }}" required />
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group checkbox-group">
                                                                    <input type="checkbox" name="acknowledge" id="acknowledge">
                                                                    <label for="acknowledge">I acknowledge that my personal details will be collected<sup>*</sup></label>
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group checkbox-group">
                                                                    <input type="checkbox" name="subscribed" id="mail-list">
                                                                    <label for="mail-list">Subscribe to mailing list</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group button-group">
                                                                    <a href="{{ url('gallery') }}" class="btn-skip" target="_blank">
                                                                        <img src="{{asset('assets/images/skip.png')}}" class="img-fluid" />
                                                                    </a>
                                                                    <button type="submit" class="btn-submit">
                                                                        <img src="{{asset('assets/images/submit.png')}}" class="img-fluid" />
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group content-group">
                                                                    <p>*you will receive a gift for your participation in the quiz if you leave your details here in the guest check-in page</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
