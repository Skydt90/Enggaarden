@extends('layouts.app')

@section('additional-scripts')
    <script src="{{ asset('js/contributions.js') }}" defer></script>
@endsection

@section('content')

    <div class="container">
        <h2>
            Detaljer for støttebidrag
        </h2>
        <div class="row">
            <div class="col-md-7">
                <form action="#" method="post" class="contribution-form" data-id="{{ $contribution->id }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <label for="activity_type" class="col-md-3">Aktivitet</label>
                        <select name="activity_type" class="col-md-9 form-control activity_type">
                            <option value="" selected disabled hidden>{{ $contribution->activity_type->activity_type }}</option>
                            @foreach ($activities as $activity_type)
                                <option value="{{ $activity_type->activity_type }}">
                                    {{ $activity_type->activity_type }}
                                </option>
                            @endforeach
                        </select>
                        <br><br>
                        <label for="amount" class="col-md-3">Beløb</label>
                        <input type="number" step="0.01" class="form-control col-md-9 amount input" name ="amount" value="{{ $contribution->amount }}">
                        <br><br>
                        <label for="pay_date" class="col-md-3">Betalingsdato</label>
                        <input type="date" class="form-control col-md-9 pay_date input" name ="pay_date" value="{{ $contribution->pay_date->toDateString() }}">
                        <br><br>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <a href="{{ route('contribution.index') }}" class="btn btn-warning col-md-1">Tilbage</a>            
    </div>
    
@endsection
