<?php

namespace App\Trait;

use App\Models\Job;

trait UserJobTrait
{
    public function hasApplied(int $id): bool
    {
        return auth()->user()
            ->application()
            ->where('job_id', $id)
            ->exists();
    }

    public function apply(Job $job)
    {
        return auth()->user()
            ->application()
            ->attach($job);
    }
}
