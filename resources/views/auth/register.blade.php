@extends('layouts.app')

@section('content')
<div class="h-spacer"></div>
<section class="register">
        <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-header">
                                <h2 class="title-2"> <i class="icon-user-add"></i> 
                                    {{ __("Inscription") }}
                                </h2>
                            </div> 
                            <div class="panel-body">  
                                     {!! Form::open(['id'=>'signupForm','url'=> route('register')  ])!!} 
                                        <fieldset>
                                           <legend><h3>{{__("Identifiants")}}</h3></legend>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                                        <label for="name">{{ __("Nom d'utilisateur") }}
                                                                <sup>*</sup>
                                                        </label> 
                                                        {!!  Form::text('name',null, ['class' => 'form-control']) !!}  
                                                        @if ($errors->has('name'))
                                                            <span class="help-block" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif 
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                                        <label for="mailing">{{ __('Adresse email') }}  <sup>*</sup> </label> 
                                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                                        @if ($errors->has('mailing'))
                                                            <span class="help-block" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif 
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                                                    <label for="password">{{ __('Mot de passe') }}  <sup>*</sup> </label> 
                                                    {!!  Form::password('password', ['class' => 'form-control','placeholder'=>__("ça reste secret...")]) !!} 
                                                    <p class="help-block">{{ __("Au moins 6 caractères") }}</p>
                                                    @if ($errors->has('password'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif 
                                                </div>    
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
                                                    <label for="password-confirm"> {{ __('Confirmer le mot de passe') }} <sup>*</sup> </label> 
                                                    {!!  Form::password('password_confirmation', ['class' => 'form-control']) !!} 
                                                    <p class="help-block">{{ __("Au moins 6 caractères") }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        </fieldset>
                                        <fieldset>
                                          <legend><h3>{{__("Informations personnelles")}}</h3></legend>
                                        <div class="row"> 
                                            <div class="col-md-12">
                                                <div class="form-group {{ $errors->has('user_type') ? 'has-error' : ''}}">
                                                    <label for="name">{{ __("Vous êtes") }} <sup>*</sup></label> </br>
                                                    {!!  Form::radio('type','acheteur', ['class' => 'form-control']) !!} {{ __('Acheteur') }}
                                                    {!!  Form::radio('type','fournisseur', ['class' => 'form-control']) !!}  {{ __('Fournisseur') }}
                                                    @if ($errors->has('user_type'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('user_type') }}</strong>
                                                        </span>
                                                    @endif
                                                </div> 
                                            </div>
                                        </div> 
                                        <div class="form-group {{ $errors->has('company') ? 'has-error' : ''}}">
                                            {!!  Form::text('company',null, ['class' => 'form-control','placeholder'=>__("Organisme*")]) !!}  
                                            @if ($errors->has('company'))
                                                <span class="help-block" role="alert">
                                                    <strong>{{ $errors->first('company') }}</strong>
                                                </span>
                                            @endif 
                                        </div> 
                                        <div class="form-group {{ $errors->has('activity_id') ? 'has-error' : ''}}">
                                            {!! Form::select('activity_id', $activities,null, ['class' => 'form-control select','placeholder'=> __("Fonction") ]) !!}
                                            @if ($errors->has('activity_id'))
                                                <span class="help-block" role="alert">
                                                    <strong>{{ $errors->first('activity_id') }}</strong>
                                                </span>
                                            @endif 
                                        </div> 
                                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
                                             {!! Form::select('category_id', $categories,null, ['class' => 'form-control select','placeholder'=> __("Secteur d'activité") ]) !!}
                                            @if ($errors->has('category_id'))
                                                <span class="help-block" role="alert">
                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                </span>
                                            @endif 
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('firmsize') ? 'has-error' : ''}}">
                                                    {{  Form::select('firmsize', ['1' => '0-9', 
                                                    '2' => '10-49','3'=>__('50-499'),
                                                    '4'=>'500-999','5'=>'plus de 1000'],null,['class' => 'form-control select','placeholder'=>"Taille de l'entreprise"]) }}
                                                    @if ($errors->has('firmsize'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('firmsize') }}</strong>
                                                        </span>
                                                    @endif 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('country_id') ? 'has-error' : ''}}">
                                                    {!! Form::select('country_id', $countries,null, ['class' => 
                                                    'form-control select','placeholder'=>'Choisissez un pays']); !!}
                                                    @if ($errors->has('country_id'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('country_id') }}</strong>
                                                        </span>
                                                    @endif 
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row">
                                           <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('siret') ? 'has-error' : ''}}">
                                                     {!!  Form::text('siret',null, ['class' => 'form-control','placeholder'=>__("Ninea / Siret*") ]) !!}  
                                                    @if ($errors->has('siret'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('siret') }}</strong>
                                                        </span>
                                                    @endif 
                                                </div>
                                           </div>
                                           <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                                                     {!!  Form::text('phone',null, ['class' => 'form-control','placeholder'=>__("Téléphone*")]) !!}  
                                                    @if ($errors->has('phone'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                    @endif 
                                                </div>
                                           </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-12">
                                                <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                                                    {!!  Form::text('address',null, ['class' => 'form-control','placeholder'=>__("Adresse de facturation*") ]) !!}  
                                                    @if ($errors->has('address'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                    @endif 
                                                </div> 
                                           </div>
                                           
                                        </div>  
                                        <div class="form-group">
                                            <div class="termbox mb10">
                                                <label class="checkbox-inline" for="newsletter">
                                                    <input type="checkbox" name="newsletter" id="newsletter" value="1" type="checkbox" checked>
                                                     {!! __("J'autorise SourcingHub, à utiliser ces données pour m'envoyer par mail une newsletter et des informations relatives à ses activités.") !!} 
                                                </label>
                                            </div>
                                            <div style="clear:both"></div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="termbox mb10">
                                                <label class="checkbox-inline" for="term">
                                                    <input name="term" id="term" value="1" type="checkbox">
                                                    <a href="{{ route('cgu_path') }}" style="text-decoration:underline;font-weight:700"> {!! __("J'ai lu et j'accepte les  Termes &amp; Conditions d'utilisation") !!}</a>
                                                </label>
                                            </div>
                                            <div style="clear:both"></div>
                                        </div> 
                                        </fieldset>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block btn-lg">
                                                {{ __("Créer un compte") }}
                                            </button>
                                        </div>
                                     {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
</section>
@endsection

@section('script')
    <script> 
        $('.select').select2(); 
    </script>
@stop