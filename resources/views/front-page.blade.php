@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-2">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Enggaardens forside</h2>
                </div>
                <div class="card-body">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('img/oppefra.jpg') }}" alt="Første slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h4>Enggaarden oppefra</h4>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('img/bikasser.jpg') }}" alt="Andet slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h4>Bikasser</h4>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('img/graeskar.jpg') }}" alt="Tredje slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h4>Græskar</h4>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('img/traktor.jpg') }}" alt="Fjerde slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h4>Traktor</h4>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection