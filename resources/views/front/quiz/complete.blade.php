@extends('layouts.front.app')

@section('title', 'A*STAR 30th Anniversary Quiz')

@section('content')
    <div class="leaderboard-block">
        <div class="container">
            <div class="leaderboard-subblock">
                <img src="{{asset('assets/images/cup.png')}}" class="img-fluid" />
                <h4>Congratulations! You've achieved a new high score:</h4>
                <h1>{{$score}}</h1>
                <p>
                    @if (!empty($rank))
                        You are ranked <strong>{{ $rank }}</strong> on the leaderboard.&nbsp;
                    @endif
                    Thank you for your participation.
                    @if (!empty($rank))
                        &nbsp;We will get in touch with you regarding your gift.
                    @endif
                </p>
                <div class="button-block">
                    @if (!empty($rank))
                        <a href="{{ route('leaderboard') }}" class="btn-leaderboard">
                            <img src="{{asset('assets/images/leaderboard.png')}}" class="img-fluid" />
                        </a>
                    @else
                        <a href="{{ route('quiz') }}" class="btn-retake-quiz">
                            <img src="{{asset('assets/images/retake-quiz.png')}}" class="img-fluid" />
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
