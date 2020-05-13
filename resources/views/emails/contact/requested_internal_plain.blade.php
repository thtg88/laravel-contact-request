New contact request received.
Details:
@foreach ($data as $attribute => $value)
    @if (! is_string($value))
        @continue
    @endif
    {{ str_replace(['-', '_'], ' ', $attribute) }}: {!! nl2br(htmlspecialchars($data['message'], ENT_QUOTES, 'UTF-8')) !!}
@endforeach
