@component('mail::message')
<h1 style="text-align: center">Hej {{ $member->first_name }}<br><br></p>
@component('mail::panel')

Du er netop blevet oprettet som medlem i foreningen Enggaardens Venner.
Det betyder du nu har mulighed for at få adgang til vores system og se hvilke oplysninger vi har på dig.
Det eneste du skal gøre er at følge nedstående link for at oprette en bruger.

Vær opmærksom på at dette link udløber om 1 uge
***d. {{ $expire->format('j\\. F Y') }}***,
hvorefter du selv skal kontake os såfremt du ønsker et nyt link.

@component('mail::button', ['url' => $link])
Opret bruger
@endcomponent
@endcomponent

Bedste hilsner,<br>
{{ config('app.name').'\'s' }} Venner   
<br>
Enggårdsvej 2, Hundborg 
<br>               
7700 Thisted                
@endcomponent
