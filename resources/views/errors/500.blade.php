@extends('layouts.app')

@section('title',"Erreur 500")
    
@section('content') 

<div class="h-spacer"></div>
     <div class="container">
        <div class="section-content">
            <div class="row"> 
                    <div class="col-md-12 page-content">
                        <div class="error-page" style="margin: 100px 0;">
                            <h2 class="headline text-center" style="font-size: 180px; float: none;"> 404</h2>
                            <div class="text-center m-l-0" style="margin-top: 60px;">
                                <h2><i class="fa fa-warning"></i> {{ __("Erreur 500 ! Page non trouvée") }}</h2> 
                                <div class="h-spacer"></div>
                                <a href="{{ route('root_path') }}" class="btn btn-outline-primary">{{ __("Revenir à l'acceuil") }}</a>
                            </div>
                        </div>
                    </div>
            </div> 
        </div>
    </div>
</div> 
    
@stop