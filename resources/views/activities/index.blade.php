@extends('layouts.app')

@section('additional-scripts')
    <script src="{{ asset('js/activities.js') }}" defer></script>
@endsection

@section('content')

    <div class="container">
        <h2 class="text-center">Aktiviteter</h2>
        <br>
        @toast @endtoast
        <div class="row">
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-activity-type"><i class="fas fa-plus-circle"></i> Tilføj aktivitet</button>
            <a href="{{ route('contribution.index') }}" class="btn btn-sm btn-warning ml-1 ml-auto">Tilbage</a>
        </div>
        
        <div class="row mt-1">
            <input type="text" id="search" onkeyup="searchTable('activity-types')" placeholder="Søg efter aktivitet..">  
            @amount(['urlID' => 'activity', 'amount' => $amount]) 
            @endamount
            <p class="ml-auto mb-n1"><strong>Antal Aktivitetstyper:</strong> {{ $activities->total() }}</p>
        </div>

        <div class="row mt-2">
            <table id="activity-types" class="table table-hover table-sm activities">
                <thead class="thead-light">
                    <th>Aktivitetsnavn:</th>
                </thead>
                <tbody>
                    <form action="#" method="post" class="activity-type-form">
                        @csrf
                        @method('PUT')
                        @foreach ($activities as $activity_type)
                            <tr class="table-row">
                                <td>
                                    <input type="text" class="form-control input" data-id="{{ $activity_type->id }}" value="{{ $activity_type->activity_type }}">
                                </td>
                            </tr>                  
                        @endforeach
                    </form>
                </tbody>
            </table>
            @pagination([
                'paginated' => $activities, 'index' => 'activity.index', 
                'page' => $page, 'amount' => $amount])
            @endpagination
        </div>
    </div>

    @include('activities.modals.add-activity-type')

@endsection