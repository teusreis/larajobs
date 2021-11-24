<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = "education";

    protected $fillable = [
        'level',
        'course_name',
        'institution_name',
        'stillCoursing',
        'start_date',
        'end_date'
    ];

    public function getLevelAttribute($value)
    {
        return match ($value) {
            1 => 'High school',
            2 => 'bachelor degree',
            3 => 'College',
            4 => 'Master\'s degree',
            5 => 'PHD',
        };
    }

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
