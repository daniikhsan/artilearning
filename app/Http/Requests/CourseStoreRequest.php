<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseStoreRequest extends FormRequest
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
            'user_id' => 'required',
            'day' => 'required',
            'start_hour' => 'required|between:0,23',
            'start_minute' => 'required|between:0,59',
            'end_hour' => 'required|between:0,23',
            'end_minute' => 'required|between:0,59',
        ];
    }

    public function attributes()
    {
        return [
            'start_hour' => 'hour',
            'start_minute' => 'minute',
            'end_hour' => 'hour',
            'end_minute' => 'minute',
        ];
    }
}
