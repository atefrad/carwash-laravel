<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'user_id',
        'total_price',
        'tracking_code'
    ];

    protected $with = [
        'user',
        'services',
        'times'
    ];

    //region relation
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function times(): BelongsToMany
    {
        return $this->belongsToMany(Time::class);
    }
    //endregion

    //region scope
    public function scopeFilterService(Builder $query): void
    {
        $query->when(request()->filled('service'), function (Builder $query) {
            $query->whereHas('services',
                fn(Builder $query) => $query->where('id', request('service')));
        });
    }

    public function scopeFilterTime(Builder $query): void
    {
        $query->when(request()->filled('time'), function (Builder $query) {

            $timeArray = explode('-', request('time'));

            $query->whereHas('times',
                fn (Builder $query) => $query
                    ->where('day', $timeArray[2])
                    ->where('month', $timeArray[1])
                    ->where('year', $timeArray[0]));
        });
    }

    public function scopeFilterUser(Builder $query): void
    {
        $query->when(request()->filled('user'),
            fn (Builder $query) => $query->where('user_id', request('user')));
    }
    //endregion
}
