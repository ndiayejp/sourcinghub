@extends('layouts.app') 
@section('title')
    {{ __("Mes fournisseurs") }} | {{ Auth::user()->name }}
@stop 
@section('content') 
    <div class="h-spacer"></div> 
    <div class="container"> 
        <div class="row"> 
            @include('layouts/partials/_sidebar')   
            <div class="col-sm-9 page-content">
                <div class="category-list">  
                    <div class="adds-wrapper jobs-list"> 
                    
                        @foreach ($users as $user)
                            <div class="item-list job-item make-list">
                                <div class="col-sm-2 col-xs-2 no-padding photobox">
                                    <div class="add-image">
                                        @if(!empty($user->image))
                                            <img src="{{URL::to('/')}}/img/profile/{{ $user->image }}" class="thumbnail img-responsive">
                                        @else
                                            <img src="{{ url('img') }}/noimage.jpg" alt="" class="thumbnail img-responsive">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-10 col-xs-10 add-desc-box"> 
                                        <div class="add-details jobs-item"> 
                                            <a href="{{ route('profile',[str_slug($user->company),$user->user_id]) }}">
                                                <h4 style="text-transform:uppercase">{{ $user->company }}</h4>
                                            </a> 
                                           
                                            <p><h5 class="company-title"><b>{{ __("Représentant : ") }}</b> {{ $user->firstname.' '.$user->lastname}}</h5></p>
                                            <span class="info-row">
                                                <span class="date">{{ $user->phone }}</span>
                                                <span class="item-location"><i class="fa fa-map-marker"></i> {{ $user->address }}</span>
                                            </span> 
                                        </div>
                                 </div> 
                            </div> 
                        @endforeach
                    </div>
                    <div class="tab-box save-search-bar text-center"> <a href="#"> &nbsp; </a>  </div>
                    {{ $users->links() }}
                </div>
            </div>
        </div> 
    </div> 
@stop 
@section('script')
    <script src="{{ asset('js/star_fr.js') }}"></script>
    <script> 
        $(".input-id").rating({
            'language': 'fr',
        }); 

        $("#input-id").rating();
    </script>
@stop