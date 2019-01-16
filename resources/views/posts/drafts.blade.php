@extends('layouts.app') 
@section('title')
{{ __('Mes offres') }} | {{config('app.name') }}
@stop

<div class="h-spacer"></div>
@section('content')
    <div class="container"> 
        <div class="row"> 
            @include('layouts/partials/_sidebar') 
            <div class="col-sm-9 page-content">
                <div class="inner-box">
                    <h2 class="title-2">
                        <i class="icon-docs"></i> {{ __('Mes brouillons') }}
                    </h2>
                    {!! Form::open(['action' => 'PostsController@index', 'method' => 'GET']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group"> 
                                        <input type="text" name="q" class="form-control" placeholder="Entrez un mot clef..." value="{{ isset($_GET['q']) ? $_GET['q'] : '' }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary btn-lg"><i class="fa fa-search"></i></button> 
                                        </div>
                                    </div>  
                                </div>
                            </div> 
                        </div>
                    {!! Form::close() !!}
                    <div class="table-responsive"> 
                        <div class="table-action"></div>
                        <table id="addManageTable" class="table table-striped table-condensed table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                        <th>{{ __('Titre') }}</th>
                                    <th>{{ __('Catégorie') }}</th>
                                    <th>{{ __('Vues') }}</th>
                                    <th>{{ __('Offres') }}</th>
                                    <th>{{ __("Statut") }}</th>
                                    <th>{{ __("Etat") }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($posts->count()==0)
                                    <tr>
                                        <td colspan="8" class="text-center"><div class="btn btn-danger">{{ __('Aucune offre rattachée à ce compte') }}</div></td>
                                    </tr> 
                                @else
                                    @foreach ($posts as $post) 
                                        <tr>    
                                            <td class="add-img-selector">
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="entries[]" value="898"></label>
                                                </div>
                                            </td>
                                            <td class="ads-details-td">{{ $post->name }}</td>
                                            <td class="ads-cat-td">
                                                
                                                    <span class="label label-default">{{ $post->cat_name }}</span>
                                                
                                            </td>
                                            <td>{{ $post->view_count }}</td>
                                            <td><a href="{{ url("/offre/".$post->slug) }}" class="badge badge-light">{{ $post->offers_count }}</a>      </td>
                                            <td>
                                                @if($post->active == 1)
                                                    <span class="badge bg-success">{{ __('Actif') }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ __('Brouillon') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($post->state['url_state'] == 'en-cours')
                                                    <span class="badge bg-info">{{ __('En Cours') }}</span>
                                                @elseif($post->state['url_state'] == 'cloturer')
                                                    <span class="badge bg-danger">{{ __('Cloturer') }}</span>
                                                @elseif($post->state['url_state'] == 'attribuer')
                                                    <span class="badge bg-success">{{ __('Attribuer') }}</span>
                                                @endif
                                            </td>
                                            <td class="action-td text-center">
                                                <div class="btn-group-vertical" role="">
                                                    <div class="btn-group"><a href="{{ route('posts.edit',$post->id)}}" class="btn btn-default" data-toggle="tooltip" title="Editer" data-toggle="tooltip"><i class="fa fa-pencil"></i> </a></div> 
                                                    
                                                    {!! Form::open(['method' => 'delete','url' => route('posts.destroy',$post->id),'class'=>'btn-group','id'=>'form-button-delete']) !!}
                                                        {!! Form::button(__('<i class="fa fa-trash"></i> '),array('class'=>'btn btn-default ', 'type' => 'submit','title'=>"Supprimer",'data-toggle'=>'tooltip')) !!}
                                                    {!! Form::close() !!}
                                                    
                                                    @if($post->active==1)
                                                        @if($post->state['url_state'] != 'cloturer')
                                                        <div class="btn-group"><a href="#" class="btn btn-default" title="Inviter des fournisseurs"  data-toggle="tooltip"><i class="fa fa-envelope-open-o"></i> </a></div>
                                                        @endif
                                                    @endif
                                                    @if($post->active==1)
                                                    <div class="btn-group">
                                                        <a href="{{ url("/offre/".$post->slug) }}" class="btn btn-default" data-toggle="tooltip" title="Voir l'offre"><i class="fa fa-file-text-o"></i> </a> 
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach 
                                    {{ $posts->links() }}
                                @endif 
                            </tbody>
                        </table> 
                    </div>
                </div> 
            </div>
        </div>
    </div>
@stop 
@section('script')
    <script>  </script>
@stop