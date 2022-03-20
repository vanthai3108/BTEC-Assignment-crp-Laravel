<?php

namespace App\Http\Requests\Profile;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'old_pass' => ['required', new MatchOldPassword],
            'pass' => ['required', 'min:8', 'same:password_confirmed'],
            'password_confirmed' => ['required']
        ];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count() > 0) {
                // dd($validator->errors());
                $validator->errors()->add('msg', __('message.profile.update_pass_failed'));
            }
        });
    }
}
