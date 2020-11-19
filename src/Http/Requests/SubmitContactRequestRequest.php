<?php

namespace Thtg88\ContactRequest\Http\Requests;

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
        $all_rules = Config::get('contact-request.validation_rules');

        if (Config::get('contact-request.recaptcha_mode') === true) {
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
