<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Time extends Model
{
    use HasFactory, SoftDeletes;

    protected static function booted(): void
    {
        static::addGlobalScope('newTimeSlots', function (Builder $builder) {

            $now = Carbon::now();

            $nowHour = $now->hour;

            $workingTime = Setting::query()->first()->working_time;

            $opening_time = $workingTime['opening_time'];
            $closing_time = $workingTime['closing_time'];

            if ($nowHour >= $opening_time && $nowHour < $closing_time) {
                $builder->whereTime('start_time', '>=', $now->toTimeString())
                    ->where('day', '>=', $now->day)
                    ->where('month', '>=', $now->month)
                    ->where('year', '>=', $now->year);

            } else if ($nowHour >= $closing_time && $nowHour < 24) {
                $builder->where('day', '>', $now->day)
                    ->where('month', '>=', $now->month)
                    ->where('year', '>=', $now->year);

            } else {
                $builder->where('day', '>=', $now->day)
                    ->where('month', '>=', $now->month)
                    ->where('year', '>=', $now->year);
            }
        });
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }
}
