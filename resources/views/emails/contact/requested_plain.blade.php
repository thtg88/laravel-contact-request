Dear {{ $data['name'] }},
We are in receipt of your email regarding your contact request.
This is the data you provided, which will be used for our future correspondence:
@foreach ($data as $attribute => $value)
    @if (
        ! is_string($value) ||
        in_array($attribute, ['g_recaptcha_response', 'g-recaptcha-response'])
    )
        @continue
    @endif
    {{ ucwords(str_replace(['-', '_'], ' ', $attribute)) }}: {!!
        nl2br(htmlspecialchars($data['message'], ENT_QUOTES, 'UTF-8'))
    !!}
@endforeach
Thanks for your interest, we will contact you shortly.
Best regards,
{{ Config::get('laravel-contact-request.mail.signature_name') }}
