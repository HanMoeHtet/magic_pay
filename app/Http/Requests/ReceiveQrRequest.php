<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReceiveQrRequest extends FormRequest
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
        $checkBalanceIsEnough = function ($attribute, $value, $fail) {
            if (Auth::user()->wallet->balance < $value)
                $fail('Not enough balance.');
        };

        return [
            'amount' => ['nullable', 'numeric', 'min:1000', 'max:1000000', 'integer', $checkBalanceIsEnough]
        ];
    }
}
