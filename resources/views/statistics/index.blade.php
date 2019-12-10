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
        <div class="card">
            <div class="card-header">
                    <h4 class="text-center">Kroner udbetalt til aktiviteter</h4>
            </div>
            <div class="card-body">
                <div id="container">
                    
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Tilkomne medlemmer</h4>
            </div>
            <div class="card-body">
                <div id="container2">
                </div>
            </div>
        </div>

        </div>
    </div>



@endsection