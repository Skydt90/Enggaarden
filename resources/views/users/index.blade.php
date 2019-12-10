@extends('layouts.app')

@section('additional-scripts')
<!-- Scripts -->
<script src="{{ asset('js/users.js') }}" defer></script>
@endsection

@section('content')

    <div class="container">
        <h2 class="text-center">
            Brugere
        </h2>
        <div class="row mt-2">
            <a href="{{ route('register') }}" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Opret bruger</a>
            <table class="table table-hover table-sm mt-2">
                <thead class="thead-light">
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
                                @if (Auth::user()->id != $user->id)
                                <a class="ml-2 delete-button" data-id="{{$user->id}}" data-username="{{ $user->username }}" href=""><i data-toggle="tooltip" data-placement="top" title="Slet" style="color: red" class="fas fa-trash-alt"></i></a>
                                @endif
                            </td>
                        </tr>                  
                    @endforeach
                </tbody>
            </table>
        </div>





    </div>

@endsection