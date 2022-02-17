@extends('layouts.front.app')

@section('title', 'A*STAR 30th Anniversary Quiz')

<style>
    .question {
        display: none;
    }
    .question.quction_active {
        display: block;
    }
</style>

@section('content')
    <div class="quiz-block">
        <div class="container">
            <div class="quiz-start-block">
                <div class="container">
                    <div class="quiz-start-subblock">
                        <h6>Welcome to the A<span>*</span>STAR 30th Anniversary Quiz!</h6>
                        <h1>We have interesting A<span>*</span>STAR 30th Anniversary branded gifts such as masks, pins, bags and notebooks to giveaway for participation.</h1>
                        <h6>While stocks last!</h6>
                        <div class="button-block">
                            <a href="#" class="quiz-start-action">
                                <img src="{{asset('assets/images/start.png')}}" class="img-fluid" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="quiz-questions d-none">
                {!! Form::open(['name' => 'quiz_form', 'route' => 'quiz.store', 'method' => 'post', 'id' => 'quiz-form']) !!}
                    <input type="hidden" name="time_remaining" value="" />
                    <input type="hidden" name="token_key" value="{{ config('app.client_key') }}" />
                    <div class="row">
                        <div class="col-md-3">
                            <div class="left-block">
                                <div class="image-block">
                                    <img src="{{ asset('assets/images/quiz-image.png') }}" class="img-fluid" />
                                </div>
                                <h5>Time Remaining:</h5>
                                <div class="timer-block">
                                    <img src="{{ asset('assets/images/timer.png') }}" class="img-fluid" />
                                    <span id="clock">00:00</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="right-block">
                                <div class="owl-carousel owl-theme">
                                    @foreach ($questions as $i => $question)
                                        <div id="que_{{ $i }}" class="item" index={{ $i }}>
                                            <h6>Q{{ $i+1 }} of 10:</h6>
                                            <p>{{ $question->question }}</p>
                                            <ul class="custom-radio-block">
                                                @php $count = 0; @endphp
                                                @foreach (unserialize($question->options) as $j => $option)
                                                    <li class="">
                                                        <label for="que_chk_{{ $question->id.'_'.$j.'_'.$count }}">
                                                            <input type="radio" value="{{ $j }}" id="que_chk_{{ $question->id.'_'.$j.'_'.$count }}" name="que[{{ $question->id }}]"  />
                                                            <span>{{ $option['title'] }}</span>
                                                        </label>
                                                    </li>
                                                    @php $count++; @endphp
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="btn-quiz-complete d-none">
                                    <img src="{{ asset('assets/images/button/complete.png') }}" class="img-fluid"/>
                                </div>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

<div class="modal time-modal" id="timeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <!-- <span class="close" data-bs-dismiss="modal" aria-label="Close">&times;</span> -->
                <div class="image-block">
                    <img src="{{ asset('assets/images/quiz-image.png') }}" class="img-fluid" />
                </div>
                <h5>Time Remaining:</h5>
                <div class="timer-block">
                    <img src="{{ asset('assets/images/timer.png') }}" class="img-fluid" />
                    <span>00:00</span>
                </div>
                <p>Now your time is up</p>
                <button data-bs-dismiss="modal" aria-label="Close" class="btn-ok">
                    <img src="{{asset('assets/images/ok.png')}}" class="img-fluid" />
                </button>
            </div>
        </div>
    </div>
</div>
