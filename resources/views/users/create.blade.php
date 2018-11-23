@extends('layouts.app')

@section('title')
    {{ __("Créer un utilisateur") }} | {{ Auth::user()->name }}
@stop

@section('content')
    <div class="h-spacer"></div>
    <div class="h-spacer"></div>
        <div class="container">
            <div class="row">
                @include('layouts/partials/_sidebar')   
                    <div class="col-sm-9 page-content"> 
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                    <h4>{{ __("Ajouter un utilisateur") }}</h4>
                            </div>
                            <div class="panel-body">
                                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        @csrf
                                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                                <label for="name" class="col-md-4 control-label">{{ __("Nom d'utilisateur") }}
                                                    <sup>*</sup>
                                                </label>
                                                <div class="col-md-6">
                                                    {!!  Form::text('name',null, ['class' => 'form-control']) !!}  
                                                    @if ($errors->has('name'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div> 
                                            </div> 
                                            
                                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                                                <label for="phone" class="col-md-4 control-label">{{ __("Téléphone") }}
                                                        <sup>*</sup>
                                                </label>
                                                <div class="col-md-6">
                                                        {!!  Form::text('phone',null, ['class' => 'form-control']) !!}  
                                                        @if ($errors->has('phone'))
                                                            <span class="help-block" role="alert">
                                                                <strong>{{ $errors->first('phone') }}</strong>
                                                            </span>
                                                        @endif
                                                </div> 
                                            </div>
                                            
                                            
                                            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                                <label for="email" class="col-md-4 control-label">{{ __('E-Mail') }}
                                                        <sup>*</sup>
                                                </label> 
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="icon-mail"></i>
                                                        </span>
                                                        {!!  Form::email('email',null, ['class' => 'form-control']) !!} 
                                                    </div>
                                                    @if ($errors->has('email'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div> 
                                            </div> 
        
                                            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                                                <label for="password" class="col-md-4 control-label">{{ __('Mot de passe') }}
                                                    <sup>*</sup>
                                                </label>
                                                <div class="col-md-6">
                                                    {!!  Form::password('password', ['class' => 'form-control']) !!} 
                                                    <p class="help-block">{{ __("Au moins 6 caractères") }}</p>
                                                    @if ($errors->has('password'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                            </div>
                        
                                            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
                                                <label for="password-confirm" class="col-md-4 control-label" > {{ __('Confirmer le mot de passe') }}
                                                    <sup>*</sup>
                                                </label> 
                                                <div class="col-md-6">
                                                {!!  Form::password('password_confirmation', ['class' => 'form-control']) !!} 
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                    <label for="" class="col-md-4 control-label"></label>
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                                                            {{ __("Ajouter") }}
                                                        </button>
                                                    </div>
                                            </div>
                                    </form>
                            </div>
                        </div>
                    </div> 
                    
            </div>
        </div>
        
@stop