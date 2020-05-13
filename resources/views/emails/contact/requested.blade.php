@extends(Config::get('laravel-contact-request.mail.views.layout'))
@section('content')
    <p>Dear {{ $data['name'] }},</p>
    <p>We are in receipt of your email regarding your contact request.</p>
    <p>
        This is the data you provided,
        which will be used for our future correspondence:
    </p>
    <ul>
        <li><strong>Name:</strong> {{ $data['name'] }}</li>
        <li><strong>Email:</strong> {{ $data['email'] }}</li>
        <li><strong>Telephone Number:</strong> {{ $data['phone'] }}</li>
        <li>
            <strong>Message:</strong>
            {!! nl2br(htmlspecialchars($data['message'])) !!}
        </li>
    </ul>
    <p>Thanks for your interest, we will contact you shortly.</p>
    <p>Best regards,<p>
    <p>{{ Config::get('laravel-contact-request.mail.signature_name') }}</p>
@endsection
