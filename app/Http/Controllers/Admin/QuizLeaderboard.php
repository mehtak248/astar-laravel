<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\QuizPlayedDataTable;
use App\Http\Controllers\Controller;

class QuizLeaderboard extends Controller
{
    /**
     * @param QuizPlayedDataTable $dataTable
     * @return mixed
     */
    public function index(QuizPlayedDataTable $dataTable)
    {
        return $dataTable->render('admin.quiz.leaderboard');
    }
}
