<?php

namespace App\Http\Requests\Schedule;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use PHPUnit\Framework\Constraint\Count;

class StoreRequest extends FormRequest
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
        $course = Course::where('id', $this->course_id)->first();
        return [
            'course_id' => ['required', 'exists:courses,id'],  
            'shift_id' => ['required', 'exists:shifts,id'],  
            'location_id' => ['required', 'exists:locations,id'],  
            'date' => ['date', 'after:yesterday'],
            'dates' => ['required', 'array'],
            'dates.*' => ['required', 'date', 
                'after_or_equal:'.date('Y-m-d', strtotime($course->start_date)),
                'before_or_equal:'.date('Y-m-d', strtotime($course->end_date)),
            ]
        ];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count() > 0) {
                $validator->errors()->add('msg', __('message.schedule.add_failed'));
            }
        });
    }
}
