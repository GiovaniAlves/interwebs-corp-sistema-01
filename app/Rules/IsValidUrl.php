<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class IsValidUrl implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $position = strripos($value, '://');

        // The prefix must be 'http://' or 'https://'
        $prefix = substr($value, 0, $position + 3);

        if (!$position or ($prefix != "http://" and $prefix != "https://")) {
            $fail('Informe uma url válida.');
        }
    }
}
