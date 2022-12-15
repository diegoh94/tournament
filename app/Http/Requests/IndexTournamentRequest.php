<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexTournamentRequest extends FormRequest
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
            'gender_id' => 'sometimes|integer|in:1,2',
            'start_date' => 'sometimes|date_format:d/m/Y',
            'end_date' => 'sometimes|date_format:d/m/Y|after_or_equal:start_date',
        ];
    }
}
