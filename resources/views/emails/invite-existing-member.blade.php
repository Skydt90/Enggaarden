@component('mail::message')
# Invitation

Hej {{ $member->first_name ?? '' }}

Du er registreret som medlem i foreningen Enggaardens Venner.
Vi har for nyligt fået nyt it-system, hvor alle vores medlemmer står registreret.
Det betyder du nu har mulighed for at få adgang hertil og se de oplysninger vi har på dig.

@component('mail::button', ['url' => route('login')])
Opret bruger
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
