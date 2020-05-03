New contact request received.
Details:
Name: {{ $data['name'] }}
Email: {{ $data['email'] }}
Telephone Number: {{ $data['phone'] }}
Message: {!! nl2br(htmlspecialchars($data['message'])) !!}
@endsection
