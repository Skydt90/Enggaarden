@extends('layouts.app')

@section('additional-scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @include('statistics.piechartJS')
            
            document.querySelector('.by-year').addEventListener('change', async function() {
                let url      = `statistics/total/${this.value}`;
                let response = await fetch(url);
                let jData    = await response.json();
                
                if(jData.status == 200) {
                    document.querySelector('.value').innerHTML = jData.amount;
                } else {
                    $.toastr.error.show('Noget gik galt');
                }
            });
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
                        
                        <p style="display: inline"><strong>Betalt kontingent i: </strong></p>
                        <select name="by-year" id="by-year" class="by-year">
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                        </select>
                        <p class="value" style="display: inline">{{ $sum_year }}</p> kr.
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

    <script>
        var a = document.getElementById('by-year');
        a.addEventListener('change', function() {
            alert(this.value);
        }, false);
    </script>

@endsection