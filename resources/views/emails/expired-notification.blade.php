@component('mail::message')
<h1 style="text-align: center">Hej {{ $member->first_name }}</p>
@component('mail::panel')

Dit medlemsskab hos foreningen, Enggaardens Venner, er netop udløbet.  
Såfremt du fortsat ønsker at være medlem bedes du kontakte os snarest muligt, for at finde ud af hvordan du kan forny dit medlemsskab
på tlf: ***{{ env('PHONE') }}***

<i><b>Obs:</b> Dette er en autogenereret mail og kan ikke besvares.</i>

@endcomponent

Bedste hilsner, <br>  
Enggaarden's Venner <br>  
Enggårdsvej 2, Hundborg  <br> 
7700 Thisted                
@endcomponent
