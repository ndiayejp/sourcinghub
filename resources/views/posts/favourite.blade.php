@extends('layouts.app')

@section('title')
{{ __('Les offres favorites') }} | {{config('app.name') }}
@stop

@section('content')
 
 <div class="main-container">
    <div class="container">
        <div class="row">
            @include('layouts/partials/_sidebar')   
            <div class="col-sm-9 page-content col-thin-left">
                    <h2>
                        {{ __("Appels d'offres favoris") }}
                        <span class="badge bg-blue">{{ $posts->count() }}</span>
                    </h2>
                    <div class="h-spacer"></div>
                @if($posts->count() > 0)
                
                    <div class="category-list">
                        <div class="tab-box clearfix">
                            <div class="listing-filter hidden-xs"></div>
                            <div class="adds-wrapper jobs-list">
                                @foreach($posts as $key=>$post)
                                    <div class="item-list job-item make-list">
                                        {{--  <div class="col-sm-1 col-xs-2 no-padding photobox">
                                            <div class="add-image">
                                                <img src="{{URL::to('/')}}/img/avatarsc/{{ $post->company->avatarc }}" class="thumbnail no-margin img-responsive">
                                            </div>
                                        </div>  --}}
                                        <div class="col-sm-12 col-xs-12 add-desc-box">
                                            <div class="add-details jobs-item">
                                               
                                                <h4>
                                                <a href="{{ url("/offre/".$post->slug) }}">{{ $post->name }}</a>
                                                <span style="display:block">{{__("N° appel d'offre:")}} {{'AO'.'-'.$post->id.'-'.Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->year }}</span>
                                                </h4>
                                                <span class="info-row">
                                                        <span class="date">
                                                            <i class="icon-clock"> </i>
                                                            {{ $post->created_at->diffForHumans() }}
                                                        </span>
                                                        <span class="item-location">
                                                            <i class="fa fa-map-marker"></i>
                                                            {{ $post->country->name }}
                                                            
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
                                                                        class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'favorite_posts' : ''}}"> <i class="fa fa-heart"></i>{{ $post->favorite_to_users->count() }}</a>
                                
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
                    
                    </div>
                
                    <div class="pagination-bar text-center">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="category-list">
                        <div class="tab-box clearfix">
                            <div class="listing-filter hidden-xs"></div>
                                <div class="adds-wrapper jobs-list text-center">
                                    <div class="h-spacer"></div>
                                      <div class="btn btn-danger">
                                            {{ __('Aucune offre mise en favoris') }}
                                      </div>
                                    <div class="h-spacer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop