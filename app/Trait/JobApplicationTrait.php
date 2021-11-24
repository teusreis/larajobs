<?php

namespace App\Trait;

trait JobApplicationTrait
{
    public function getAppliCountAttribute(): int
    {
        return $this->users()->count();
    }
}
