<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class PharmacyRequest extends FormRequest
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
            'name' => 'required|max:191|min:3',
            'address' => 'required|max:191|min:3',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('pharmacies', 'email')->ignore($this->route('id'))
            ],
            'phone' => [
                'required',
                'regex:/[0-9]{11}/',
                Rule::unique('pharmacies', 'phone')->ignore($this->route('id'))
            ],
            'password' => [
                'nullable',
                'min:6',
                'max:191',
                'required_with:password_confirm',
                'confirmed',
                Rule::requiredIf(function() {
                    return Request::routeIs('pharmacies.store');
                })
            ],
        ];

    }
}
