<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Time extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'start_time',
        'finish_time',
        'day',
        'month',
        'year',
        'count',
    ];

    //region scope
    public function scopeActive(Builder $query): void
    {
        $query->where('count', '<', 2);
    }

    public function scopeNewTimeSlots(Builder $query): void
    {
        $now = Carbon::now();

        $nowHour = $now->hour;

        $workingTime = Setting::query()->first()->working_time;

        $opening_time = $workingTime['opening_time'];
        $closing_time = $workingTime['closing_time'];

        if ($nowHour >= $opening_time && $nowHour < $closing_time) {
            $query->whereTime('start_time', '>=', $now->toTimeString())
                ->where('day', '=', $now->day)
                ->where('month', '=', $now->month)
                ->where('year', '=', $now->year)
                ->orWhere('day', '>', $now->day)
                ->where('month', '>=', $now->month)
                ->where('year', '>=', $now->year);


        } else if ($nowHour >= $closing_time && $nowHour < 24) {
            $query->where('day', '>', $now->day)
                ->where('month', '>=', $now->month)
                ->where('year', '>=', $now->year);

        } else {
            $query->where('day', '>=', $now->day)
                ->where('month', '>=', $now->month)
                ->where('year', '>=', $now->year);
        }
    }
    //endregion

    //region accessor
    protected function dateTime(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->attributes['year'] . '-' .
                $this->attributes['month'] . '-' .
                $this->attributes['day'] . ' ' .
                substr($this->attributes['start_time'], 0, 5)
        );
    }
    //endregion
}
