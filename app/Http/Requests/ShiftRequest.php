<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShiftRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'pharmacy_id' => 'required|exists:pharmacies,id',
            'day' => 'required|string|max:255|min:5|in:in,saturday,sunday,monday,tuesday,wednesday,thursday',
            'starts_at' => 'required|date_format:g:i A',
            'ends_at' => 'required|date_format:g:i A|after_or_equal:starts_at',
        ];
    }
}
