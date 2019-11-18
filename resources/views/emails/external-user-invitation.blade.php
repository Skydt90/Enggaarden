<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

<p>Hej {{ $member->first_name ?? 'test_navn' }}</p>

<p>
    Du er registreret som medlem i foreningen Enggaardens Venner. <br>
    Vi har for nyligt fået nyt it-system, hvor alle vores medlemmer står registreret. <br>
    Det betyder du nu har mulighed for at få adgang hertil og se de oplysninger vi har på dig. <br>
    <a href="{{ route('login') }}">login test</a>
</p>

<hr/>