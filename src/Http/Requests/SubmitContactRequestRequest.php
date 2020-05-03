<?php

namespace Thtg88\LaravelContactRequest\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;

class SubmitContactRequestRequest extends FormRequest
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
        $all_rules = [
            'email' => 'required|string|email|max:255',
            'message' => 'required|string|max:4000',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ];

        if (Config::get('laravel-contact-request.recaptcha.mode') === true) {
            $all_rules['g_recaptcha_response'] = [
                'bail',
                'required_without:g-recaptcha-response',
                'captcha',
            ];
            $all_rules['g-recaptcha-response'] = [
                'bail',
                'required_without:g_recaptcha_response',
                'captcha',
            ];
        }

        return $all_rules;
    }
}
