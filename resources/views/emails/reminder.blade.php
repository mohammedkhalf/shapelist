@extends('emails.layouts.app')
@section('content')

<h2>hello reminder test 123</h2>
<p>this is a reminder email ....</p>
Thanks,<br>
{{ config('app.name') }}
@endsection
{{-- @component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}
