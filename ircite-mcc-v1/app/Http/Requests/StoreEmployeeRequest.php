<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'firstName' => ['required', 'string', 'max:50'],
            'lastName' => ['required', 'string', 'max:50'],
            'position' => ['required', 'string', 'max:50'],
            'sickLeaveCredits' => ['required', 'integer'],
            'vacationLeaveCredits' => ['required', 'integer'],
            'hourlyRate' => ['required', 'numeric', 'min:1', 'max:99999999']
        ];
    }
}
