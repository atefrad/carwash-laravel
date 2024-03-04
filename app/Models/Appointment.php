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
        'service_id',
        'phone',
        'name',
        'start_time',
        'finish_time',
        'station',
        'tracking_code'
    ];

    protected $with = [
        'service'
    ];

    //region relation
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }
    //endregion
}
