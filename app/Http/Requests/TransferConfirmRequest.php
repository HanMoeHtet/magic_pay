<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransferConfirmRequest extends FormRequest
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
        $benefactor_phone_number = Auth::user()->phone_number;

        $checkBalanceIsEnough = function ($attribute, $value, $fail) {
            if (Auth::user()->wallet->balance < $value)
                $fail('Not enough balance.');
        };

        return [
            'phone_number' => ['required', 'numeric', 'digits_between:8,13', 'exists:users,phone_number', Rule::notIn([$benefactor_phone_number])],
            'amount' => ['required', 'numeric', 'min:1000', 'max:1000000', 'integer', $checkBalanceIsEnough],
        ];
    }
}
