@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="text-center">Emaildetaljer</h2>
    <br><br><br>
    <div class="row">
        {{-- Member Details --}}
        <div class="col-md-8">
            <div class="row">
                <p class="col-md-3"><strong>Modtager:</strong></p>
                @if($email->group)
                    <p class="col-md-9">{{ $email->group }}</p>
                @else
                    <p class="col-md-9">{{ $email->member->email }}</p>
                @endif
                <p class="col-md-3"><strong>Afsender:</strong></p>
                <p class="col-md-9">{{ $email->user->username }}</p>

                <p class="col-md-3"><strong>Emne</strong></p>
                <p class="col-md-9">{{ $email->subject }}</p>

                <p class="col-md-3"><strong>Besked:</strong></p>
                <p class="col-md-9">{{ $email->message }}</p>

                <p class="col-md-3"><strong>Afsendt:</strong></p>
                <?php Carbon\Carbon::setLocale('da'); ?>
                <p class="col-md-9">{{ $email->created_at->format('j\\. M Y') }}</p>
            </div>
            <a href="{{ route('email.index') }}" class="btn btn-warning btn-sm col-md-1">Tilbage</a>
        </div>
    </div>
</div>
 

@endsection