@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">
        Emailkartotek
    </h2>
    <div class="row mt-2">
        <table class="table table-hover table-sm mt-2">
            <thead class="thead-light">
                <th>Modtager:</th>
                <th>Afsender:</th>
                <th>Emne:</th>
                <th>Dato:</th>
                <th>Valgmuligheder:</th>
            </thead>
            <tbody>
                @foreach ($emails as $email)
                    <tr class="table-row">
                        @if($email->group)
                            <td>{{ $email->group }}</td>
                        @else
                            <td>{{ $email->member->email }}</td>
                        @endif
                        <td>{{ $email->user->username }}</td>
                        <td>{{ $email->subject }}</td>
                        <?php Carbon\Carbon::setLocale('da'); ?>
                        <td>{{ $email->created_at->format('j\\. M Y') }}</td>
                        <td>
                            <a data-toggle="tooltip" data-placement="top" title="Rediger" href="{{ route('email.show', ['email' => $email]) }}"><i class="fas fa-edit"></i></a>
                            <a class="ml-2 delete-button" data-id="{{$email->id}}" href=""><i data-toggle="tooltip" data-placement="top" title="Slet" style="color: red" class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>                  
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
    
    