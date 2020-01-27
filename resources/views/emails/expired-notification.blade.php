@component('mail::message')
<h1 style="text-align: center">Hej {{ $member->first_name }}</p>
@component('mail::panel')

Dit medlemsskab hos foreningen, Enggaardens Venner, er netop udløbet.
Vi håber meget på, du fortsat ønsker at være medlem, og i såfald kan du forny dit medlemskab på en af tre måder:

1. Betale: <b>{{ $member->subscriptions->get(0)->amount ?? 100 }},-</b> dkk via mobilpay på nr: <b>199588</b>.
2. Overfør beløbet via netbank til konto nr. <b>9129-1295618252</b>
3. Kontakte os på Enggården for at betale beløbet kontant. Ring på <b>97937255</b> eller mail på: <a href="mailto:kontor@enggarden.dk">kontor@enggarden.dk</a> 

<b>Obs:</b><i> Dette er en autogenereret mail og kan ikke besvares.</i>

@endcomponent

Bedste hilsner, <b>{{ Auth::user()->username ?? '' }}</b> <br>  
Enggaarden's Venner <br>  
Enggårdsvej 2, Hundborg  <br> 
7700 Thisted                
@endcomponent
