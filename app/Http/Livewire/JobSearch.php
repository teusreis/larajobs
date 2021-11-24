<?php

namespace App\Http\Livewire;

use App\Models\Job;
use App\Trait\JobSearchFilterTrait;
use Livewire\Component;
use Livewire\WithPagination;

class JobSearch extends Component
{
    use WithPagination, JobSearchFilterTrait;

    protected $queryString = ['search', 'location', 'salary'];

    public function mount($search, $location)
    {
        $this->search = $search;
        $this->location = $location;
        $this->isRemote = false;
        $this->salary = '';
    }

    public function filterjobs()
    {
        $query = Job::query();

        $query = $this->filter($query);

        return $query->paginate(10);
    }

    public function render()
    {
        return view('livewire.job-search', [
            'jobs' => $this->filterjobs()
        ]);
    }
}
