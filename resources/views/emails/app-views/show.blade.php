@extends('layouts.app')

@section('additional-scripts')
    <script src="{{ asset('js/ckeditor.js') }}"></script>
    <script src="{{ asset('js/email.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Send Email</h2>
        
        @include('layouts.partials.flash-span')
        
        <br>

        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('send.mail.send') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
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
                    
                    <div class="form-group">
                        <label for="subject">Emne:</label>
                        <input type="text" name="subject" class="form-control" placeholder="Indtast emne">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Besked:</label>
                        <textarea class="form-control ck-editor" name="message"></textarea>
                    </div>

                    <input type="submit" class="btn btn-primary btn-block"> 
                </form>     
            </div> 
        </div>
    </div>
    

@endsection