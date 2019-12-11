@extends('layouts.app')

@section('additional-scripts')
    <script src="{{ asset('js/ckeditor.js') }}" defer></script>
    <script src="{{ asset('js/email.js') }}" defer></script>
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Email</h2>
        
        @toast @endtoast
        
        <br>
        <br>

        <div class="row">
            <div class="col-md-7">
                <h4 class="text-center">Ny email</h4>
                <br>
                <form action="{{ route('send.mail.send') }}" method="POST" autocomplete="off" enctype="multipart/form-data" class="mail-form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Modtager:</label>
                            @if (isset($email))
                                <input type="hidden" name="member_id" value="{{ $member_id }}">
                                <input type="email" name="email" class="form-control" readonly value="{{ $email ?? '' }}">
                            @else
                                <select class="form-control" name="group">
                                    @foreach (App\Models\Email::MAIL_GROUPS as $group)
                                        <option value="{{ $group }}">
                                            {{ $group }}
                                        </option>
                                    @endforeach
                                </select>                       
                            @endif
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="subject">Emne:</label>
                            <input type="text" name="subject" class="form-control" placeholder="Indtast emne" required="true">
                        </div>
                        
                    </div>    
                    
                    <div class="form-group">
                        <label for="message">Besked:</label>
                        <textarea class="form-control ck-editor" id="text-editor" name="message" {{-- value="{{ old('message') }}" --}}></textarea>
                    </div>

                    <input type="submit" class="btn btn-primary btn-block" value="Afsend"> 
                </form>     
            </div>
            <div class="col-md-5">
                <h4 class="text-center">Dine seneste 12 emails</h4>
                <br>
                <a href="{{ route('email.index') }}" class="btn btn-sm btn-primary mr-auto mb-2"><i class="fas fa-mail-bulk"></i> Alle emails</a>
                <table class="table table-hover table-bordered table-striped table-sm">
                    <thead class="thead-dark">
                        <th>Til:</th>
                        <th>Emne:</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($user_emails as $email)
                        <tr>
                            @if ($email->group)
                                <td>{{ $email->group }}</td>
                            @else
                                <td>{{ $email->member->email }}</td>
                            @endif        
                            <td>{{ $email->subject }}</td>
                            <td><a data-toggle="tooltip" data-placement="top" title="Vis" href="{{ route('email.show', ['email' => $email]) }}"><i class="fas fa-eye"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>    
            </div> 
        </div>
    </div>
    

@endsection