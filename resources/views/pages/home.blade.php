@extends('layouts.app')

@section('title')
    {{ __('Bienvenue sur Canalsource') }}
@stop


@section('content')
        <div class="wide-intro ">
            <div class="dtable hw100">
                <div class="dtable-cell hw100">
                    <div class="container text-center">
                        <h1 class="intro-title animated fadeInDown">{{ $nbPosts->count() }}  {{ __("APPELS D'OFFRES EN COURS") }} </h1>
                        <p class="sub animateme fittext3 animated fadeIn">
                            {{ __('Simple, rapide et efficace') }}
                        </p>                
                        <div class="row search-row fadeInUp">
                            {!! Form::open(['action' => 'SearchController@index', 'method' => 'GET']) !!}
                                 <div class="col-lg-5 col-sm-5 search-col relative">
                                    <i class="icon-docs icon-append"></i>
                                    <input type="text" name="q" class="form-control keyword has-icon" placeholder="{{ __('Quoi ?') }}" value="">
                                </div>
                                <div class="col-lg-5 col-sm-5 search-col relative locationicon">
                                    <i class="icon-location-2 icon-append"></i>
                                    <input type="text" id="locSearch" name="location" class="form-control locinput input-rel searchtag-input has-icon tooltipHere" placeholder="{{ __('Où ?') }}" value="" title="" data-placement="bottom" data-toggle="tooltip" data-original-title="Entrer le nom d'une ville OU d'une région" autocomplete="off">
                                </div>
                                <div class="col-lg-2 col-sm-2 search-col">
                                        {!! Form::button(__('<i class="fa fa-search"></i> Trouver'),array('class'=>'btn btn-search btn-block ', 'type' => 'submit')) !!}
                                     
                                </div>
                            {!! Form::close() !!}
                        </div>         
                    </div>
                </div>
            </div>
        </div>
        <div class="h-spacer"></div>
        <div class="container"> 
            <div class="row">
                <div class="col-md-3">
                         {{--  <h3>{{ __('Sous-traitance industrielle') }}</h3>
                        <div class="list-categories">
                            <ul class="cat-list list list-border  ">
                                 @foreach ( $categories as $category)
                                    @if($category->posts->count()>0)
                                        <li> <a href="{{ url("/category/".$category->url) }}"> {{  $category->name }}</a> </li>
                                    @endif
                                @endforeach 
                            </ul>
                        </div>  --}}
                        <img src="{{URL::to('/')}}/img/banner.png" class="img-responsive">
                      
                </div>
                <div class="col-md-9">
                        @if(!Auth::user())
                        <div class="row">
                                <div class="col-md-6">
                                        <a href="{{ route('login') }}" class="box-wrap">
                                            <div class="page-info page-info-lite rounded">
                                                <div class="iconbox-wrap-content">
                                                    <h5 class="blue-color glyph text-center"> 
                                                        <i class="glyph-icon flaticon-box"></i>
                                                    </h5>
                                                </div> 
                                                <div class="iconbox-wrap-text text-center">
                                                    <h3 class="blue-color">
                                                        {{ __('Je suis un ') }} 
                                                        <span>{{ __('fournisseur') }}</span>
                                                    </h3>
                                                    <span>
                                                        {{ __("Rechechez, trouvez et répondez aux appels d'offres dans votre secteur d'activité") }} <br>
                                                        {{ __('Prenez contact avec vos futurs clients') }} <br>
                                                    </span>  
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <a href="{{ route('register') }}" class="box-wrap">
                                            <div class="page-info page-info-lite rounded">
                                                    <div class="iconbox-wrap-content">
                                                        <h5 class="green-color glyph text-center">
                                                                <i class="glyph-icon flaticon-pay"></i>
                                                        </h5>
                                                    </div> 
                                                    <div class="iconbox-wrap-text text-center">
                                                        <h3 class="green-color ">{{ __('Je suis ') }}<span> {{ __('un acheteur') }}</span></h3>
                                                        <span>{{ __("Réceptionnez des offres compétitives") }} <br>
                                                            {{ __('Constituez vous un panel de fournisseur') }} <br>
                                                            {{ __("Gains de temps et d'argent") }}
                                                        </span> 
                                                    </div>
                                                
                                            </div>
                                        </a>
                                    </div>
                                    <div class="h-spacer"></div> 
                        </div>
                        <div class="h-spacer"></div>
                        @endif 
                        <div class="row">
                                <div class="col-md-6">
                                        <div class="content-box col-lg-12 layout-section">
                                                <div class="row row-featured row-featured-category">
                                                    <div class="col-lg-12 box-title no-border">
                                                        <div class="inner">
                                                            <h2>
                                                                <span class="title-3">{{ __('Derniers') }} <span style="font-weight: bold;">{{ __('Appels doffres') }}</span></span>
                                                                 
                                                            </h2>
                                                        </div>
                                                    </div>
                                                    @foreach ($posts as $post)  
                                                        <div class="adds-wrapper jobs-list">
                                                                <div class="item-list job-item">
                                                                    {{--  <div class="col-sm-2 col-xs-2 no-padding photobox">
                                                                        <div class="add-image">   
                                                                            <a href={{ url("/offre/".$post->slug.'/'.$post->id) }}>
                                                                                @if($post->company->avatarc)
                                                                                <img src="{{URL::to('/')}}/img/avatarsc/{{ $post->company->avatarc }}" class="thumbnail no-margin img-responsive">
                                                                                @else
                                                                                    <img src="{{URL::to('/')}}/img/noimage.jpg">
                                                                                @endif
                                                                            </a>
                                                                        </div>
                                                                    </div>   --}}
                                                                    <div class="col-sm-12 col-xs-12  add-desc-box">
                                                                        <div class="add-details jobs-item">
                                                                            <h4 class="job-title">
                                                                                    <a href="{{ url("/offre/".$post->slug) }}"> {{ strlen($post->name) > 100 ? substr($post->name,0,60).'...' : $post->name }} </a>
                                                                            </h4>
                                                                            {{--  <span><i class="fa fa-globe"></i> {{ $post->company->name }}</span>  --}}
                                                                            <span class="info-row">
                                                                                <span class="date">
                                                                                    <i class="fa fa-map-marker"></i>
                                                                                    <small>{{ $post->country->name }}</small>
                                                                                </span>
                                                                                <span class="date">
                                                                                    <i class="icon-clock"> </i>
                                                                                    <small>{{ $post->created_at->diffForHumans() }}</small>
                                                                                </span>  
                                                                            </span>         
                                                                            <div class="jobs-action">
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
                                                                                                class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'favorite_posts' : ''}}"> <i class="fa fa-heart"></i>{{ $post->favorite_to_users->count() }}
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
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="text-center">
                                                    <a href="{{ route('posts') }}" class="" style="margin:10px 0; display:block">
                                                        <i class="icon-th-list"></i> {{ __("Toutes les offres") }}
                                                    </a>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="content-box col-lg-12 layout-section">
                                                <div class="row row-featured row-featured-category">
                                                    <div class="col-lg-12 box-title no-border">
                                                            <div class="inner">
                                                                    <h2 class="text-center">
                                                                        <span class="title-3">{{ __('Fournisseurs') }}  </span>
                                                                         
                                                                    </h2>
                                                                </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 f-category">
                                                        <a href="#">
                                                                <img src="{{URL::to('/')}}/img/noimage.jpg" class="img-responsive">
                                                            <h6>  
                                                                <span class="company-name"> SMC CHAUDRONNERIE</span>
                                                            </h6>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 f-category">
                                                        <a href="#">
                                                                <img src="{{URL::to('/')}}/img/noimage.jpg" class="img-responsive">
                                                            <h6>  
                                                                <span class="company-name">   PRESSE ETUDE</span>
                                                                </h6>
                                                            </a>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 f-category">
                                                        <a href="#">
                                                                <img src="{{URL::to('/')}}/img/noimage.jpg" class="img-responsive">
                                                            <h6>  
                                                                <span class="company-name">   ID² Engineering & Manufacturing</span>
                                                                </h6>
                                                            </a>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 f-category">
                                                        <a href="#">
                                                                <img src="{{URL::to('/')}}/img/noimage.jpg" class="img-responsive">
                                                            <h6>  
                                                                <span class="company-name">   ID² Engineering & Manufacturing</span>
                                                                </h6>
                                                            </a>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 f-category">
                                                        <a href="#">
                                                                <img src="{{URL::to('/')}}/img/noimage.jpg" class="img-responsive">
                                                            <h6>  
                                                                <span class="company-name">   ID² Engineering & Manufacturing</span>
                                                                </h6>
                                                            </a>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 f-category">
                                                        <a href="#">
                                                                <img src="{{URL::to('/')}}/img/noimage.jpg" class="img-responsive">
                                                            <h6>  
                                                                <span class="company-name">   ID² Engineering & Manufacturing</span>
                                                                </h6>
                                                            </a>
                                                    </div>
                                                
                                                </div>
                                                <div class="text-center">
                                                    <a href="#" class="" style="margin:10px 0; display:block">
                                                        <i class="icon-th-list"></i> {{ __("Tous les fournisseurs") }}</a>
                                                    </div>
                                        </div>
                                </div>
                        </div>
                        
                        

                </div> 
            </div>
            <div class="h-spacer"></div>
                      
        </div>
@stop



 
        