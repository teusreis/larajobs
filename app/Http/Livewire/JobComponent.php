<?php

namespace App\Http\Livewire;

use App\Models\Job;
use Livewire\Component;

class JobComponent extends Component
{
    public Job $job;

    public function mount($job)
    {
        $this->job = $job;
    }

    public function submit()
    {
        auth()->user()
            ->apply($this->job);
    }

    public function render()
    {
        return view('livewire.job-component');
    }
}
