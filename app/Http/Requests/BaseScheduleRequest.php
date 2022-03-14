<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseScheduleRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->limit ? '' :
        $this->merge(
            [
                'limit' => config('common.schedule.limit')
            ]
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'limit' => ['integer', 'min:2'],
            'page' => ['integer', 'min:1']
        ];
    }
}
