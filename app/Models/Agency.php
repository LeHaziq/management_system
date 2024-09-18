<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address_1',
        'address_2',
        'address_3',
        'state_id',
        'district_id',
        'postcode',
        'phone',
        'email',
    ];

    public function project(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function PICAgency(): HasMany
    {
        return $this->hasMany(PICAgency::class);
    }
}
