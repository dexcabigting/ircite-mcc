<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'firstName' => ['string', 'max:50'],
            'lastName' => ['string', 'max:50'],
            'position' => ['string', 'max:50'],
            'sickLeaveCredits' => ['integer'],
            'vacationLeaveCredits' => ['integer'],
            'hourlyRate' => ['numeric', 'min:1', 'max:99999999']
        ];
    }
}
