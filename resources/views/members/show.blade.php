@extends('layouts.app')

@section('content')

    <div class="container">
        <h2 class="text-center">Medlemsdetaljer</h2>
        <br><br><br>

        <div class="row">
            {{-- Member Details --}}
            <form action="" class="col-md-8" method="POST">
                @csrf
                @method('PUT')
                
                    <div class="row">
                        
                        <label for="name" class="col-md-3"><strong>Navn:</strong></label>
                        <input type="text" class="form-control col-md-9" name="name" value="{{ $member->first_name . ' ' . $member->last_name ?? null }}">
                        <br><br>
                        <label for="address" class="col-md-3"><strong>Adresse:</strong></label>
                        <input class="form-control col-md-9" name="address" value="{{ $member->address->street_name ?? null }} {{ $member->address->zip_code ?? null }} {{ $member->address->city ?? null}}">
                        <br><br>
                        <label for="email" class="col-md-3"><strong>Email:</strong></label>
                        <input class="form-control col-md-9" name="email" value="{{ $member->email ?? '' }}">
                        <br><br>
                        <label for="member_type" class="col-md-3"><strong>Medlemstype:</strong></label>
                        <select class="form-control col-md-9" name="member_type">
                            @foreach (App\Models\Member::MEMBER_TYPES as $member_type)
                                <option value="{{ $member_type }}">
                                    {{ $member_type }}
                                </option>
                            @endforeach
                        </select>
                        <br><br>
                        <label for="phone_number" class="col-md-3"><strong>Mobil:</strong></label>
                        <input class="form-control col-md-9" name="phone_number" value="{{ $member->phone_number ?? '' }}">
                        <br><br>
                        <label for="subscription" class="col-md-3"><strong>Kontingent:</strong></label>
                        <input class="form-control col-md-9" name="phone_number" value="{{ $member->subscriptions[0]->pay_date }}">
                        <br><br>
    
                        <p class="col-md-3"><strong>Medlem siden:</strong></p>
                        <p class="col-md-9">{{ today()->subDays(30)->format('j\\. F Y') }}</p>
    
                        <p class="col-md-3"><strong>Bestyrelsesmedlem:</strong></p>
                        <p class="col-md-9">Nej</p>
                    </div>
                
            </form>
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
        <a href="{{ route('/') }}" class="btn btn-warning col-md-1">Tilbage</a>
        <button type="button" id="success" data-toggle="modal" data-target="#success-modal" style="display:none"></button>
        <button type="button" id="register-button" data-toggle="modal" data-target="#register-modal" class="btn btn-primary col-md-1">Rediger</button>
        <button type="button" id="delete-button" data-toggle="modal" data-target="#delete-modal" data-id="{{ $member->id ?? null }}" class="btn btn-danger col-md-1">Slet</button>
        
        @include('members.modals.delete-modal')
        @include('members.modals.register-form-modal')
        @include('members.modals.success-modal')

    </div>
      		
    @endsection
  {{--   <script type="application/javascript" src="{{ asset('js/members.js') }}" defer></script> --}}