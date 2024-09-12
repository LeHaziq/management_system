<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $casts = [
        'price' => MoneyCast::class,
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    protected $fillable = [
        'title',
        'agency',
        'pic_agency',
        'contract_period',
        'warranty_period',
        'start_date',
        'end_date',
        'price',
        'SST_file',
        'notes',
        'creator',
        'status',
    ];
}
