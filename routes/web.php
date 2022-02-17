<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('front.landing-home');
});

Route::middleware(['checkin.authenticated'])->group(function () {
    Route::get('/checkin', function () {
        return view('front.checkin');
    })->name('checkin');
});

Route::post('/checkin', [App\Http\Controllers\AuthCheckin::class, 'registration'])->name('checkinSubmit');

Route::get('/gallery', function () {
    return view('front.gallery');
})->name('gallery');

Route::get('/special-thanks', function () {
    return view('front.contact-us');
});

Route::resource('social-wall', App\Http\Controllers\SocialwallController::class);
Route::resource('guest', App\Http\Controllers\GuestConteroller::class);
Route::get('share/{type}/{id}/{download?}', [App\Http\Controllers\ShareOnSocialPage::class, 'share']);

Route::get('/photobooth', function () {
    return view('front.photobooth.index');
})->name('photobooth');

Route::post('/photobooth', [App\Http\Controllers\PhotoboothController::class, 'store'])->name('photobooth.store');
Route::get('/photobooth/share/{id}', [App\Http\Controllers\PhotoboothController::class, 'share'])->name('photobooth.share');

Route::post('/photobooth/share/socialWall/{id}', [App\Http\Controllers\SocialwallController::class, 'sharePhotoboothOnWall'])->name('photobooth.share.socialWall.store');
Route::get('/photobooth/share/socialWall/{id}', function ($id) {
    return view('front.photobooth.share-on-social-wall', ['id' => $id]);
})->name('photobooth.share.socialWall');

Route::get('/social-wall-upload', function () {
    return view('front.social-wall.form');
});

Route::get('/social-wall-final', function () {
    return view('front.social-wall.final');
});

Route::middleware(['checkin'])->group(function () {
    //Route::resource('SocialWall', AdminSocialWallController::class);
    Route::get('/quiz', [App\Http\Controllers\QuizController::class, 'index'])->name('quiz');
    Route::post('/quiz', [App\Http\Controllers\QuizController::class, 'store'])->name('quiz.store');
    Route::get('/quiz/leaderboard', [App\Http\Controllers\QuizController::class, 'leaderboard'])->name('leaderboard');
    Route::get('/quiz/complete', [App\Http\Controllers\QuizController::class, 'complete'])->name('quiz.complete');
});

Auth::routes([
   'register' => false
]);

Route::group(['middleware' => ['admin']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::group(['prefix' => 'admin','as' => 'admin.'], function () {
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

    Route::group(['middleware' => ['admin']], function() {
        Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [App\Http\Controllers\Admin\Dashboard::class, 'index'])->name('dashboard');
        Route::resource('questions', App\Http\Controllers\Admin\QuestionsController::class);
        Route::get('questions/{id}/delQuestion', [App\Http\Controllers\Admin\QuestionsController::class, 'deleteQuestion']);
        Route::resource('socialwall', App\Http\Controllers\Admin\SocialWallController::class);
        Route::get('socialwall/{id}/is_approve', [App\Http\Controllers\Admin\SocialWallController::class, 'postStatus'])->name('poststatus');
        Route::get('socialwall/{id}/postdelete', [App\Http\Controllers\Admin\SocialWallController::class, 'postDelete']);
        Route::get('/leaderboard', [App\Http\Controllers\Admin\QuizLeaderboard::class, 'index'])->name('leaderboard');
        Route::get('/usersList', [App\Http\Controllers\Admin\Users::class, 'index'])->name('users.list');
    });
});

Route::get('oAuth/authorizeInstagram', [App\Http\Controllers\Auth\Facebook::class, 'authorizeInstagram']);
Route::get('auth/instagram/cb', [App\Http\Controllers\Auth\Facebook::class, 'instagramCallback']);
Route::get('instagram/share', [App\Http\Controllers\Auth\Facebook::class, 'shareImage']);

Route::get('oAuth/authorizeFacebook', [App\Http\Controllers\Auth\Facebook::class, 'authorizeFacebook']);
Route::get('auth/facebook/cb', [App\Http\Controllers\Auth\Facebook::class, 'instagramCallback']);
