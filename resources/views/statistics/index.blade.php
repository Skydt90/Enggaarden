@extends('layouts.app')

@section('additional-scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @include('statistics.piechartJS')

        });
        
    </script>
@endsection

@section('content')

    <div class="container">
        <div id="container"></div>
    </div>



@endsection