@extends('layouts.app') 
@section('title')
    {{ __("Mes clients") }} | {{ Auth::user()->name }}
@stop 
@section('content') 

<div class="h-spacer"></div> 
    <div class="container"> 
        <div class="row"> 
            @include('layouts/partials/_sidebar')   
            <div class="col-sm-9 page-content">
                <div class="panel panel-default">  
                    <div class="panel-heading">
                        <h3><i class="fa fa-users"></i> {{ __("Mes clients") }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="adds-wrapper jobs-list"> 
                            @foreach ($users as $user)
                                <div class="item-list job-item make-list">
                                    <div class="col-sm-1 col-xs-2 no-padding photobox">
                                        <div class="add-image">
                                            @if($user->image!="noimage.jpg")
                                                <img src="{{URL::to('/')}}/img/profile/{{ $user->image }}" class="thumbnail no-margin img-responsive">
                                            @else
                                                <img src="{{ url('img') }}/noimage.jpg" alt="" class="thumbnail no-margin img-responsive">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-10 col-xs-10 add-desc-box col-sm-12">
                                        <div class="add-details jobs-item"> 
                                            <h4 class="job-title">  {{ $user->company }}   </h4>
                                            <h5 class="company-title">  {{ __("Représentant : ") }}   {{ $user->firstname.' '.$user->lastname}} 
                                            </h5>
                                            <span class="info-row">
                                                <span class="date">  <i class="icon-phone"> </i> {{ $user->phone }}</span>
                                                <span class="item-location">  <i class="fa fa-map-marker"></i> {{ $user->address }}  </span>
                                            </span> 
                                        </div>
                                    </div> 
                                </div> 
                            @endforeach
                        </div> 
                    </div>
                    <div class="panel-footer">
                          {{ $users->links() }} 
                    </div>
                  
                </div>
            </div>
        </div> 
    </div> 

@stop