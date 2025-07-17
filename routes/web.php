<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;

// Route::get('/', function () {
//     return view('home');
// });

Route::view('/', 'home');

// Route::controller(JobController::class)->group(function(){

//     Route::get('/jobs','index');

//     Route::get('/jobs/create','create');

//     Route::get('/jobs/{job}','show');

//     Route::post('/jobs','store');

//     Route::get('/jobs/{job}/edit','edit');

//     Route::patch('/jobs/{job}','update');

//     Route::delete('/jobs/{job}','destroy');
// });

Route::resource('jobs', JobController::class);

// Route::get('/contact', function () {
//     return view('contact');
// });

Route::view('/contact', 'contact');

