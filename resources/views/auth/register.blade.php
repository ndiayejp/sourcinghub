@extends('layouts.app')

@section('content')
<div class="h-spacer"></div>
<section class="register">
        <div class="container">
                <div class="row justify-content-center">
                    
                    <div class="col-md-8">
                        <div class="inner-box category-content">
                            <h2 class="title-2"> <i class="icon-user-add"></i> {{ __("Créez votre compte, c'est 100% gratuit") }}</h2> 
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center mb30">
                                        {{--  <div class="row row-centered">
                                            <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 col-centered small-gutter">
                                                <div class="col-md-6 col-xs-12 mb5">
                                                    <div class="col-xs-12 btn btn-lg btn-fb">
                                                        <a href="#" class="btn-fb"><i class="icon-facebook"></i> Connecter avec <strong>Facebook</strong></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-xs-12 mb5">
                                                    <div class="col-xs-12 btn btn-lg btn-danger">
                                                        <a href="#" class="btn-danger"><i class="icon-googleplus-rect"></i> Connecter avec <strong>Google</strong></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   --}}
                                        {{--  <div class="row row-centered loginOr">
                                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 col-centered mb5">
                                                <hr class="hrOr">
                                                <span class="spanOr rounded">ou</span>
                                            </div>
                                        </div>  --}}
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            {!! Form::open(['class'=>'form-horizontal','id'=>'signupForm','url'=> route('register')  ])!!} 
                                        
                                            <fieldset>     
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
                                                <div class="form-group {{ $errors->has('user_type') ? 'has-error' : ''}}">
                                                        <label for="name" class="col-md-4 control-label">{{ __("Vous êtes") }}
                                                                <sup>*</sup>
                                                        </label>
                                                        <div class="col-md-6">
                                                                {!!  Form::radio('type','acheteur', ['class' => 'form-control']) !!} {{ __('Acheteur') }}
                                                                {!!  Form::radio('type','fournisseur', ['class' => 'form-control']) !!}  {{ __('Fournisseur') }}
                                                                @if ($errors->has('user_type'))
                                                                    <span class="help-block" role="alert">
                                                                        <strong>{{ $errors->first('user_type') }}</strong>
                                                                    </span>
                                                                @endif
                                                        </div>
                                                            
                                                </div>

                                                <div class="form-group {{ $errors->has('company') ? 'has-error' : ''}}">
                                                        <label for="company" class="col-md-4 control-label">{{ __("Organisme") }}
                                                                <sup>*</sup>
                                                        </label>
                                                        <div class="col-md-6">
                                                                {!!  Form::text('company',null, ['class' => 'form-control']) !!}  
                                                                @if ($errors->has('company'))
                                                                    <span class="help-block" role="alert">
                                                                        <strong>{{ $errors->first('company') }}</strong>
                                                                    </span>
                                                                @endif
                                                        </div>
                                                            
                                                </div>
                                                <div class="form-group {{ $errors->has('activity_id') ? 'has-error' : ''}}">
                                                        <label for="activity_id" class="col-md-4 control-label">{{ __("Fonction") }}
                                                                <sup>*</sup>
                                                        </label>
                                                        <div class="col-md-6">
                                                            {!! Form::select('activity_id', $activities,null, ['class' => 'form-control select','placeholder'=> __("Fonction") ]) !!}
                                                            @if ($errors->has('activity_id'))
                                                                <span class="help-block" role="alert">
                                                                    <strong>{{ $errors->first('activity_id') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                
                                                </div>
                                                <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
                                                        <label for="category_id" class="col-md-4 control-label">{{ __("Secteur d'activité") }}
                                                                <sup>*</sup>
                                                        </label>
                                                        <div class="col-md-6">
                                                            {!! Form::select('category_id', $categories,null, ['class' => 'form-control select','placeholder'=> __("Secteur d'activité") ]) !!}
                                                            @if ($errors->has('category_id'))
                                                                <span class="help-block" role="alert">
                                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                
                                                </div>
                                                <div class="form-group {{ $errors->has('firmsize') ? 'has-error' : ''}}">
                                                        <label for="firmsize" class="col-md-4 control-label">{{ __("Taille de l'entreprise") }}
                                                                <sup>*</sup>
                                                        </label>
                                                        <div class="col-md-6">
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
                                                <div class="form-group {{ $errors->has('country_id') ? 'has-error' : ''}}">
                                                        <label for="country_id" class="col-md-4 control-label">{{ __('Pays') }}
                                                                <sup>*</sup>
                                                        </label> 
                                                         <div class="col-md-6">
                                                            {!! Form::select('country_id', $countries,null, ['class' => 
                                                            'form-control select','placeholder'=>'Choisissez un pays']); !!}
                                                            @if ($errors->has('country_id'))
                                                                <span class="help-block" role="alert">
                                                                    <strong>{{ $errors->first('country_id') }}</strong>
                                                                </span>
                                                            @endif
                                                         </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('siret') ? 'has-error' : ''}}">
                                                        <label for="siret" class="col-md-4 control-label">{{ __("Ninéa") }} <sup>*</sup>
                                                         </label>
                                                        <div class="col-md-6">
                                                                {!!  Form::text('siret',null, ['class' => 'form-control']) !!}  
                                                                @if ($errors->has('siret'))
                                                                    <span class="help-block" role="alert">
                                                                        <strong>{{ $errors->first('siret') }}</strong>
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
                                                <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                                                        <label for="address" class="col-md-4 control-label">{{ __("Adresse de facturation") }}
                                                                <sup>*</sup>
                                                        </label>
                                                        <div class="col-md-6">
                                                                {!!  Form::text('address',null, ['class' => 'form-control']) !!}  
                                                                @if ($errors->has('address'))
                                                                    <span class="help-block" role="alert">
                                                                        <strong>{{ $errors->first('address') }}</strong>
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
                                                <div class="form-group required " style="margin-top: -10px;">
                                                    <label class="col-md-4 control-label"></label>
                                                    <div class="col-md-6">
                                                        <div class="termbox mb10">
                                                            <label class="checkbox-inline" for="term">
                                                                <input name="term" id="term" value="1" type="checkbox">
                                                                <a href="{{ route('cgu_path') }}"> {!! __("J'ai lu et j'accepte les  Termes &amp; Conditions d'utilisation") !!}</a>
                                                            </label>
                                                        </div>
                                                        <div style="clear:both"></div>
                                                    </div>
                                                </div>
                        
                                                <div class="form-group">
                                                        <label for="" class="col-md-4 control-label"></label>
                                                        <div class="col-md-6">
                                                            <button type="submit" class="btn btn-primary btn-block btn-lg">
                                                                {{ __('Senregistrer') }}
                                                            </button>
                                                        </div>
                                                </div>
                                            {!! Form::close() !!}
                                    </div>
                                </div>
                                
                            </fieldset>  
                        </div>
                    </div>
                    <div class="col-md-4 reg-sidebar">
                        <div class="reg-sidebar-inner text-center">
                                <div class="promo-text-box">
                                    <i class=" icon-picture fa fa-4x icon-color-1"></i>
                                    <h3><strong>{{ __("Publiez un appel d'offre") }}</strong></h3>
                                    <p>
                                        {{ __("Trouvez le bon fournisseur en quelques cliques.") }}
                                    </p>
                                </div>
                                <div class="promo-text-box">
                                    <i class="icon-pencil-circled fa fa-4x icon-color-2"></i>
                                    <h3><strong> {{ __("Gérer et manager vos offres") }}</strong></h3>
                                    <p>{{ __("Devenez un fournisseur ou un acheteur fiable.") }}</p>
                                </div>
                                <div class="promo-text-box">
                                    <i class="icon-heart-2 fa fa-4x icon-color-3"></i>
                                    <h3><strong> {{ __("Créez votre liste de favoris.") }}</strong></h3>
                                    <p>{{ __("Créez votre liste de favoris. Enregistrez vos recherches. Ne ratez aucune bonne affaire!") }}</p>
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