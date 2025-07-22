<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Models\Job;

// Route::get('/', function () {
//     return view('home');
// });
Route::get('test', function() {

    $job = Job::first();
    TranslateJob::dispatch($job);

    return 'Done';
});


Route::view('/', 'home');

Route::controller(JobController::class)->group(function(){

    Route::get('/jobs','index');

    Route::get('/jobs/create','create');

    Route::get('/jobs/{job}','show')->middleware('auth');

    Route::post('/jobs','store')->middleware('auth');

    Route::get('/jobs/{job}/edit','edit')->middleware('auth')->can('edit', 'job');

    Route::patch('/jobs/{job}','update');

    Route::delete('/jobs/{job}','destroy');
});

// Route::resource('jobs', JobController::class-)->only(['index', 'show']);
// Route::resource('jobs', JobController::class-)->except(['index', 'show'])->middleware('auth');

//AUth
Route::get('/register', [RegisteredUserController::class,'create']);
Route::post('/register', [RegisteredUserController::class,'store']);
Route::get('/login', [SessionController::class,'create'])->name('login');
Route::post('/login', [SessionController::class,'store']);
Route::post('/logout', [SessionController::class,'destroy']);

// Route::get('/contact', function () {
//     return view('contact');
// });

Route::view('/contact', 'contact');

