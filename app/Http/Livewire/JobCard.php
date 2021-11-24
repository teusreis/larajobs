<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JobCard extends Component
{
    public $job;

    protected $listeners = ['tooggleStatus'];

    public function mount($job)
    {
        $this->job = $job;
    }

    public function tooggleStatus()
    {
        $newStatus = $this->job->status ? false : true;

        $this->job->update([
            'status' => $newStatus
        ]);

        $message = $newStatus
            ? 'Job activated successfully!'
            : 'Job disabled successfully!';

        session()->flash('flash', $message);
    }

    public function render()
    {
        return view('livewire.job-card');
    }
}
