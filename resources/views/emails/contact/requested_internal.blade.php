@extends(Config::get('laravel-contact-request.mail.views.layout'))
@section('content')
    <p>New contact request received.</p>
    <p>Details:</p>
    <ul>
        @foreach ($data as $attribute => $value)
            @if (
                ! is_string($value) ||
                in_array($attribute, [
                    'g_recaptcha_response',
                    'g-recaptcha-response',
                ])
            )
                @continue
            @endif
            <li>
                <strong>{{
                    ucwords(str_replace(['-', '_'], ' ', $attribute))
                }}:</strong>
                {!! nl2br(htmlspecialchars($value, ENT_QUOTES, 'UTF-8')) !!}
            </li>
        @endforeach
    </ul>
@endsection
