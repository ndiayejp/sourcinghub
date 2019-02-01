@extends('layouts.app')
@section('title')
{{ __('Les offres') }} | {{config('app.name') }}
@stop
@section('content')
<div class="h-spacer"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-3 page-sidebar mobile-filter-sidebar ">
            <div id="sidebar" class="sidebar">
                <div class="sidebar__inner slider">
                    @foreach ($banners as $banner)
                        <div class="item">
                            <img src="{{URL::to('/')}}/banners/{{ $banner->image }}" class="img-responsive"><br><br>
                        </div>
                    @endforeach
                </div>
            </div> 
        </div>
        <div class="col-sm-9 page-content col-thin-left">
            @include('layouts/partials/_searchform') 
            @if(isset($categoryName)) 
                <h2>{{ $categoryName }}</h2> 
            @endif
            <div class="category-list">
                    <div class="tab-box clearfix"> 
                        <div class="col-lg-12 no-border">
                            <div class="inner"><h2><small></small></h2></div>
                        </div>
                        <div class="menu-overly-mask"></div>
                    </div>
                    <div class="listing-filter hidden-xs">
                        <div class="pull-left col-sm-10 col-xs-12">
                            <div class="breadcrumb-list text-center-xs">
                                @if($posts->count() > 1)
                                    {{ $posts->count()  }} {{ __("Appels d'offres ")}}
                                @else
                                    {{ $posts->count()  }} {{ __("Appel d'offre ")}}
                                @endif
                            </div>
                        </div>
                        <div class="pull-right col-sm-2 col-xs-12 text-right text-center-xs listing-view-action">
                        </div>
                        <div style="clear:both;"></div>
                    </div>

                    <div class="adds-wrapper jobs-list">  
                        @foreach ($posts as $post)
                            <div class="item-list job-item make-list">
                                {{--  <div class="col-sm-1 col-xs-2 no-padding photobox">
                                    <div class="add-image">
                                        @if(!empty($post->company->avatarc))
                                            <img src="{{URL::to('/')}}/img/avatarsc/{{ $post->company->avatarc }}" class="thumbnail no-margin img-responsive">
                                        @else
                                            <img src="{{ url('img') }}/noimage.jpg" alt="" class="thumbnail no-margin img-responsive">
                                        @endif
                                    </div>
                                </div>  --}}
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
                                                        <time style="color:#f27219">{{ \Carbon\Carbon::parse($post->closing_date)->format('d/m/Y')}}</time> 
                                                </h5>
                                                
                                            </div>
                                        </div>
                                        <h4 class="job-title"> 
                                            <a href="{{ url("/offre/".$post->slug) }}">   {{ $post->name }} </a>
                                            <span style="display:block">{{__("N° appel d'offre:")}} {{'AO'.'-'.$post->id.'-'.Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->year }}</span>
                                        </h4>
                                        <span class="info-row">
                                            <span class="date">
                                                <i class="icon-clock"> </i>
                                                {{ $post->created_at->diffForHumans() }}
                                            </span>
                                            <span class="item-location">
                                                <i class="fa fa-map-marker"></i>
                                                    {{ $post->address_delivery.' - '.$post->country->name }}
                                            </span>
                                        </span>
                                        <div class="job-actions">
                                            @guest
                                                <ul class="list-inline">
                                                    <li><a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                        closeButton: true,
                                                        progressBar: true,
                                                    })"><i class="fa fa-heart"></i> {{ $post->favorite_to_users->count() }}</a></li>
                                                    <li><i class="fa fa-eye"></i> {{ $post->view_count }}</li>
                                                </ul>
                                            @else
                                                <ul class="list-inline">
                                                    <li>
                                                        <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
                                                            class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'favorite_posts' : ''}}"> 
                                                            <i class="fa fa-heart"></i>{{ $post->favorite_to_users->count() }}
                                                        </a>
                                                        <form id="favorite-form-{{ $post->id }}" method="POST" action="{{ route('post.favorite',$post->id) }}" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </li>
                                                    <li><i class="fa fa-eye"></i> {{ $post->view_count }}</li>
                                                </ul>
                                            @endguest
                                        </div>
                                    </div>
                                </div> 
                            </div> 
                        @endforeach
                    </div>
                        
                    <div class="tab-box save-search-bar text-center">
                        <a href="#"> &nbsp; </a>
                    </div>
                </div>
            <div class="pagination-bar text-center"> {{ $posts->links() }} </div>
        </div>
    </div>
</div>
@stop
@section('script')
    <script> 
        $('.select').select2();
        $(".Inputdatetime").datetimepicker({
            autoclose: true,
            todayBtn: true,
            language:'fr',
            minView: "month",
            format: "yyyy-mm-dd" 
        });
        
    });
    </script>
@stop