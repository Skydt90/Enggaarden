@extends('layouts.app')

@section('additional-scripts')
    <script src="{{ asset('js/members.js') }}" defer></script>
@endsection

@section('content')

    <div class="container">
        <h2 class="text-center">Medlemsdetaljer for {{ $member->first_name }}</h2>
        <br><br>

        {{-- Member Details --}}
        <div class="row">
            <div class="col-md-8">
                <form class="member-form" autocomplete="off" data-id="{{ $member->id }}" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <input type="hidden" name="type" value="member">
                        
                        @if (!$member->is_company)
                            <label for="first_name" class="col-md-3"><strong>Fornavn:</strong></label>
                        @else
                            <label for="first_name" class="col-md-3"><strong>Firmanavn:</strong></label>    
                        @endif                   
                        <input type="text" autocomplete="off" class="form-control col-md-9 input" name="first_name" value="{{ $member->first_name }}"> 
                        <br><br>
                        
                        @if (!$member->is_company)
                            <label for="last_name" class="col-md-3"><strong>Efternavn:</strong></label>
                            <input type="text" autocomplete="off" class="form-control col-md-9 input" name="last_name" value="{{ $member->last_name ?? null }}">
                            <br><br>
                        @endif

                        <label for="email" class="col-md-3"><strong>Email:</strong></label>
                        <input type="email" autocomplete="off" class="form-control col-md-9 input" name="email" value="{{ $member->email ?? '' }}">
                        <br><br>

                        <label for="member_type" class="col-md-3"><strong>Medlemstype:</strong></label>
                        <select class="form-control col-md-9 member-type" name="member_type">
                            @if ($member->is_company)
                                <option value="{{ $member->member_type }}">
                                    {{ $member->member_type }}
                                </option>
                            @else
                                <option value="" selected disabled hidden>{{ $member->member_type }}</option>
                                @foreach (App\Models\Member::MEMBER_TYPES as $member_type)
                                    <option value="{{ $member_type }}">
                                        {{ $member_type }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <br><br>
    
                        <label for="is_board" class="col-md-3"><strong>Bestyrelsesmedlem:</strong></label>
                        <select class="form-control col-md-9 is-board" name="is_board">
                            @foreach (App\Models\Member::IS_BOARD as $is_board)
                                <option value="{{ $is_board }}">
                                    {{ $is_board }}
                                </option>
                            @endforeach
                        </select>
                        <br><br>
    
                        <label for="phone_number" class="col-md-3"><strong>Mobil:</strong></label>
                        <input type="number" autocomplete="off" class="form-control col-md-9 input" name="phone_number" value="{{ $member->phone_number ?? '' }}">                       
                        <br><br>
                    </div>
                </form>

                <form class="subscription-form" autocomplete="off" data-id="{{ $member->id }}" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <input type="hidden" name="type" value="subscription">
                        <label for="pay_date" class="col-md-3"><strong>Kontingent betalt den:</strong></label>
                        <input type="date" autocomplete="off" class="form-control col-md-9 input pay-date" name="pay_date" value="{{ empty($member->subscriptions[0]->pay_date) ? null : $member->subscriptions[0]->pay_date->toDateString() }}">
                        <br><br>

                        <label for="amount" class="col-md-3"><strong>Beløb i dkk:</strong></label>
                        <input type="number" autocomplete="off" class="form-control col-md-9 input" name="amount" value="{{ empty($member->subscriptions[0]->pay_date) ? 0 : $member->subscriptions[0]->amount }}">
                        <br><br>

                    </div>
                </form>

                <form class="address-form" autocomplete="off" data-id="{{ $member->id }}" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <input type="hidden" name="type" value="address">
                        <label for="street_name" class="col-md-3"><strong>Vejnavn og nummer:</strong></label>
                        <input type="text" autocomplete="off" class="form-control col-md-9 input" name="street_name" value="{{ $member->address->street_name ?? null }}">
                        <br><br>
    
                        <label for="zip_code" class="col-md-3"><strong>Postnummer:</strong></label>
                        <input type="number" autocomplete="off" class="form-control col-md-9 input" name="zip_code" value="{{ $member->address->zip_code ?? null }}">
                        <br><br>
                        
                        <label for="city" class="col-md-3"><strong>By:</strong></label>
                        <input type="text" autocomplete="off" class="form-control col-md-9 input" name="city" value="{{ $member->address->city ?? null}}">
                        <br><br>
                    </div>
                </form>
            </div>
            
            {{-- Payments --}}
            <div class="col md-4">            
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Kontingentoversigt</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-borderless table-sm">
                            @if ($member->subscriptions->count() > 0)
                                <thead>
                                    <th>Dato:</th>
                                    <th>Beløb:</th>
                                </thead>
                                <tbody>
                                    @foreach ($member->subscriptions as $subscription)
                                        <tr>
                                            @if (is_null($subscription->pay_date))
                                                <?php continue; ?>      
                                            @else
                                                <td>{{ $subscription->pay_date->format('j\\. M Y') }}</td>
                                                <td>{{ $subscription->amount }} kr.</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <p class="lead text-center">Ingen betalinger endnu</p>
                                @endif
                            </tbody>   
                        </table>
                    </div>
                </div>
                <br>

                {{-- Infomation --}}   
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Info</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <p class="col-md-5"><strong>Medlem siden:</strong></p>
                            <p class="col-md-7">{{ $member->created_at->format('j\\. F Y') }}</p>

                            <?php Carbon\Carbon::setLocale('da'); ?>
                            <p class="col-md-5"><strong>Oprettet for:</strong></p>
                            <p class="col-md-7">{{ $member->created_at->diffForHumans() }}</p>

                            <p class="col-md-5"><strong>Har en bruger:</strong></p>
                            <p class="col-md-7">{{ $member->externalUser ? 'Ja' : 'Nej' }}</p>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
        <br>
        <a href="{{ route('member.index') }}" class="btn btn-warning col-md-1">Tilbage</a>
        <button type="button" id="success" data-toggle="modal" data-target="#success-modal" style="display:none"></button>
    </div>    		
@endsection