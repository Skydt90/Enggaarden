@extends('layouts.app')

@section('additional-scripts')
    <script src="{{ asset('js/ckeditor.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="{{ $email ?? '' }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject" class="sr-only">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter subject">
                    </div>
                    
                    <div class="form-group">
                        <label for="Comment">Your Comment</label>
                        <textarea class="form-control" id="body" name="comment_content"></textarea>
                    </div>

                    <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit"> 
                </form>     
            </div> 
        </div>
    </div>

@endsection