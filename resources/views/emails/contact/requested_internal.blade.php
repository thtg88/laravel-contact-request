@extends('laravel-contact-request::layouts.email')
@section('content')
  <p>New contact request received.</p>
  <p>Details:</p>
  <ul>
    <li><strong>Name:</strong> {{ $data['name'] }}</li>
    <li><strong>Email:</strong> {{ $data['email'] }}</li>
    <li><strong>Telephone Number:</strong> {{ $data['phone'] }}</li>
    <li>
        <strong>Message:</strong>
        {!! nl2br(htmlspecialchars($data['message'])) !!}
    </li>
  </ul>
@endsection
