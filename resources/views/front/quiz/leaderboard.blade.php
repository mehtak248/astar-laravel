@extends('layouts.front.app')

@section('title', 'A*STAR 30th Anniversary Quiz')

@section('content')
    <div class="scoreboard-block">
        <div class="container">
            <div class="scoreboard-subblock">
                <h1>Leaderboard</h1>
                <div class="scoreboard-slider">
                    @if(isset($quizItems) && count($quizItems))
                        @php
                            $i=1;
                        @endphp
                        @foreach($quizItems as $items)
                            <div class="item">
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Position:</th>
                                            <th>Name:</th>
                                            <th>Score:</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($items as $value)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $value['user_name'] }}</td>
                                                <td>{{ $value['score'] }}</td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="item">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Position:</th>
                                            <th>Name:</th>
                                            <th>Score:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Lorem Ipsum</td>
                                            <td>1088</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Lorem Ipsum</td>
                                            <td>988</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Lorem Ipsum</td>
                                            <td>968</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Lorem Ipsum</td>
                                            <td>950</td>
                                        </tr>
                                        <tr>
                                                <td>5</td>
                                                <td>Lorem Ipsum</td>
                                                <td>923</td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="button-block">
                    <a href="{{ route('quiz') }}" class="btn-retake-quiz">
                        <img src="{{asset('assets/images/retake-quiz.png')}}" class="img-fluid" />
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
