<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Resume;
use App\Http\Requests\StoreResumeRequest;

class ResumeController extends Controller
{

    public function __construct()
    {
        // $this->authorizeResource(Resume::class, 'resume');
    }

    public function index()
    {
        $resume = Resume::where('user_id', auth()->id())->with(['experience', 'education'])->first();

        $this->authorize('view', $resume);

        return view('resume.index', compact('resume'));
    }

    public function show(Resume $resume)
    {
        $this->authorize('view', $resume);

        $resume->load('user:id,name', 'experience', 'education');

        $jobs = Job::where('status', true)
            ->where('company_id', auth()->user()->company->id)
            ->hasInvited(userId: $resume->user->id)
            ->get();

        $selectedJob = request()->selectedJob ?? null;

        return view('resume.show', compact('resume', 'jobs', 'selectedJob'));
    }

    public function create()
    {
        $this->authorize('create', 'App\Models\Resume');

        return view('resume.create');
    }

    public function store(StoreResumeRequest $request)
    {
        $resume = auth()->user()->resume()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'skills' => $request->input('skills'),
        ]);

        if ($request->company_name) {
            $experiences = [];

            for ($i = 0; $i < count($request->company_name); $i++) {
                $experience = [
                    'position' => $request->position[$i],
                    'company_name' => $request->company_name[$i],
                    'description' => $request->job_description[$i],
                    'start' => $request->start[$i],
                    'end' => $request->end[$i],
                ];

                array_push($experiences, $experience);
            }

            $resume->experience()->createMany($experiences);
        }

        if ($request->level) {
            $education = [];

            for ($i = 0; $i < count($request->level); $i++) {
                $stillCoursing = $request->stillCoursing[$i] === 'on' ? true : false;
                array_push($education, [
                    'level' => $request->level[$i],
                    'course_name' => $request->course_name[$i],
                    'institution_name' => $request->institution_name[$i],
                    'stillCoursing' => $stillCoursing,
                    'start_date' => $request->start_date[$i],
                    'end_date' => $stillCoursing ? null : $request->end_date[$i],
                ]);
            }

            $resume->education()->createMany($education);
        }

        return redirect()
            ->route('resume.index', status: 201)
            ->with('flash', 'Resume created successfully!');
    }

    public function edit(Resume $resume)
    {
        $this->authorize('update', $resume);

        return view('resume.edit', compact('resume'));
    }

    public function update(StoreResumeRequest $request, Resume $resume)
    {
        $this->authorize('update', $resume);

        $resume->experience()->truncate();
        $resume->education()->truncate();

        $resume->update($request->only('title', 'description', 'skill'));

        $experiences = [];

        if ($request->company_name) {
            for ($i = 0; $i < count($request->company_name); $i++) {
                $experience = [
                    'position' => $request->position[$i],
                    'company_name' => $request->company_name[$i],
                    'description' => $request->job_description[$i],
                    'start' => $request->start[$i],
                    'end' => $request->end[$i],
                ];

                array_push($experiences, $experience);
            }

            $resume->experience()->createMany($experiences);
        }

        if ($request->level) {
            $education = [];

            for ($i = 0; $i < count($request->level); $i++) {
                $stillCoursing = $request->stillCoursing[$i] === 'on' ? true : false;
                array_push($education, [
                    'level' => $request->level[$i],
                    'course_name' => $request->course_name[$i],
                    'institution_name' => $request->institution_name[$i],
                    'stillCoursing' => $stillCoursing,
                    'start_date' => $request->start_date[$i],
                    'end_date' => $stillCoursing ? null : $request->end_date[$i],
                ]);
            }

            $resume->education()->createMany($education);
        }

        return redirect()
            ->route('resume.index', status: 201)
            ->with('flash', 'Resume created successfully!')
            ->with('type', 'success');
    }

    public function destroy(Resume $resume)
    {
        $this->authorize('delete', $resume);

        dd($resume);

        $resume->delete();

        return redirect()
            ->route('resume.index')
            ->with('flash', 'Resume deleted successfully!')
            ->with('type', 'success');
    }
}
