<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransferStoreRequest extends FormRequest
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
        $benefactor_id = Auth::id();

        $checkBalanceIsEnough = function ($attribute, $value, $fail) {
            if (Auth::user()->wallet->balance < request()->amount)
                $fail('Not enough balance.');
        };

        return [
            'beneficiary_id' => ['required', 'exists:users,id', Rule::notIn([$benefactor_id])],
            'amount' => ['required', 'numeric', 'min:1000', 'max:1000000', 'integer', $checkBalanceIsEnough],
        ];
    }
}
