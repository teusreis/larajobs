<?php

namespace App\View\Components\Resume;

use App\Models\Resume;
use Illuminate\View\Component;

class ResumeShow extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public Resume $resume
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.resume.resume-show');
    }
}
