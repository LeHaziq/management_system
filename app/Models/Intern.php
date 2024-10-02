<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    use HasFactory;

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    protected $fillable = [
        'name',
        'ic',
        'email',
        'education_level',
        'education_institution',
        'year',
        'skill',
        'internship_period',
        'start_date',
        'end_date',
        'photo',
        'resume',
        'status',
    ];
}
