@if (session()->has('status'))
    <div class="success">
        <span style="display:none;">
            {{ session()->get('status') }}
        </span>    
    </div>
@endif

@if ($errors->any())
    <div class="errors">
        @foreach ($errors->all() as $error)
        <span style="display:none;">
            {{ $error }}
        </span>
        @endforeach    
    </div>
@endif