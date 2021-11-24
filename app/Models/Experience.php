<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $table = 'experience';

    protected $fillable = [
        'position',
        'company_name',
        'description',
        'start',
        'end'
    ];

    public function getPeriodAttribute(): string
    {
        $value = $this->start;

        if (isset($this->end)) {
            $value = $value . " until " . $this->end;
        } else {
            $value = $value . " until the moment";
        }

        return $value;
    }

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
