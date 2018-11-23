@extends('layouts.app')


@section('title')
{{ __('Publier une entreprise') }} | {{config('app.name') }}
@stop
<div class="h-spacer"></div>
@section('content')
    <div class="container">
        <div class="row">
            @include('layouts/partials/_sidebar') 
            <div class="col-md-9 page-content">
                <div class="inner-box category-content">
                    <h2 class="title-2">
                       <i class="icon-docs"></i> {{ __('Publier une entreprise') }}
                    </h2>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['action' => 'CompaniesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                
                                
                                <div class="form-group {{ $errors->has('avatarc') ? 'has-error' : ''}}">
                                    <label for="avatarc">{{ __("Logo") }}</label> 
                                        {!! Form::file('avatarc',['class'=>'form-control']); !!}
                                        @if ($errors->has('avatarc'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('avatarc') }}</strong>
                                        </span>
                                    @endif
                                 </div>
                               
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                    {{Form::label('name', 'Nom entreprise')}} <sup>*</sup>
                                    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Titre'])}}
                                    @if ($errors->has('name'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                    {{Form::label('description', 'Description')}} <sup>*</sup>
                                    {{Form::textarea('description', '', ['id' => 'post-ckeditor', 'class' => 'form-control', 'placeholder' => 'description'])}}
                                    @if ($errors->has('description'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                                    {{Form::label('address', 'Adresse')}}
                                    {{Form::text('address', '', ['class' => 'form-control'])}}
                                    @if ($errors->has('address'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                        {{Form::label('email', 'Email')}}
                                        {{Form::text('email', '', ['class' => 'form-control'])}}
                                        @if ($errors->has('email'))
                                            <span class="help-block" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                                    {{Form::label('phone', 'Téléphone')}} <sup>*</sup>
                                    {{Form::text('phone', '', ['class' => 'form-control'])}}
                                    @if ($errors->has('phone'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                
                               
                                {{Form::submit('Enregistrer', ['class'=>'btn btn-primary'])}}
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
            $('.textarea-wysiwyg').trumbowyg({
                btns: ['strong', 'em', '|', 'link','|','unorderedList', 
                'orderedList','|','justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull','|','viewHTML',
                '|','undo', 'redo'],
                autogrow: true,
                lang: 'fr'
            });
        </script>
@stop