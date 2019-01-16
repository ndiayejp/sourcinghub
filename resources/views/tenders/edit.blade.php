@extends('layouts.app')
<div class="h-spacer"></div>
@section('content')
<div class="container"> 
    <div class="row"> 
        @include('layouts/partials/_sidebar') 
        <div class="col-sm-9 page-content">
            <div class="inner-box">
                <div id="tender">
                    <div class="panel panel-default" v-cloak>
                        <div class="panel-heading">
                            <div class="clearfix">
                                <span class="panel-title">{{ __("Editer la demande n° ") }} {{ $tender->id }}</span>
                                <a href="{{route('tenders.index')}}" class="btn btn-default pull-right">{{ __("Retour") }}</a>
                            </div>
                        </div>
                        <div class="panel-body"> 
                            <div class="panel-body"> 
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
                                
                                {!! Form::model($tender,['method' => 'put','url' => route('tenders.update',$tender)]) !!}
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                    <label>{{ __("Nom de la demande") }}</label>
                                    {{Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Titre'])}}
                                </div>    
                                <div class="row">
                                    <div class="col-sm-6">
                                         <div class="form-group {{ $errors->has('offer_in_device') ? 'has-error' : ''}}">
                                            {{Form::label('offer_in_device', __("Offres à faire en"))}} <sup>*</sup>
                                            {{  Form::select('offer_in_device', ['XOF' => __('XOF'), 'Euro' => 'Euro','Dollar'=>'Dollar'],null,['class' => 'form-control select','placeholder'=>'Choisissez une devise']) }}
                                            @if ($errors->has('offer_in_device'))
                                                <span class="help-block" role="alert">
                                                    <strong>{{ $errors->first('offer_in_device') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group {{ $errors->has('tender_date') ? 'has-error' : ''}}">
                                            <label>{{ __("Date de fin") }}</label>
                                            {{Form::date('tender_date', null, ['class' => 'form-control', 'placeholder' => __('Date')])}}
                                            
                                        </div>
                                    </div>  
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
                                            <label>Description</label>
                                            <input type="hidden" name="type" value="rq">
                                                {{Form::textarea('body', null, ['class' => 'form-control textarea-wysiwyg', 'placeholder' => __('Contenu')])}}
                                        </div>
                                    </div>
                                </div>
                                <hr> 
                                <table class="table table-bordered table-form">
                                    <thead>
                                        <tr>
                                            <th>{{ __("Nom du produit") }}</th>
                                            <th>{{ __("Unité") }}</th>
                                            <th>{{ __("Quantité") }}</th>
                                            <th>{{ __("Description") }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product )
                                        <tr>
                                             {{Form::hidden('product_id[]', $product['id'], ['class' => 'form-control'])}}
                                            <td class="table-name {{ $errors->has('product_name.0') ? 'has-error' : ''}}">
                                                {{Form::text('product_name[]', $product['name'], ['class' => 'form-control'])}}
                                            </td>
                                            <td class="table-unit {{ $errors->has('product_unit.0') ? 'has-error' : ''}}" >
                                                {{Form::text('product_unit[]', $product['unit'], ['class' => 'form-control'])}}
                                            </td>
                                            <td class="table-qte {{ $errors->has('product_unit.0') ? 'has-error' : ''}}">
                                                {{Form::text('product_qte[]', $product['qte'], ['class' => 'form-control'])}}
                                            </td>
                                            <td class="table-body {{ $errors->has('product_body.0') ? 'has-error' : ''}}">
                                                {{Form::textarea('product_body[]', $product['body'], ['class' => 'form-control','rows' => 1])}}
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="emails">{{ __("Emails des fournisseurs à contacter") }}</label>
                                            
                                             {!! Form::text('emails',$emails,['class'=>'form-control','id'=>'emails']) !!}
                                         
                                           
                                            <span class="help-block">{{ __("Appuyez sur la touche espace ou séparez les emails par une virgule") }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" >
                                        <i class="fa fa-plus-circle"></i>
                                        {{ __("Enregistrer la demande de devis") }}
                                    </button>   
                                </div> 
                            </div> 
                            {!! Form::close() !!}
                        </div> 
                        <div class="panel-footer"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
@section('script') 
    <script type="text/javascript"> 
        $('.textarea-wysiwyg').trumbowyg({
            btns: ['strong', 'em', '|', 'link','|','unorderedList', 
            'orderedList','|','justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull','|','viewHTML',
            '|','undo', 'redo'],
            autogrow: true,
            lang: 'fr'
        });

        $('#emails').multiple_emails(); 

        let  i=$('table tr').length;
        $('.table-add_line').click(function(){
            let count=$('table tr').length;
            let data = "<tr><td class='table-name'><input type='text' class='table-control form-control' name='product_name[]'></td>";
            data += "<td><input type='text' class='table-control form-control'  name='product_unit[]'></td>";
            data += "<td><input type='text' class='table-control form-control'  name='product_qte[]'></td>";
            data += "<td><textarea  class='table-control form-control' name='product_body[]' row='1'></textarea></td>";
            data += "<td><span class='remove-btn btn btn-danger'><i class='fa fa-trash'></i></span></td>";
            data += "</tr">
            $('table').append(data);
            i++;
        })
        $(document).on('click', '.remove-btn', function(){
            $(this).closest('tr').remove();
        }) 
    </script>
@endsection