@extends('layouts.app')
@section('content')
<div class="h-spacer"></div>
<section id="login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-header">
                        <h2 class="title-2"><i class="icon-login fa"></i>{{ __('Se connecter avec') }}</h2> 
                    </div>
                    <div class="panel-body"> 
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" class="form-horizontal">
                            @csrf 
                            <div class="form-group row {{ $errors->has('email') ? 'has-error' : ''}}">
                                <label for="email" class="col-md-4 control-label ">{{ __('Adresse Email  ') }}</label> 
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                    name="email" value="{{ old('email') }}" required autofocus placeholder="youname@exemple.com"> 
                                    @if ($errors->has('email'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                            <div class="form-group row {{ $errors->has('password') ? 'has-error' : ''}}">
                                <label for="password" class="col-md-4 control-label">{{ __('Mot de passe') }}</label> 
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                    name="password" required placeholder="{{ __('ça reste secret') }}">
                                    @if ($errors->has('password'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="" class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> 
                                        <label class="form-check-label" for="remember">
                                            {{ __('Se souvenir de moi') }}
                                        </label>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group row mb-0">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __(' Connexion') }}
                                    </button>
                                    <hr>
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié ?') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer text-center">
                        <a href="{{ route('register') }}">{!! __("vous n'avez pas de compte ! <b>Inscrivez-vous maintenant</b>") !!}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
