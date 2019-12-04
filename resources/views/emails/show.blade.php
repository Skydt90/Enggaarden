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
                <form action="{{ route('mail.send') }}" method="POST" autocomplete="off">
                    @csrf
                    @if (isset($email))
                        <div class="form-group">
                            <label for="reciever">Modtager:</label>
                            <input type="email" name="reciever" class="form-control" readonly value="{{ $email ?? '' }}">
                        </div>
                    @else
                        
                    @endif
                    
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