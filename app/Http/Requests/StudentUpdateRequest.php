<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
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
            'id_number' => 'required|unique:users,id_number,'.$this->student->id,
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$this->student->id,
            'gender' => 'required',
            'birthplace' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required',
            'religion' => 'required',
            'major' => 'required'
        ];
    }
}
