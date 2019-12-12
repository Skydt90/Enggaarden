@component('mail::message')
# {{ $subject }}

{!! $message !!}

Med venlig hilsen,<br>
{{ config('app.name') }}
@endcomponent
