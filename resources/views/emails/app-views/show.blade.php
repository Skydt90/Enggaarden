@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="text-center">Emaildetaljer</h2>
    <br><br><br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Member Details --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                                <p class="float-left"> Fra: {{ $email->user->username ?? null }} </p>
                                @if($email->group)
                                <p class="float-right"> Til: {{ $email->group }} </p>
                                @else
                                <p class="float-right"> Til: {{ $email->member->email }} </p>
                                @endif
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"> Emne: {{ $email->subject }} </h4>
                            <p class="card-text">
                                {!! $email->message !!}
                            </p>
                            <br>
                            <p class="text-muted">Sendt {{ $email->created_at }}</p>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-12"><br><br></div>
                <a href="{{ route('email.index') }}" class="btn btn-warning btn-sm col-md-1 ml-3">Tilbage</a>
            </div>
        </div>
    </div>
</div>
 

@endsection