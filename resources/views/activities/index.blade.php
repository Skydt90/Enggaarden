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
            <a href="{{ route('contribution.index') }}" class="btn btn-sm btn-warning ml-auto">Tilbage</a>
        </div>
        
        <div class="row">
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-activity-type"><i class="fas fa-plus-circle"></i> Tilføj aktivitet</button>
            <p class="ml-auto mb-n2"><strong>Antal Aktiviteter:</strong> {{ $activities->count() }}</p>
        </div>

        <div class="row mt-2">
            <table id="activity-types" class="table table-sm activities table-striped">
                <thead class="thead-dark">
                    <th>Aktiviteter:</th>
                </thead>
                <tbody>
                    <form action="#" method="post" class="activity-type-form">
                        @csrf
                        @method('PUT')
                        <tr class="table-row">
                            <td class="form-inline">
                                @foreach ($activities as $activity_type)
                                    <input type="text" class="form-control input col-md-3" data-id="{{ $activity_type->id }}" value="{{ $activity_type->activity_type }}">
                                @endforeach
                            </td>
                        </tr>                  
                    </form>
                </tbody>
            </table>
        </div>
    </div>

    @include('activities.modals.add-activity-type')

@endsection