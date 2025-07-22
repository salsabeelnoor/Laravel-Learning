<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobPosted;

class JobController extends Controller
{
    public function index() {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);
        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create() {
        return view('jobs.create');
    }

    public function show(Job $job) {
        return view('jobs.show', ['job' => $job]);
    }

    public function store() {
        request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
        ]);
        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        Mail::to($job->employer->user)->queue(new JobPosted($job));

        return redirect('/jobs');
    }
    
    public function edit(Job $job) {

        // if(Auth::user()->can('edit-job', $job)) {
        //     dd('failure');
        // }
       
        if(Auth::guest()){
            return redirect('/login');
        }

        // Gate::authorize('edit-job', $job);

        // if(Gate::denies('edit-job', $job)) {
        //     abort(403, 'Unauthorized action.');
        // }

        // if($job->employer->user->isNot(Auth::user())) {
        //     abort(403, 'Unauthorized action.');
        // }

        return view('jobs.edit', ['job' => $job]);
    }
    public function update(Job $job) {
        
        //authorize request
        // Gate::authorize('edit-job', $job);

        //validate request
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);
        //update the job
        // $job = Job::findOrFail($id);
        // $job->title = request('title');
        // $job->salary = request('salary');
        // $job->save();
        
        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);

        //redirect
        return redirect('/jobs/'.$job->id);
    }
    public function destroy() {
        
        // authorize
        // Gate::authorize('edit-job', $job);

        //delete
        $job->delete();

        return redirect('/jobs');
    }
}
