<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LengthPotencyOfTwo implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $lenght = count($value);

        // Simplification of Brian Kernighan algorithm
        return $lenght && !( $lenght & ($lenght-1) );

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The number of players is not a potency of two.';
    }
}
