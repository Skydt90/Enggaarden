@component('mail::message')
<h1 style="text-align: center">Hej {{ $member->first_name }}<br><br></p>
@component('mail::panel')

Dit betalte medlemsskab hos foreningen enggaardens venner, er desværre udløbet.
Såfremt du fortsat ønsker at være medlem bedes du betale {{ $member->subscriptions[0]->amount}} kroner snarest muligt.

@endcomponent

Bedste hilsner,<br>
{{ config('app.name').'\'s' }} Venner   
<br>
Enggårdsvej 2, Hundborg 
<br>               
7700 Thisted                
@endcomponent
