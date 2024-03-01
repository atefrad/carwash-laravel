<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BetweenNineAndTwentyOne implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($value)
        {
            $hour = substr($value, 11, 2);

            if (!($hour >= 9 && $hour < 21) ) {
                $fail('The :attribute must be between 9 AM and 9 PM .');
            }
        }

    }
}
