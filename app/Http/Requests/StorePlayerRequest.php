<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlayerRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required', 
            'gender_id' => 'required|integer|in:1,2',
            'skill_level' => 'sometimes|integer|between:1,100',
            'strength' => 'sometimes|integer|between:1,5',
            'velocity_of_displacement' => 'sometimes|integer|between:1,5',
            'reaction_time' => 'sometimes|integer|between:1,5'
        ];
    }
}
