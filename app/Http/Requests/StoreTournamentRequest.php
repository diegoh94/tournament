<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\LengthPotencyOfTwo;
use App\Rules\ValidateGender;
use Illuminate\Http\Request;

class StoreTournamentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'name' => 'required|string',
            'gender_id' => 'integer|exists:genders,id',
            'player_ids' => ['required', 'array', 'min:2', new LengthPotencyOfTwo],            
            'player_ids.*' => ['bail', 'integer', 'distinct', 'exists:players,id', new ValidateGender($request->input('gender_id'))]
        ];
    }
}
