<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'agency_id',
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

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }

    public function milestone(): HasMany
    {
        return $this->hasMany(ProjectMilestone::class);
    }

    public function assignment(): HasMany
    {
        return $this->hasMany(ProjectAssignment::class);
    }
}
