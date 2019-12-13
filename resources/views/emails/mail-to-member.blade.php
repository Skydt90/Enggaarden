@component('mail::message')
# {{ $subject }}

{!! $message !!}

<br>
{{ config('app.name') }}
@endcomponent
