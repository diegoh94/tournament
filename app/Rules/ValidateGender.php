<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Player;

class ValidateGender implements Rule
{
    private $gender_tournament_id;

    public function __construct($gender_tournament_id)
    {
        $this->gender_tournament_id = $gender_tournament_id;
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
        $gender_id = Player::find($value)->gender_id;
        return $gender_id == $this->gender_tournament_id;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'All players must be of the same gender and match the gender established in the tournament.';
    }
}
