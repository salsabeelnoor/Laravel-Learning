<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

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
        Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);
        return redirect('/jobs');
    }
    
    public function edit(Job $job) {
        return view('jobs.edit', ['job' => $job]);
    }
    public function update(Job $job) {
        //validate request
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        //authorize request
        // ....

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
        // ...

        //delete
        $job->delete();

        return redirect('/jobs');
    }
}
