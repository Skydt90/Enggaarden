@component('mail::message')
<h2>{{ $subject }}</h2> 

@component('mail::panel')
{!! $message !!}
@endcomponent

Bedste hilsner, <b>{{ Auth::user()->username ?? '' }}</b> <br>
Enggaarden's Venner   
Enggårdsvej 2, Hundborg               
7700 Thisted                
@endcomponent
