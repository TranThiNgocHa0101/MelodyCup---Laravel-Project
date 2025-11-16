<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\admin\SongCompetitionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\AdminRedirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\SongController;
use App\Http\Controllers\FeedbackController;
use App\Models\Song;

use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ScoreController1;
use App\Http\Controllers\ScoreController2;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [DashboardController::class, 'home']);


Route::group(['prefix' => 'account'], function() {
    Route::group(['middleware' => 'guest'], function() { 
        Route::get('login', [LoginController::class, 'index'])->name('account.login');
        Route::get('register', [LoginController::class, 'register'])->name('account.register');
        Route::post('process-register', [LoginController::class, 'processRegister'])->name('account.processRegister');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');

        Route::get('forgot-password', [LoginController::class, 'forgotPassForm'])->name('account.forgotPass');
        Route::post('forgot-password', [LoginController::class, 'processForgotPass'])->name('account.processForgotPass');
        Route::get('reset-password/{email}', [LoginController::class, 'resetPasswordForm'])->name('account.resetPasswordForm');
        Route::post('process-reset-password', [LoginController::class, 'processResetPassword'])->name('account.processResetPassword');

    });
    Route::group(['middleware' => 'auth'], function(){
        Route::post('logout', [LoginController::class, 'logout'])->name('account.logout');
    });
});

Route::prefix('admin')->group(function () {

    Route::get('dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboardAd');   
    Route::get('dashboard/customer', [AdminController::class, 'index'])->name('admin.tableUser');  
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit'); 
    Route::put('/update/{id}', [AdminController::class, 'update'])->name('admin.update'); // Định nghĩa route update  
    Route::delete('/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/get-monthly-signups', [AdminController::class, 'getMonthlySignups']);

    Route::get('/songs', [SongController::class, 'index'])->name('admin.listSong');
    Route::post('/songs', [SongController::class, 'store'])->name('songs.store');
    Route::get('/songs/edit/{id}', [SongController::class, 'edit'])->name('admin.editSong'); 
    Route::put('/songs/update/{id}', [SongController::class, 'update'])->name('admin.updateSong'); // Định nghĩa route update  
    Route::delete('/songs/destroy/{id}', [SongController::class, 'destroy'])->name('admin.destroySong');
    
    Route::get('/songs/competition', [SongCompetitionController::class, 'index'])->name('admin.songCompetition');
    Route::post('/songs/competition', [SongCompetitionController::class, 'store'])->name('competition.store');
    Route::get('/songs/competition/edit/{id}', [SongCompetitionController::class, 'edit'])->name('admin.editCompetition'); 
    Route::put('/songs/competition/update/{id}', [SongCompetitionController::class, 'update'])->name('admin.updateCompetition'); // Định nghĩa route update  
    Route::delete('/songs/competition/destroy/{id}', [SongCompetitionController::class, 'destroy'])->name('admin.destroyCompetition');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
});

Route::resource('songs', SongController::class);
Route::get('/practice', [SongController::class, 'indexForUser'])->name('practice');
Route::get('/songs/{id}/notes', [SongController::class, 'getNotes']);
Route::get('/pianovitual/{id}/notes1', [SongCompetitionController::class, 'getNotes1']);
Route::get('/competition', [SongCompetitionController::class, 'indexForUser1'])->name('competition');
Route::get('/learn', [DashboardController::class, 'learn'])->name('study');
Route::get('/practice/{id}', [SongController::class, 'show'])->name('practice.show');
Route::get('/user/results', [SongController::class, 'searchResults']);

Route::post('/save-score', [ScoreController::class, 'saveScore'])->name('saveScore');


Route::get('/ranktable', [ScoreController1::class, 'showLeaderboard1'])->name('ranktable');


Route::get('/activity', [ScoreController2::class, 'showLeaderboard2'])->name('activity');


Route::get('/rank', [ScoreController::class, 'showLeaderboard'])->name('show.rank');






use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'sendEmail'])->name('contact.form'); 
Route::get('/messages', [ContactController::class, 'showMessages'])->name('messages.index');

use Illuminate\Support\Facades\DB;

Route::get('/api/scores', function () {
    $data = DB::table('scores')->select('user_id', DB::raw('SUM(score) as total_score'))
        ->groupBy('user_id')
        ->get();

    $totalScore = $data->sum('total_score');

    // Tính tỷ lệ phần trăm
    $result = $data->map(function ($item) use ($totalScore) {
        $item->percentage = ($totalScore > 0) ? round(($item->total_score / $totalScore) * 100, 2) : 0;
        return $item;
    });

    return response()->json($result);
});

