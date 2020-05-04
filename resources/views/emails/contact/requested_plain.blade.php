Dear {{ $data['name'] }},
We are in receipt of your email regarding your contact request.
This is the data you provided, which will be used for our future correspondence:
Name: {{ $data['name'] }}
Email: {{ $data['email'] }}
Telephone Number: {{ $data['phone'] }}
Message: {!! nl2br(htmlspecialchars($data['message'])) !!}
Thanks for your interest, we will contact you shortly.
Best regards,
{{ Config::get('laravel-contact-request.signature_name') }}
