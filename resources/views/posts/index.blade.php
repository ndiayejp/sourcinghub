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
                <div class="panel panel-default">
                    <div class="panel-header">
                        <h3 class="title-2"> <i class="icon-docs"></i> {{ __('Mes offres') }} </h3>
                    </div>
                    <div class="panel-body">  
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
                                            <td colspan="6" class="text-center"><div class="btn btn-danger">{{ __('Aucune offre rattachée à ce compte') }}</div></td>
                                            
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
                                                    <span class="badge bg-danger">{{ __('Non actif') }}</span>
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
                                                        <div class="btn-group"><a href="#"   data-id="{{$post->id}}" data-toggle="modal" class="quickInvite btn btn-default" title="Inviter des fournisseurs"><i class="fa fa-envelope-open-o"></i> </a></div>
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
    </div>
    <div class="modal" id="quickInvite" tabindex="-1" role="dialog" >
            <div class="modal-dialog  modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="icon-login fa"></i>{{ __("Inviter des fournisseurs") }} </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" role="form" id="frmInvites">
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="id_edit" disabled>
                            <input type="hidden" value="{{ Auth::user()->id }}" name="user" id="user">
                            <div class="form-group ">
                                <label for="email" class="control-label">{{ __("Emails") }}</label>
                                <input id="multiEmail" name="email" type="text" placeholder="Email" class="form-control">
                                
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                           <input type="submit" value="Envoyer l'invitation " class="btn btn-primary invite">
                        </div>
                    </form>
        
                </div>
            </div>
    </div>
@stop

@section('script')
         <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">
         <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
         <script>
            $('#multiEmail').tagsinput({
                trimValue: true,
                confirmKeys: [188, 44],
                allowDuplicates: false
            });

            // Invite
            $(document).on('click', '.quickInvite', function() {
                $('#id_edit').val($(this).data('id')); 
                id = $('#id_edit').val();
                $('#quickInvite').modal('show');
            });

            $('.modal-footer').on('click', '.invite', function(event) {
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    url:  "{{ url('/invite/post') }}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': $("#id_edit").val(),
                        'email':$('#multiEmail').val(),
                        'user':$('#user').val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        if ((data.errors)) {
                            setTimeout(function () {
                                $('#quickInvite').modal('show');
                                toastr.error('Erreur de validation!', 'Error Alert', {timeOut: 5000});
                            }, 500);
                        }else{
                            toastr.success('Invitation envoyée', 'Success Alert', {timeOut: 5000});
                            $('#multiEmail').tagsinput('removeAll');
                            $('#quickInvite').modal('hide')
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

         </script>
@stop