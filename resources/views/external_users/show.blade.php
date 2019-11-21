@extends('layouts.app-external')

@section('content')

<div class="container">

        <h2 class="text-center">Medlemsdetaljer</h2>
        <br><br><br>

        <div class="row">
            {{-- Member Details --}}
            <div class="col-md-8">
                <div class="row">
                    <p class="col-md-3"><strong>Navn:</strong></p>
                    <p class="col-md-9">{{ $ex_user->member->first_name }} {{ $ex_user->member->last_name ?? '' }}</p>

                    <p class="col-md-3"><strong>Adresse:</strong></p>
                    <p class="col-md-9">{{ $ex_user->member->address->street_name ?? '' }} {{ $ex_user->member->address->zip_code ?? '' }} {{ $ex_user->member->address->city ?? ''}}</p>

                    <p class="col-md-3"><strong>Email</strong></p>
                    <p class="col-md-9">{{ $ex_user->member->email }}</p>

                    <p class="col-md-3"><strong>Medlemstype:</strong></p>
                    <p class="col-md-9">{{ $ex_user->member->member_type }}</p>

                    <p class="col-md-3"><strong>Telefon:</strong></p>
                    <p class="col-md-9">{{ $ex_user->member->phone_number ?? '' }}</p>

                    <p class="col-md-3"><strong>Kontingent:</strong></p>
                    <p class="col-md-9">{{ $ex_user->member->subscriptions[0]->pay_date ?? 'Ikke betalt' }}</p>
                    
                    <p class="col-md-3"><strong>Medlem siden:</strong></p>
                    <p class="col-md-9">{{ $ex_user->member->created_at->format('j\\. F Y') }}</p>

                    <p class="col-md-3"><strong>Bestyrelsesmedlem:</strong></p>
                    <p class="col-md-9">{{ $ex_user->member->is_board }}</p>
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
                                @foreach ($ex_user->member->subscriptions as $subscription)
                                    <tr>
                                        <td>{{ $subscription->pay_date }}</td>
                                        <td>{{ $subscription->amount }}</td>
                                    </tr>
                                @endforeach
                            </tbody>   
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection