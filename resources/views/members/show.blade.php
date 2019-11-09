@extends('layouts.app')

@section('content')

    <div class="container">

        <h2 class="text-center">Medlemsdetaljer</h2>
        <br><br><br>

        <div class="row">
            {{-- Member Details --}}
            <div class="col-md-8">
                <div class="row">
                    <p class="col-md-3"><strong>Navn:</strong></p>
                    <p class="col-md-9">Christian Grye Skydt</p>

                    <p class="col-md-3"><strong>Adresse:</strong></p>
                    <p class="col-md-9">Nordre Fasanvej 194 1 TV. 2000 Frederiksberg</p>

                    <p class="col-md-3"><strong>Email</strong></p>
                    <p class="col-md-9">Christian_skydt@hotmail.com</p>

                    <p class="col-md-3"><strong>Medlemstype:</strong></p>
                    <p class="col-md-9">Primær</p>

                    <p class="col-md-3"><strong>Telefon:</strong></p>
                    <p class="col-md-9">27131428</p>

                    <p class="col-md-3"><strong>Kontingent:</strong></p>
                    <p class="col-md-9">Ikke betalt</p>

                    <p class="col-md-3"><strong>Medlem siden:</strong></p>
                    <p class="col-md-9">{{ today()->subDays(30)->format('j\\. F Y') }}</p>

                    <p class="col-md-3"><strong>Bestyrelsesmedlem:</strong></p>
                    <p class="col-md-9">Nej</p>
                </div>
            </div>
            {{-- Payments --}}
            <div class="col md-4">            
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Betalingsoversigt</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-borderless table-sm">
                            <thead>
                                <th>Dato:</th>
                                <th>Beløb:</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ now()->format('j\\. M Y') }}</td>
                                    <td>300 kr.</td>
                                </tr>
                                <tr>
                                    <td>{{ now()->addDays(3)->format('j\\. M Y') }}</td>
                                    <td>187 kr.</td>
                                </tr>
                                <tr>
                                    <td>{{ now()->subDays(564)->format('j\\. M Y') }}</td>
                                    <td>200 kr.</td>
                                </tr>
                                <tr>
                                    <td>{{ now()->format('j\\. M Y') }}</td>
                                    <td>50 kr.</td>
                                </tr>
                            </tbody>   
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        @include('components.modals.delete-modal')
        @include('components.modals.register-form-modal')

        <a href="{{ route('/') }}" class="btn btn-sm btn-warning">Tilbage</a>
        <button type="button" class="register-modal-button btn btn-sm btn-primary col-md-1">Rediger</button>
        <button data-id="{{ $member->id ?? null }}" type="button" class="delete-modal-button btn btn-sm btn-danger col-md-1">Slet</button>
    </div>
      		
@endsection
<script src="{{ asset('js/members.js') }}" defer></script>