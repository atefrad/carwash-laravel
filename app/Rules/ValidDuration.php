<?php

namespace App\Rules;

use App\Models\Setting;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidDuration implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $timeSlotDuration = Setting::query()->first()->time_slot_duration;

        if($value % $timeSlotDuration !== 0 )
        {
            $fail("The :attribute must be a multiple of {$timeSlotDuration}.");
        }
    }
}
