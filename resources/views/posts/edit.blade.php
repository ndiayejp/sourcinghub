@extends('layouts.app')


@section('title')
{{ __(' Mettre à jour une annonce') }} | {{config('app.name') }}
@stop
<div class="h-spacer"></div>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 page-content">
                <div class="inner-box category-content">
                    <h2 class="title-2"> <i class="icon-docs"></i> {{ __("Mise à jour appel d'offre Numéro")." ".$post->id }}</h2>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::model($post,['method' => 'put','url' => route('posts.update',$post),'files'=>true]) !!}
                                 
                                <div class="form-group {{ $errors->has('company_id') ? 'has-error' : ''}}">
                                    {{Form::label('company_id', __('Compagnie'))}} 
                                    {!! Form::select('company_id', $companies,null, ['class' => 'select form-control','placeholder'=>'Choississez une entreprise']); !!}
                                    @if ($errors->has('company_id'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('company_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="content-subheading">
                                    <i class="icon-town-hall fa"></i>  {{ __("Détail de l'offre") }}
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                            {{Form::label('name', __('Titre'))}} <sup>*</sup>
                                            {{Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Titre')])}}
                                            @if ($errors->has('name'))
                                                <span class="help-block" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                       
                                        <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('delivery_date') ? 'has-error' : ''}}">
                                                        {{Form::label('delivery_date', "Date de livraison")}} <sup>*</sup>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                            {{Form::text('delivery_date', $post->delivery_date, ['class'=>'form-control Inputdatetime'])}}
                                                        </div>
                                                        
                                                        @if ($errors->has('delivery_date'))
                                                            <span class="help-block" role="alert">
                                                                <strong>{{ $errors->first('delivery_date') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('closing_date') ? 'has-error' : ''}}">
                                                        {{Form::label('closing_date', 'Date de cloture')}} <sup>*</sup>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                            {{Form::text('closing_date', $post->closing_date, ['class' => 'form-control Inputdatetime'])}}
                                                        </div>
                                                        @if ($errors->has('closing_date'))
                                                            <span class="help-block" role="alert">
                                                                <strong>{{ $errors->first('closing_date') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                                {{Form::label('description', __('Description'))}} <sup>*</sup>
                                                {{Form::textarea('description', null, [  'class' => 'textarea-wysiwyg form-control', 'placeholder' => 'description'])}}
                                                @if ($errors->has('description'))
                                                    <span class="help-block" role="alert">
                                                        <strong>{{ $errors->first('description') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                       
                                        <div class="form-group"> 
                                                {{Form::label('Items', __("Composer une liste d'articles"))}}   
                                                <table class="table table-bordered" id="item_table">
                                                    <tr>
                                                        <th>{{ __('Désignation') }}</th>
                                                        <th>{{ __('Description') }}</th>
                                                        <th style="width:18%">{{ __('Unité') }}</th>
                                                        <th>{{ __('Quantité') }}</th> 
                                                        <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="fa fa-plus"></span></button></th>
                                                    </tr>
                                                    <tr>
                                                       @foreach ($items as $item )
                                                       {{Form::hidden('item_id[]', $item['id'], ['class' => 'form-control'])}}
                                                        <td>{{Form::text('item_name[]', $item['item_name'], ['class' => 'form-control'])}}</td>
                                                        <td>{{Form::textarea('item_description[]', $item['item_description'], ['class' => 'form-control','rows' => 1])}}</td>
                                                        <td> 
                                                            <select name="item_unit[]" id="item_unit" class="form-control item_unit">
                                                                @foreach($units as $unit)
                                                                    <option
                                                                        @foreach($post->items as $postItem)
                                                                            {{ $postItem->item_unit == $unit->code ? 'selected' : '' }}
                                                                        @endforeach
                                                                        value="{{ $unit->code }}">{{ $unit->code }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>{{Form::number('item_qte[]', $item['item_qte'], ['class' => 'form-control'])}}</td>
                                                        <td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="fa fa-minus"></span></button></td></tr>
                                                        @endforeach
                                                    </table>        
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('categories', __('Catégories')); !!} <sup>*</sup>
                                            {!! Form::select('categories[]', $categories,null, ['class' => 'form-control select','multiple']); !!}
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('incoterm_id') ? 'has-error' : ''}}">
                                                    {!! Form::label('incoterm_id', 'Incoterm'); !!}
                                                    {!! Form::select('incoterm_id', $incoterms,null, ['class' => 
                                                    'form-control select','placeholder'=>'Choississez un incoterm']); !!}
                                                    @if ($errors->has('incoterm_id'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('incoterm_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {{Form::label('budget', __('Budget'))}} 
                                                    {{Form::text('budget', null, ['class' => 'form-control', 'placeholder' => __('Budget')])}}
                                                    @if ($errors->has('budget'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('budget') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                           
                                        
                                        
                                        
                                         
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('payment_method') ? 'has-error' : ''}}">
                                                    {{Form::label('payment_method', "Modalité de paiement :")}} <sup>*</sup>
                                                    {{  Form::select('payment_method', ['Immédiat' => 'Immédiat', 
                                                    '30 jours' => '30 jours','90 jours'=>'90 jours',
                                                    'Négocier'=>'Négocier'],null,['class' => 'form-control select','placeholder'=>'Choississez une modalité']) }}
                                                    @if ($errors->has('payment_method'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('payment_method') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('offer_in_device') ? 'has-error' : ''}}">
                                                    {{Form::label('offer_in_device', "Offres à faire en :")}} <sup>*</sup>
                                                    {{  Form::select('offer_in_device', ['Cfa' => 'Cfa', 'Euro' => 'Euro','Dollar'=>'Dollar'],null,['class' => 'form-control select','placeholder'=>'Choississez une devise']) }}
                                                    @if ($errors->has('offer_in_device'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('offer_in_device') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('country_id') ? 'has-error' : ''}}">
                                                    {!! Form::label('country_id', __('Pays')); !!} <sup>*</sup>
                                                    {!! Form::select('country_id', $countries,null, ['class' => 
                                                    'form-control select','placeholder'=>'Choississez un Pays']); !!}
                                                    @if ($errors->has('country_id'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('country_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('address_delivery') ? 'has-error' : ''}}">
                                                    {{Form::label('address_delivery', __("Autre adresse de livraison"))}} <sup>*</sup>
                                                    {{Form::text('address_delivery', null, ['class' => 'form-control'])}}
                                                    @if ($errors->has('address_delivery'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('address_delivery') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                                 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group {{ $errors->has('opens') ? 'has-error' : ''}}">
                                                    {!! Form::label('opens', __("Marché")); !!}
                                                    {!! Form::select('opens[]', $opens,$post->opens->pluck('id'), ['class' => 'form-control select','multiple']); !!}
 
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">  
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {{Form::label('files', __('Joindre des fichiers'))}} 
                                                    <input type="file" name="file[]" id="files" multiple class="form-control">
                                                </div>
                                            </div>
                                            @if(count($post->files)>0)
                                                <div class="col-md-12">
                                                   <strong>{{ __('Fichiers joints pour cette offre') }}</strong>
                                                    <div class="table-responsive text-center">
                                                        <table class="table table-borderless" id="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center"></th>
                                                                    <th class="text-center"></th>
                                                                </tr>
                                                            </thead>
                                                            @foreach($post->files as $file)
                                                                <tr id="file{{$file->id}}">
                                                                    <td> {{ $file->name }}</td>
                                                                    <td>
                                                                        <button class="btn btn-danger  btn-sm delete-file" value="{{$file->id}}"><i class="fa fa-remove"></i>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="row">
                                                <div class="col-md-12">
                                                        <div class="form-group {{ $errors->has('state_id') ? 'has-error' : ''}}">
                                                                {!! Form::label('state_id', __("Statut de l'appel d'offre")); !!}
                                                                {!! Form::select('state_id', $states,null, ['class' => 
                                                                'form-control select','placeholder'=>__("Choisissez un statut")]); !!}
                                                                @if ($errors->has('state_id'))
                                                                    <span class="help-block" role="alert">
                                                                        <strong>{{ $errors->first('state_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                        </div>
                                                    </div>
                                        </div> 
                                        
                                        
                                    </div>
                                </div>  
                               
                                <div class="row">
                                    <div class="col-md-6">
                                            {{Form::submit("Mettre à jour l'appel d'offre ", 
                                            ['class'=>'btn btn-primary btn-lg btn-block','name'=>'publish'])}}
                                    </div>
                                    <div class="col-md-6">
                                            @if($post->state['url_state'] == 'en-cours')
                                            {{Form::submit("Enregistrer comme brouillon ", 
                                            ['class'=>'btn btn-default btn-lg btn-block','name'=>'draft'])}}
                                            @endif
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
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
                language:'fr'
            });

            $('.textarea-wysiwyg').trumbowyg({

                btns: ['strong', 'em', '|', 'link','|','unorderedList', 
                'orderedList','|','justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull','|','viewHTML',
                '|','undo', 'redo'],
                autogrow: true,
                lang: 'fr'
            });

            $(document).on('click', '.add', function(){

                var html = '';
                html += '<tr>';
                html += '<td><input type="text" name="item_name[]" class="form-control item_name" /></td>';
                html += '<td><textarea name="item_description[]" class="form-control item_description" rows= 1 /></td>';
                html += '<td><input type="text" name="item_unit[]" class="form-control item_unit">  </td>';
                html += '<td><input type="text" name="item_qte[]" class="form-control item_quantity" /></td>';
                html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="fa fa-minus"></span></button></td></tr>';
                $('#item_table').append(html);
            });

            $(document).on('click', '.remove', function(){
                $(this).closest('tr').remove();
            });

            $(document).ready(function() {
                $('select[name="country_id"]').on('change', function() {
                    
                    var countryID = $(this).val();

                    if(countryID) {

                        $.ajax({

                            url: '/getCities/ajax/'+countryID,
                            type: "GET",
                            dataType: "json",
                            success:function(data) {
                                 
                                $('select[name="city_id"]').empty();

                                $.each(data, function(key, value) {

                                    $('select[name="city_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                                });
        
        
                            }
                        });
                    }else{
                        $('select[name="city_id"]').empty();
                    }
                });
            });

            $('.delete-file').click(function (e) {

                e.preventDefault();

                var file_id = $(this).val();

                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({

                    type: "DELETE",
                    url: '/files/' + file_id,
                    data: {
                       'id':file_id 
                    },
                    dataType: 'json',
                    success: function (data) {  

                        $("#file" + file_id).remove();
                    },
                    error: function (data) {

                        console.log('Error:', data);
                    }
                });
            });
         

             
        </script>
@stop