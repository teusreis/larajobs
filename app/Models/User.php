<?php

namespace App\Models;

use App\Trait\UserJobTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, UserJobTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'isCompany'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function application()
    {
        return $this->belongsToMany(Job::class)->withPivot('created_at');
    }

    public function resume()
    {
        return $this->hasOne(Resume::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'company_id');
    }

    public function invitations()
    {
        return $this->belongsToMany(Job::class, 'invites')
            ->withPivot(['message', 'created_at']);
    }
}
