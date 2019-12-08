@extends('layouts.app')

@section('additional-scripts')
    <script src="{{ asset('js/ckeditor.js') }}"></script>
    <script src="{{ asset('js/email.js') }}"></script>
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
                <form action="{{ route('send.mail.send') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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
                            <input type="text" name="subject" class="form-control" placeholder="Indtast emne">
                        </div>
                        
                    </div>    
                    
                    <div class="form-group">
                        <label for="message">Besked:</label>
                        <textarea class="form-control ck-editor" name="message"></textarea>
                    </div>

                    <input type="submit" class="btn btn-primary btn-block" value="Afsend"> 
                </form>     
            </div>
            <div class="col-md-5">
                <h4 class="text-center">Din mail historik</h4>
                <br>
                <a href="{{ route('email.index') }}" class="btn btn-sm btn-primary mr-auto"><i class="fas fa-mail-bulk"></i> Alle emails</a>
                <table class="table table-hover table-sm mt-2">
                    <thead class="thead-light">
                        <th>Til:</th>
                        <th>Emne:</th>
                    </thead>
                    <tbody>
                        <td>Mail.dk</td>
                        <td>lort</td>
                    </tbody>
                </table>    
            </div> 
        </div>
    </div>
    

@endsection