@extends('layouts.app') 
@section('title')
    {{ __("Archives") }} | {{ Auth::user()->name }}
@stop 
@section('content') 
    <div class="h-spacer"></div> 
    <div class="container"> 
        <div class="row"> 
            @include('layouts/partials/_sidebar')   
            <div class="col-sm-9 page-content">
                <div class="panel panel-default">  
                    <div class="panel-heading">
                        <h3><i class="fa fa-files-o"></i> {{ __("Mes offres attribuées") }}</h3>
                    </div>
                    <div class="panel-body">
                        @foreach ($posts as $post)
                            <div class="item-list job-item make-list"> 
                                <div class="col-sm-12 col-xs-12 add-desc-box">
                                    <div class="add-details jobs-item">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="company-title">
                                                    {{ __("Appel d'offre : ") }} 
                                                    @foreach ($post->opens as $open )
                                                        <span class="label label-default">{{ $open->name }}</span>
                                                    @endforeach
                                                </h5>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <h5 class="company-title">
                                                    {{ __("Date de fermeture : ") }}
                                                    <span class="label label-default">{{ $post->closing_date }}</span>
                                                </h5> 
                                            </div>
                                        </div>
                                        <h4 class="job-title"> 
                                            <a href="{{ url("/offre/".$post->slug) }}"> {{ $post->name }} </a>
                                            <span style="display:block">{{__("N° appel d'offre:")}} {{'AO'.'-'.$post->id.'-'.Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->year }}</span>
                                        </h4>
                                        <span class="info-row">
                                            <span class="date">
                                                <i class="icon-clock"> </i> {{ $post->created_at->diffForHumans() }}
                                            </span>
                                            <span class="item-location">
                                                <i class="fa fa-map-marker"></i>
                                                {{ $post->address_delivery.' - '.$post->country->name }}
                                            </span>
                                        </span> 
                                    </div>
                                </div> 
                            </div> 
                        @endforeach
                    </div>
                    <div class="panel-footer">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop