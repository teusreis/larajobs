<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Requests\StoreInviteRequest;
use App\Models\Invite;

class InviteController extends Controller
{
    public function index()
    {

        $invites = auth()
            ->user()
            ->invitations()
            ->paginate(10);

        return view('invite.index', compact('invites'));
    }

    public function store(StoreInviteRequest $request)
    {
        $data = $request->validated();

        $job = Job::findOrFail($data['job']);

        $this->authorize('create', ['App\Models\Invite', $job]);

        Invite::create([
            'job_id' => $job->id,
            'user_id' => $data['user_id'],
            'message' => $data['message']
        ]);

        return back()->with('flash', 'Invite sent successfully!');
    }
}
