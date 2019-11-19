@component('mail::message')
# Invitation

Hej {{ $member->first_name ?? '' }}

Du er netop blevet oprettet som medlem i foreningen Enggaardens Venner.
Det betyder du nu har mulighed for at få adgang til vores system og se hvilke oplysninger vi har på dig.
Det eneste du skal gøre er at følge nedstående link.

@component('mail::button', ['url' => route('login')])
Opret bruger
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
