@extends('layouts.app')


@section('title')
{{ __('Publier une annonce') }} | {{config('app.name') }}
@stop
<div class="h-spacer"></div>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 page-content">
                <div class="inner-box category-content">
                    <h2 class="title-2">
                       <i class="icon-docs"></i> {{ __('Publier une offre') }}
                    </h2>
                    <div class="row">
                        <div class="col-md-12">
                            @if(count($errors) >0 )
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                    </div>
                            @endif
                            {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','id'=>'insert_form']) !!}
                                 <div class="form-group">
                                    {{Form::label('company_id', 'Compagnie')}}  
                                    @if(count($companies)==0)
                                        <br>
                                        <a href="/companies/create" class="btn btn-danger">{{ __('Créer une entreprise avant') }}</a>
                                    @else
                                        <select name="company_id" id="company_id" class="form-control">
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                                <div class="content-subheading">
                                    <i class="icon-town-hall fa"></i>  {{ __("Détail de l'appel d'offre") }}
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                            {{Form::label('name', 'Titre')}} <sup>*</sup>
                                            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Titre'])}}
                                            @if ($errors->has('name'))
                                                <span class="help-block" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
                                                {{Form::hidden('slug', '', ['class' => 'form-control', 'placeholder' => 'URL'])}}
                                                @if ($errors->has('slug'))
                                                    <span class="help-block" role="alert">
                                                        <strong>{{ $errors->first('slug') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                        <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('delivery_date') ? 'has-error' : ''}}">
                                                        {{Form::label('delivery_date', "Date de livraison")}} <sup>*</sup>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                            {{Form::text('delivery_date', '', ['class'=>'form-control Inputdatetime'])}}
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
                                                            {{Form::text('closing_date', '', ['class' => 'form-control Inputdatetime'])}}
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
                                                {{Form::label('description', 'Description')}} <sup>*</sup>
                                                {{Form::textarea('description', '', [ 'class' => 'textarea-wysiwyg form-control', 'placeholder' => 'description','cols'=>'5'])}}
                                                @if ($errors->has('description'))
                                                    <span class="help-block" role="alert">
                                                        <strong>{{ $errors->first('description') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                        <div class="form-group">
                                                {{Form::label('Items', "Composer une liste d'articles")}}   
                                                <span id="error"></span>
                                                <table class="table table-bordered" id="item_table">
                                                    <tr>
                                                        <th>{{ __('Désignation') }}</th>
                                                        <th>{{ __('Description') }}</th>
                                                        <th>{{ __('Quantité') }}</th>
                                                        <th style="width:18%">{{ __('Unité') }}</th> 
                                                        <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="fa fa-plus"></span></button></th>
                                                    </tr>
                                                    <tbody class="ItemBody">
                                                        <tr class="Itemrow"> 
                                                            <td>{{Form::text('item_name[]', '', ['class' => 'form-control item_name'])}}</td>
                                                            <td>{{Form::textarea('item_description[]', '', ['class' => 'form-control item_description','rows' => 1])}}</td>
                                                            <td>{{Form::number('item_qte[]', '', ['class' => 'form-control item_quantity'])}}</td>
                                                            <td> 
                                                                <select name="item_unit[]" id="item_unit" class="form-control   item_unit" placeholder="choix">
                                                                    <option value="">{{ __('Choisissez') }}</option>
                                                                    @foreach($units as $unit)
                                                                        <option value="{{ $unit->code }}">{{ $unit->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="fa fa-minus"></span></button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>    
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            {!! Form::label('categories', "Secteur d'activité"); !!} <sup>*</sup><br>
                                            {!! Form::select('category_id', $categories,null, ['class' => 'form-control select']); !!}
                                            @if ($errors->has('categories[]'))
                                                <span class="help-block" role="alert">
                                                    <strong>{{ $errors->first('categories[]') }}</strong>
                                                </span>
                                            @endif 
                                        </div>
                                        <div class="form-group {{ $errors->has('open_id') ? 'has-error' : ''}}">
                                            {!! Form::label('open_id', __("Type de marché")); !!}
                                            {!! Form::select('opens[]', $opens,null, ['class' => 'form-control select','multiple']); !!}
                                        </div> 
                                        <div class="form-group">
                                            {!! Form::label('areas', "Domaine d'activité"); !!} <sup>*</sup><br>
                                            {!! Form::select('area_id', $areas,null, ['class' => 'form-control select']); !!}
                                            @if ($errors->has('areas[]'))
                                                <span class="help-block" role="alert">
                                                    <strong>{{ $errors->first('areas[]') }}</strong>
                                                </span>
                                            @endif 
                                        </div>
                                        
                                       <div class="row">
                                           <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('incoterm_id') ? 'has-error' : ''}}">
                                                    {!! Form::label('incoterm_id', 'Incoterm'); !!} <sup>*</sup>
                                                    {!! Form::select('incoterm_id', $incoterms,null, ['class' => 
                                                    'form-control select','placeholder'=>__('Choisissez un incoterm')]); !!}
                                                    @if ($errors->has('incoterm_id'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('incoterm_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                           </div>
                                           <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('budget') ? 'has-error' : ''}}">
                                                    {{Form::label('budget', 'Budget')}} 
                                                    {{Form::text('budget', '', ['class' => 'form-control'])}}
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
                                                    {{Form::label('payment_method', __("Modalité de paiement"))}} <sup>*</sup>
                                                    {{  Form::select('payment_method', ['Immédiat' => 'Immédiat', 
                                                    '30 jours' => '30 jours','90 jours'=>__('90 jours'),
                                                    'Négocier'=>'Négocier'],null,['class' => 'form-control select','placeholder'=>'Choisissez une modalité']) }}
                                                    @if ($errors->has('payment_method'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('payment_method') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('offer_in_device') ? 'has-error' : ''}}">
                                                    {{Form::label('offer_in_device', __("Offres à faire en"))}} <sup>*</sup>
                                                    {{  Form::select('offer_in_device', ['Cfa' => __('Cfa'), 'Euro' => 'Euro','Dollar'=>'Dollar'],null,['class' => 'form-control select','placeholder'=>'Choisissez une devise']) }}
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
                                                    {!! Form::label('country_id', __('Pays de livraison')); !!} <sup>*</sup>
                                                    {!! Form::select('country_id', $countries,null, ['class' => 
                                                    'form-control select','placeholder'=>'Choisissez un pays']); !!}
                                                    @if ($errors->has('country_id'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('country_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('address_delivery') ? 'has-error' : ''}}">
                                                    {{Form::label('address_delivery', 'Adresse de livraison')}} <sup>*</sup>
                                                    {{Form::text('address_delivery', '', ['class' => 'form-control'])}}
                                                    @if ($errors->has('address_delivery'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('address_delivery') }}</strong>
                                                        </span>
                                                    @endif
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
                                        </div>
                                        <hr>
                                        <div class="row">
                                                <div class="col-md-12">
                                                    {{--  <div class="form-group {{ $errors->has('state_id') ? 'has-error' : ''}}">
                                                            {!! Form::label('state_id', __("Statut de l'appel d'offre")); !!}
                                                            {!! Form::select('state_id', $states,null, ['class' => 
                                                            'form-control select']); !!}
                                                            @if ($errors->has('state_id'))
                                                                <span class="help-block" role="alert">
                                                                    <strong>{{ $errors->first('state_id') }}</strong>
                                                                </span>
                                                            @endif
                                                    </div>  --}}
                                                    <input type="hidden" value="1" name="state_id">
                                                </div>
                                            </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">
                                        {{Form::submit("Enregistrer l'appel d'offre ",['class'=>'btn btn-primary btn-lg btn-block','name'=>'publish'])}}
                                    </div>
                                    <div class="col-md-6">
                                        {{Form::submit("Enregistrer comme brouillon ",['class'=>'btn btn-default btn-lg btn-block','name'=>'draft'])}}
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
                 
                var $tableItems = $('#item_table');
                $Itemrow = $('.Itemrow');
                $ItemBody= $('.ItemBody');
                var markup = $ItemBody.children()[0].outerHTML;
                console.log(markup);
                 
                $('.ItemBody').append(markup);
                 
                //$orderMenuItems.append(markup);
            });
            $(document).on('click', '.remove', function(){
                $(this).closest('tr').remove();
            });
            $('#insert_form').on('submit', function(event){
                event.preventDefault();
                var error = '';
                $('.item_name').each(function(){
                    var count = 1;
                    if($(this).val() == '')
                    {
                     error += "<p>Entrez un nom pour la ligne"+count+"</p>";
                     return false;
                    }
                    count = count + 1;
                });
                $('.item_description').each(function(){
                    var count = 1;
                    if($(this).val() == '')
                    {
                     error += "<p>une description est obligatoire ligne "+count+"</p>";
                     return false;
                    }
                    count = count + 1;
                });
                $('.item_quantity').each(function(){
                    var count = 1;
                    if($(this).val() == '')
                    {
                     error += "<p>Une quantité est requise ligne "+count+" </p>";
                     return false;
                    }
                    count = count + 1;
                });
                $('.item_unit').each(function(){
                    var count = 1;
                    if($(this).val() == '')
                    {
                     error += "<p>Une unité est requise à la ligne "+count+" </p>";
                     return false;
                    }
                    count = count + 1;
                });
                if(error == ''){
                        $('#insert_form').unbind('submit').submit();
                }else {
                     $('#error').html('<div class="alert alert-danger">'+error+'</div>');
                }
            });

            
        </script>
@stop