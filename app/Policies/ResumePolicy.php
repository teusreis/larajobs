<?php

namespace App\Policies;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

use function PHPUnit\Framework\isNull;

class ResumePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Resume  $resume
     * @return mixed
     */
    public function view(User $user, Resume $resume = null)
    {
        return $user->id === $resume->user_id || $user->isCompany
            ? Response::allow()
            : Response::deny('You don\'t have permission to see this resume!');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user): bool
    {
        return $user->resume()->count() < 5;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Resume  $resume
     * @return mixed
     */
    public function update(User $user, Resume $resume)
    {
        return $user->id === $resume->user_id
            ? Response::allow()
            : Response::deny('You do not have permission to edit this resume!');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Resume  $resume
     * @return mixed
     */
    public function delete(User $user, Resume $resume)
    {
        return $user->id === $resume->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Resume  $resume
     * @return mixed
     */
    public function restore(User $user, Resume $resume)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Resume  $resume
     * @return mixed
     */
    public function forceDelete(User $user, Resume $resume)
    {
        return false;
    }
}
