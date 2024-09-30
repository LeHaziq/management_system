<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'letter',
        'education_level',
        'education_year',
        'school_university',
        'skills',
        'university',
        'training_period',
        'start_date',
        'end_date',
        'picture',
        'resume',
        'status',
    ];

    protected $casts = [
        'skills' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
