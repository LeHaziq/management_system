<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveApplication extends Model
{
    use HasFactory;

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    protected $fillable = [
        'intern_id',
        'reason',
        'start_date',
        'end_date',
        'leave_duration',
        'status',
    ];

    public function intern(): BelongsTo
    {
        return $this->belongsTo(Intern::class);
    }
}
