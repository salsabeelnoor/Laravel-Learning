<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});
//create
Route::get('/jobs/create', function() {
    return view('jobs.create');
});
//Show
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});
//Store
Route::post('/jobs', function () {
    //validation
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);
    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);
    return redirect('/jobs');
});
//Edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);
    return view('jobs.edit', ['job' => $job]);
});
//Update
Route::patch('/jobs/{id}', function ($id) {
    //validate request
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    //authorize request
    // ....

    //update the job
    $job = Job::findOrFail($id);
    // $job->title = request('title');
    // $job->salary = request('salary');
    // $job->save();
    
    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);

    //redirect
    return redirect('/jobs/'.$job->id);
});
//Delete
Route::delete('/jobs/{id}', function ($id) {
    // authorize
    // ...

    //delete
    Job::findOrFail($id)->delete();

    return redirect('/jobs');
});
Route::get('/contact', function () {
    return view('contact');
});

