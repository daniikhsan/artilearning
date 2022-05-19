<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LecturerStoreRequest extends FormRequest
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
            'id_number' => 'required|unique:users',
            'name' => 'required',
            'email' => 'required|unique:users',
            'gender' => 'required',
            'birthplace' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required',
            'religion' => 'required',
            'major' => 'required'
        ];
    }
}
