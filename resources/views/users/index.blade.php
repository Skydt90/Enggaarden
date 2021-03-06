@extends('layouts.app')

@section('additional-scripts')
    <script src="{{ asset('js/users.js') }}" defer></script>
@endsection

@section('content')

    <div class="container">
        <h2 class="text-center">
            Brugere
        </h2>
        <div class="row mt-2">
            <button type="button" id="register-button" data-toggle="modal" data-target="#register-modal" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Opret bruger</button>
            <table class="table table-hover table-sm mt-2 table-striped table-bordered sortable">
                <thead class="thead-dark">
                    <th>Brugernavn</th>
                    <th>Brugertype</th>
                    <th>Oprettet</th>
                    <th>Slet bruger</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="table-row">
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->user_type }}</td>
                            <?php Carbon\Carbon::setLocale('da'); ?>
                            <td>{{ $user->created_at ?? null ? $user->created_at->diffForHumans() : null }}</td>
                            <td>
                                @can('delete_user', $user->id)
                                    <a class="ml-2 delete-button" data-id="{{$user->id}}" data-username="{{ $user->username }}" href=""><i data-toggle="tooltip" data-placement="top" title="Slet" style="color: red" class="fas fa-trash-alt"></i></a>
                                @endcan
                            </td>
                        </tr>                  
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('users.modals.register')
@endsection