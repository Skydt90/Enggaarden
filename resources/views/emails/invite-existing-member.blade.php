@component('mail::message')
<h1 style="text-align: center">Invitation</h1>
@component('mail::panel')

<h2 style="text-align: center">Hej {{ $member->first_name }}</h2>
Som medlem af foreningen Enggaardens Venner, har du nu mulighed for at oprette
en bruger i vores it-system. Denne bruger kan benyttes til at logge ind og se hvilke oplysninger vi har på dig.
Det eneste du skal gøre er at følge nedenstående link, hvorefter du føres over til en registreringsside. 

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