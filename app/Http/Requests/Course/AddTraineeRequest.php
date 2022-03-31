<?php

namespace App\Http\Requests\Course;

use App\Rules\Trainee;
use Illuminate\Foundation\Http\FormRequest;

class AddTraineeRequest extends FormRequest
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
            'users' => ['required', 'array'],
            'users.*' => ['required', 'exists:users,id']
        ];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count() > 0) {
                $validator->errors()->add('msg', __('message.course.add_trainee_failed'));
            }
        });
    }
}
