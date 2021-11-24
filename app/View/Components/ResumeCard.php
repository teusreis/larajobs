<?php

namespace App\View\Components;

use App\Models\Resume;
use Illuminate\View\Component;

class ResumeCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public Resume $resume,
        public int|null $selectedJob = null
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.resume-card');
    }
}
