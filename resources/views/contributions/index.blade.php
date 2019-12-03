@extends('layouts.app')

@section('content')

    <div class="container">
        <h2 class="text-center">
            Støttebidrag
        </h2>
        <div class="row mt-2">
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-activity-type"><i class="fas fa-plus-circle"></i> Opret bidrag</button>
            <button class="btn btn-sm btn-success ml-1 mr-auto"><i class="fas fa-plus-circle"></i> Opret aktivitet</button>
            <table class="table table-hover table-sm mt-2">
                <thead class="thead-light">
                    <th>Aktivitet</th>
                    <th>Beløb</th>
                    <th>Betalingsdato</th>
                </thead>
                <tbody>
                    @foreach ($contributions as $contribution)
                        <tr>
                            <td>{{ $contribution->activityType->activity_type }}</td>
                            <td>{{ $contribution->amount }} kr</td>
                            <?php Carbon\Carbon::setLocale('da'); ?>
                            <td>{{ $contribution->payment_date->format('j\\. M Y') }}</td>
                        </tr>                  
                    @endforeach
                </tbody>
            </table>
        </div>





    </div>

    @include('contributions.modals.add-activity-type')

@endsection