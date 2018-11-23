@extends('layouts.app')


@section('title')
    CGU {{config('app.name') }}
@stop

@section('content')
     <div class="h-spacer"></div>
     <div class="container">
        <div class="section-content">
                <div class="row">
                    <h1 class="text-center title-1" style="color: ;"><strong>CGU</strong></h1>
                    <hr class="center-block small text-hr" style="background-color: ;">
                    
                    <div class="col-md-12 page-content">
                        <div class="inner-box relative">
                            <div class="row">
                                <div class="col-sm-12 page-content">
                                    <h3 style="text-align: center; color: ;">{{ __("Conditions d'utilisation et de vente") }}</h3>
                                    <p><b>{{ __("Définitions") }}</b><br></p>
                                    <p><b>{{ __("Objet") }}</b></p> 
                                    <p><b>{{ __("Acceptation") }}</b></p>
                                    <p><b>{{ __("Responsabilité") }}</b></p>
                                    <p>{{ __("La responsabilité de Canal source ne peut être engagée en cas d'inexécution ou de mauvaise exécution de la commande due, soit du fait de l'Annonceur, soit d'un cas de force majeure.") }}</p>
                                    <p><b>{{ __("Modification des Conditions") }}</b></p>
                                    <p>{{ __("Canal source se réserve la possibilité, à tout moment, de modifier en tout ou partie les CGV.<br>Les Annonceurs sont invités à consulter régulièrement les CGV afin de prendre connaissance des changements apportés.") }}</p>
                                    <p><b>{{ __("Dispositions Diverses") }}</b></p>   
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>  
        </div> 
   </div>
@stop