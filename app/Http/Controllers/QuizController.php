<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use App\Models\Quiz;
use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    private $quizTime = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $count =  Questions::count();

        if($count > 10){
            $count = 10;
        }

        $questions = Questions::all()->random($count);

        return view('front.quiz.index', compact('questions'));
    }

    private function customEncrypter()
    {
        return new Encrypter(base64_decode(config('app.client_key')), config('app.cipher'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $answers = $request->que;
        $score   = 0;

        if($answers){

            foreach ($answers as $key => $ans) {

                $q = Questions::find($key);

                if($q->is_true_option_num == $ans){
                    $score += $q->score;
                }
            }
        }

        $timeRemaining = $this->customEncrypter()->decryptString($request->post('time_remaining'));

        if ($timeRemaining !== "00:00" && $score > 0) {
            $remainingTime = explode(':', $timeRemaining);
            $minutes = trim($remainingTime[0]);
            $seconds = trim($remainingTime[1]);

            $timeScore = intval($minutes) * 60 + $seconds;

            $score += $timeScore;
        }

        if (auth()->check()) {
            Quiz::create([
                'user_id' => auth()->user()->id,
                'answers' => serialize($answers),
                'score' => $score
            ]);

            $userRank = Quiz::select(\DB::raw('quizzes.id, user_id, max(score) as score'))
                ->groupBy('user_id')
                ->orderBy('score', 'desc')
                ->get();

            $getRank = 1;
            foreach ($userRank as $quiz) {
                if ($quiz->user_id === auth()->user()->id) {
                    break;
                }
                $getRank++;
            }
            return redirect()->route('quiz.complete')->with([
                'score' => $score,
                'rank' => $getRank,
            ]);
        }

        return redirect()->route('quiz.complete')->with([
            'score' => $score,
            'rank' => null,
        ]);
    }

    public function leaderboard(Request $request)
    {
        $quizQuery = Quiz::select(\DB::raw('quizzes.id, user_id, max(score) as score'))
            ->where('score', '>', 0)
            ->groupBy('user_id')
            ->orderBy('score', 'desc')
            ->get();

        $quizItems = [];
        if ($quizQuery) {
            $quizData = [];
            foreach ($quizQuery as $key => $value) {
                $quizData[$key] = [
                    'id' => $value->id,
                    'user_id' => $value->user_id,
                    'user_name' => $value->user->name,
                    'score' => $value->score,
                ];
            }

            if (count($quizData) > 10) {
                $quizItems = array_chunk($quizData, 10);
            } else {
                $quizItems = [$quizData];
            }
        }

        return view ('front.quiz.leaderboard',compact('quizItems'));
    }

    public function complete()
    {
        if (session()->has('score')) {
            $score = session()->get('score');
            $rank = session()->get('rank');
            return view('front.quiz.complete', compact('score', 'rank'));
        } else {
            return redirect()->route('quiz');
        }
    }

}
