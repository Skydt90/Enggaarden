@extends('layouts.app')

@section('content')

    <div class="container">
    <h2 class="text-center">Medlemsdetaljer for {{ $member->first_name }}</h2>
        <br><br>

        {{-- Member Details --}}
        <div class="row">
            <div class="col-md-8">
                <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        
                        @if (!$member->is_company)
                            <label for="first_name" class="col-md-3"><strong>Fornavn:</strong></label>
                        @else
                            <label for="first_name" class="col-md-3"><strong>Firmanavn:</strong></label>    
                        @endif                   
                        <input type="text" class="form-control col-md-9" name="first_name" value="{{ $member->first_name }}"> 
                        <br><br>
                        
                        @if (!$member->is_company)
                            <label for="last_name" class="col-md-3"><strong>Efternavn:</strong></label>
                            <input type="text" class="form-control col-md-9" name="last_name" value="{{ $member->last_name ?? null }}">
                            <br><br>
                        @endif

                        <label for="email" class="col-md-3"><strong>Email:</strong></label>
                        <input type="email" class="form-control col-md-9" name="email" value="{{ $member->email ?? '' }}">
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
    
                        <label for="member_type" class="col-md-3"><strong>Bestyrelsesmedlem:</strong></label>
                        <select class="form-control col-md-9" name="member_type">
                            @foreach (App\Models\Member::IS_BOARD as $is_board)
                                <option value="{{ $is_board }}">
                                    {{ $is_board }}
                                </option>
                            @endforeach
                        </select>
                        <br><br>
    
                        <label for="phone_number" class="col-md-3"><strong>Mobil:</strong></label>
                        <input type="number" class="form-control col-md-9" name="phone_number" value="{{ $member->phone_number ?? '' }}">                       
                        <br><br>
                    </div>
                </form>

                <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <label for="subscription" class="col-md-3"><strong>Kontingent:</strong></label>
                        <input type="date" class="form-control col-md-9" name="subscription" value="{{ $member->subscriptions[0]->pay_date }}">
                        
                        <br><br>
                    </div>
                </form>

                <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <label for="street_name" class="col-md-3"><strong>Vejnavn og nummer:</strong></label>
                        <input type="text" class="form-control col-md-9" name="street_name" value="{{ $member->address->street_name ?? null }}">
                        <br><br>
    
                        <label for="zip_code" class="col-md-3"><strong>Postnummer:</strong></label>
                        <input type="number" class="form-control col-md-9" name="zip_code" value="{{ $member->address->zip_code ?? null }}">
                        <br><br>
                        
                        <label for="city" class="col-md-3"><strong>By:</strong></label>
                        <input type="text" class="form-control col-md-9" name="city" value="{{ $member->address->city ?? null}}">
                        <br><br>
                    </div>
                </form>
    
                <p><strong>Medlem siden:</strong>{{ $member->created_at->format('j\\. F Y') }}</p>
               {{--  <p>{{ $member->created_at->format('j\\. F Y') }}</p> --}}
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
                                @foreach ($member->subscriptions as $subscription)
                                    <tr>
                                        <?php $payDate = Carbon\Carbon::parse($subscription->pay_date ?? null) ?>
                                        <td>{{ $payDate->format('j\\. M Y') }}</td>
                                        <td>{{ $subscription->amount }} kr.</td>
                                    </tr>
                                @endforeach
                            </tbody>   
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <a href="{{ route('member.index') }}" class="btn btn-warning col-md-1">Tilbage</a>
        <button type="button" id="success" data-toggle="modal" data-target="#success-modal" style="display:none"></button>
        <button type="button" id="delete-button" data-toggle="modal" data-target="#delete-modal" data-id="{{ $member->id ?? null }}" class="btn btn-danger col-md-1">Slet</button>
        
        @include('members.modals.delete-modal')
        @include('members.modals.success-modal')

    </div>    		
@endsection