@extends('layouts.app')

@section('additional-scripts')
<!-- Scripts -->
<script src="{{ asset('js/contributions.js') }}" defer></script>
@endsection

@section('content')

    <div class="container">
        <h2 class="text-center">
            Støttebidrag
        </h2>
        <div class="row mt-2">
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-contribution"><i class="fas fa-plus-circle"></i> Opret bidrag</button>
            <button class="btn btn-sm btn-success ml-1 mr-auto" data-toggle="modal" data-target="#add-activity-type"><i class="fas fa-running"></i> Opret aktivitet</button>
            <table class="table table-hover table-sm mt-2">
                <thead class="thead-light">
                    <th>Aktivitet</th>
                    <th>Beløb</th>
                    <th>Betalingsdato</th>
                    <th>Valgmuligheder</th>
                </thead>
                <tbody>
                    @foreach ($contributions as $contribution)
                        <tr class="table-row">
                            <td>{{ $contribution->activityType->activity_type }}</td>
                            <td>{{ $contribution->amount }} kr</td>
                            <?php Carbon\Carbon::setLocale('da'); ?>
                            <td>{{ $contribution->pay_date->format('j\\. M Y') }}</td>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="Rediger" href="{{ route('contribution.show', ['contribution' => $contribution]) }}"><i class="fas fa-edit"></i></a>
                                <a class="ml-2 delete-button" data-id="{{$contribution->id}}" data-activity="{{ $contribution->activityType->activity_type }}" href=""><i data-toggle="tooltip" data-placement="top" title="Slet" style="color: red" class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>                  
                    @endforeach
                </tbody>
            </table>
        </div>





    </div>

    @include('contributions.modals.add-activity-type')
    @include('contributions.modals.add-contribution')

@endsection