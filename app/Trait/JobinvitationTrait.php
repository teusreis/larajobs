<?php

namespace App\Trait;

use Illuminate\Database\Eloquent\Builder;


trait JobinvitationTrait
{
    public function scopeHasInvited(Builder $query, $userId)
    {
        $query->leftJoinSub(
            "select job_id, if(id is null, false, true) as hasInvited from invites where user_id = $userId",
            'hasInvited',
            'job_id',
            'id'
        );
    }
}
