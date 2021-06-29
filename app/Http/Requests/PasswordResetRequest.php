<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordResetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $old_passwords_match = function ($attribute, $value, $fail) {
            if (Hash::check($value, Auth::user()->password)) {
                $fail('The old password is incorrect.');
            }
        };

        return [
            'old_password' => ['required', $old_passwords_match],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
