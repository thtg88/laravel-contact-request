<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequestRequest extends FormRequest
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
            'name' => 'bail|required|max:255',
            'email' => 'bail|email|required|max:255',
            'message' => 'bail|required|max:4000',
            'phone' => 'required|max:255',
            'g_recaptcha_response' => [
                'bail',
                'required_without:g-recaptcha-response',
                'captcha',
            ],
            'g-recaptcha-response' => [
                'bail',
                'required_without:g_recaptcha_response',
                'captcha',
            ],
        ];
    }
}
