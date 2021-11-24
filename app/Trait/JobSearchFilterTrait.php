<?php

namespace App\Trait;

use Illuminate\Database\Eloquent\Builder;

trait JobSearchFilterTrait
{
    public $search;
    public $location;
    public $salary;
    public bool $isRemote;

    public function filter(Builder $query): Builder
    {
        $search = explode(' ', trim($this->search));

        foreach ($search as $item) {
            $value = "%" . $item . "%";
            $query->Where(function ($subQuery) use ($value) {
                $subQuery->orWhere('title', 'like', $value)
                    ->orWhere('description', 'like', $value);
            });
        }

        if (!empty($this->salary)) {
            $query->where('salary', $this->salary);
        }

        if (!empty($this->location)) {
            $query->where(function ($subQuery) {
                $subQuery->where('address', 'like', "%{$this->address}%")
                    ->orWhere('state', 'like', "%{$this->address}%");
            });
        }

        if ($this->isRemote) $query->where('isRemote', $this->isRemote);

        return $query;
    }
}
