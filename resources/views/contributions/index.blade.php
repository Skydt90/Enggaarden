@extends('layouts.app')

@section('additional-scripts')
    <script src="{{ asset('js/contributions.js') }}" defer></script>
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Støttebidrag</h2>
        <br>
        @toast @endtoast
        <div class="row">
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-contribution"><i class="fas fa-plus-circle"></i> Opret bidrag</button>
            <a href="{{ route('activity.index') }}" class="btn btn-sm btn-primary ml-1 ml-auto "><i class="fas fa-running"></i> Aktiviteter</a> 
        </div>
        
        <div class="row mt-1">
            <input type="text" id="search" onkeyup="searchTable('contributions')" placeholder="Søg efter aktivitet..">  
            @amount(['urlID' => 'contribution', 'amount' => $amount]) 
            @endamount
            <p class="ml-auto mb-n1"><strong>Antal Støttebidrag:</strong> {{ $contributions->total() }}</p>
        </div>

        <div class="row mt-2">
            <table id="contributions" class="table table-hover table-sm table-striped table-bordered">
                <thead class="thead-dark">
                    <th>Aktivitet</th>
                    <th>Beløb</th>
                    <th>Betalingsdato</th>
                    <th>Valgmuligheder</th>
                </thead>
                <tbody>
                    @foreach ($contributions as $contribution)
                        <tr class="table-row">
                            <td>{{ $contribution->activity_type->activity_type }}</td>
                            <td>{{ $contribution->amount }} kr</td>
                            <?php Carbon\Carbon::setLocale('da'); ?>
                            <td>{{ $contribution->pay_date->format('j\\. M Y') }}</td>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="Rediger" href="{{ route('contribution.show', ['contribution' => $contribution]) }}"><i class="fas fa-edit"></i></a>
                                <a class="ml-2 delete-button" data-id="{{$contribution->id}}" data-activity="{{ $contribution->activity_type->activity_type }}" href=""><i data-toggle="tooltip" data-placement="top" title="Slet" style="color: red" class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>                  
                    @endforeach
                </tbody>
            </table>
            @pagination([
                'paginated' => $contributions, 'index' => 'contribution.index', 
                'page' => $page, 'amount' => $amount])
            @endpagination
        </div>
    </div>
    @include('contributions.modals.add-contribution')
@endsection