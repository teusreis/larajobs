<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $table = 'resume';

    protected $fillable = [
        'title',
        'description',
        'skills'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function experience()
    {
        return $this->hasMany(Experience::class);
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }
}
