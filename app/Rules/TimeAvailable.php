<?php

namespace App\Rules;

use App\Models\Time;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TimeAvailable implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(Time::query()->find($value)->count  == 2)
        {
            $fail('The :attribute is not available.');
        }
    }
}
