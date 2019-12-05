@extends('layouts.app')

@section('additional-scripts')
<!-- Scripts -->
<script src="{{ asset('js/activities.js') }}" defer></script>
@endsection

@section('content')

    <div class="container">
        <h2 class="text-center">
            Aktiviteter
        </h2>
        <div class="row mt-2">
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-activity-type"><i class="fas fa-plus-circle"></i> Tilføj aktivitet</button>
            <a href="{{ route('contribution.index') }}" class="btn btn-sm btn-danger ml-1 ml-auto">Tilbage</a>
            <table class="table table-hover table-sm mt-2 activities">
                <thead class="thead-light">
                    <th>Aktivitetsnavn</th>
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
        </div>





    </div>

    @include('activities.modals.add-activity-type')

@endsection