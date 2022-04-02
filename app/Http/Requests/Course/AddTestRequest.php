<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class AddTestRequest extends FormRequest
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
            'test_id' => ['required', 'exists:tests,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'date' => ['required', 'date', 'after:yesterday'],
            'question_limit' => ['required', 'integer'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
        ];
    }
}
