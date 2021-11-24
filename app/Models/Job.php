<?php

namespace App\Models;

use Carbon\Carbon;
use App\Trait\JobApplicationTrait;
use App\Trait\JobinvitationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Job extends Model
{
    use HasFactory, JobApplicationTrait, JobinvitationTrait;

    protected $fillable = [
        'title',
        'description',
        'salary',
        'isRemote',
        'status',
        'state',
        'address',
        'required_skills',
        'optional_skills',
        'location'
    ];

    public function getSalaryStringAttribute()
    {
        return match ($this->salary) {
            '0' => '0 to $1.000,00',
            '1' => '$1.000,00 to $2.000,00',
            '2' => '$2.000,01 to $3.000,00',
            '3' => '$3.000,01 to $5.000,00',
            '4' => '$5.000,01 to $10.000,00',
            '5' => '$10.000,00 or more!',
            default => 'To combine'
        };
    }

    public function getRequiredSkillsAttribute($value): array
    {
        return explode(';', $value);
    }

    public function getOptionalSkillsAttribute($value): array
    {
        return explode(';', $value);
    }

    public function getLocationAttribute($value): string
    {
        if ($this->isRemote === 1) return "Remote";

        return "{$this->address}, {$this->state}";
    }

    public function getCreatedAtAttribute($value): string
    {
        $d = Carbon::create($value);
        return $d->toFormattedDateString();
    }

    // Relationships
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function invitations(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'invites')->withPivot('message');
    }
}
