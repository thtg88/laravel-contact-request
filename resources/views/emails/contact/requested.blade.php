@extends(Config::get('laravel-contact-request.mail.views.layout'))
@section('content')
    <p>Dear {{ $data['name'] }},</p>
    <p>We are in receipt of your email regarding your contact request.</p>
    <p>
        This is the data you provided,
        which will be used for our future correspondence:
    </p>
    <ul>
        @foreach ($data as $attribute => $value)
            @if (! is_string($value))
                @continue
            @endif
            <li>
                <strong>{{ str_replace(['-', '_'], ' ', $attribute) }}:</strong>
                {!! nl2br(htmlspecialchars($value, ENT_QUOTES, 'UTF-8')) !!}
            </li>
        @endforeach
    </ul>
    <p>Thanks for your interest, we will contact you shortly.</p>
    <p>Best regards,<p>
    <p>{{ Config::get('laravel-contact-request.mail.signature_name') }}</p>
@endsection
