<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'phone',
        'name',
        'total_price',
        'tracking_code'
    ];

    protected $with = [
        'services',
        'times'
    ];

    //region relation
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function times(): BelongsToMany
    {
        return $this->belongsToMany(Time::class);
    }
    //endregion
}
