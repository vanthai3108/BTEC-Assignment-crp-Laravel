<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'subject_id' => ['required', 'exists:subjects,id'],  
            'semester_id' => ['required', 'exists:semesters,id'],  
            'class_id' => ['required', 'exists:classes,id'],  
            'trainer_id' => ['required', 'exists:users,id'],  
            'date' => ['required', 'date'],
            'status' => ['required']
        ];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count() > 0) {
                $validator->errors()->add('msg', __('message.course.update_failed'));
            }
        });
    }
}
