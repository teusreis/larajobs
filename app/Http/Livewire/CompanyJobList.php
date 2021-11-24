<?php

namespace App\Http\Livewire;

use App\Models\Job;
use App\Trait\JobSearchFilterTrait;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyJobList extends Component
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

    public function filterJobs()
    {
        $query = Job::query();

        $query->where('company_id', auth()->user()->company->id)
            ->withCount('users');

        $query = $this->filter($query);

        return $query->paginate(10);
    }

    public function render()
    {
        return view('livewire.company-job-list', [
            'jobs' => $this->filterJobs()
        ]);
    }
}
