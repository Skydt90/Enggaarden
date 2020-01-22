@component('mail::message')
<h1 style="text-align: center">Invitation</h1>
@component('mail::panel')

<h2 style="text-align: center">Hej {{ $member->first_name }}</h2>
Du er netop blevet oprettet som medlem i foreningen Enggaardens Venner.
Det betyder du nu har mulighed for at få adgang til vores system og se hvilke oplysninger vi har på dig.
Det eneste du skal gøre er at følge nedenstående link for at oprette en bruger.

Vær opmærksom på at dette link udløber om 1 uge
***d. {{ $expire->format('j\\. F Y') }}***,
hvorefter du selv skal kontake os såfremt du ønsker et nyt link.

@component('mail::button', ['url' => $link])
Opret bruger
@endcomponent
@endcomponent

Bedste hilsner, <b>{{ Auth::user()->username ?? '' }}</b> <br>
Enggaarden's Venner   
Enggårdsvej 2, Hundborg               
7700 Thisted                
@endcomponent
