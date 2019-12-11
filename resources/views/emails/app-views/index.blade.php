@extends('layouts.app')

@section('additional-scripts')
    <script src="{{ asset('js/email.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Emailkartotek</h2>
        <br>
        @toast @endtoast
        <div class="row">
            <a href="{{ route('send.mail.show') }}" class="btn btn-sm btn-warning ml-1 ml-auto">Tilbage</a> 
        </div>
        
        <div class="row mt-1">
            <input type="text" id="search" onkeyup="searchTable('emails')" placeholder="Søg efter modtager..">  
            @amount(['urlID' => 'email', 'amount' => $amount]) 
            @endamount
            <p class="ml-auto mb-n1"><strong>Antal Email:</strong> {{ $emails->total() }}</p>
        </div>

        <div class="row mt-2">
            <table id="emails" class="table table-hover table-sm table-striped table-bordered">
                <thead class="thead-dark">
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
                            <td>{{ $email->user->username ?? null }}</td>
                            <td>{{ $email->subject }}</td>
                            <?php Carbon\Carbon::setLocale('da'); ?>
                            <td>{{ $email->created_at->format('j\\. M Y') }}</td>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="Vis" href="{{ route('email.show', ['email' => $email]) }}"><i class="fas fa-eye"></i></a>
                                <a class="ml-2 delete-button" data-id="{{ $email->id }}" href="#"><i data-toggle="tooltip" data-placement="top" title="Slet" style="color: red" class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>                  
                    @endforeach
                </tbody>
            </table>
            @pagination([
                'paginated' => $emails, 'index' => 'email.index', 
                'page' => $page, 'amount' => $amount])
            @endpagination
        </div>
@endsection
    
    