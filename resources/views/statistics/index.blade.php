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
    @toast @endtoast
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                            <h4 class="text-center">Kroner udbetalt til aktiviteter</h4>
                    </div>
                    <div class="card-body">
                        <div id="container">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Info</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Antal medlemmer: </strong>{{ $memberCount }}</p>
                        <p><strong>Betalt kontingent i alt: </strong>{{ $subscriptionSum }} kr.</p>
                        <p><strong>Ubetalt kontingent: </strong>{{ $owed }} kr.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
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