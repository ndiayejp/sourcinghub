@extends('layouts.app') 
@section('title')
    Mettre à jour votre compte | {{ Auth::user()->name }}
@stop

@section('content')
    <div class="h-spacer"></div>
    <div class="container"> 
        <div class="row">
            @include('layouts/partials/_sidebar')   
            <div class="col-sm-9 page-content">
                <div class="inner-box">
                    <div class="row">
                        <div class="col-md-5 col-xs-4 col-xxs-12">
                            <h3 class="no-padding text-center-480 useradmin">
                                <a href="#"> 
                                    @if($user->avatar)
                                        <img src="{{ url('img/avatars/'.$user->id.'.jpg') }}" alt="" class="userImg">
                                    @else
                                        <img src="{{ url('img') }}/noimage.jpg" alt="" class="userImg">
                                    @endif
                                    <div style="display:inline-block">
                                        {{ $user->name }}
                                        @if(Auth::user()->profile()->pluck('type')[0]=='acheteur')  
                                            <span style="display:block"><small>{{ __('Acheteur') }}</small></span>
                                        @elseif(Auth::user()->profile()->pluck('type')[0]=='fournisseur')
                                            <span style="display:block"><small>{{ __('Fournisseur') }}</small></span>
                                        @endif
                                    </div>
                                </a>
                            </h3>
                        </div>
                        <div class="col-md-7 col-xs-8 col-xxs-12">
                            @if(Auth::user()->profile()->pluck('type')[0]=='fournisseur')
                                <div class="header-data text-center-xs">
                                    <div class="hdata">
                                        <div class="mcol-left">
                                            <i class="fa fa-user ln-shadow"></i>
                                        </div>
                                        <div class="mcol-right"> 
                                            <p>
                                                <a href="#">
                                                    {{ Auth::user()->favorite_posts->where('pivot.user_id',Auth::user()->id)->count() }}
                                                    <em>{{ __('Favoris') }} </em>
                                                </a>
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="h-spacer"></div>
                <div class="inner-box">
                    <div class="welcome-msg">
                        <h3 class="page-sub-header2 clearfix no-padding">
                            {{ __('Bonjour') }} {{ isset(Auth::user()->lastname) ? Auth::user()->firstname.' '.Auth::user()->lastname : Auth::user()->name}}
                        </h3>
                        <span class="page-sub-header-sub small">
                            {{ __('Membre actif:') }} {{ Auth::user()->created_at->diffForHumans() }} 
                        </span>
                    </div> 
                    <div id="accordion">
                            <div class="panel panel-default">
                              <div class="panel-heading" id="headingOne"> 
                                  <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    {{ __('DETAILS') }}
                                  </a> 
                              </div> 
                              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="panel-body">
                                    <form method="POST" action="{{ route('setting.update') }}" class="form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <fieldset>
                                            <div class="form-group">
                                                <label for="name" class="col-md-4 control-label">{{ __("IMAGE DE PROFIL") }}</label>
                                                <div class="col-md-6">
                                                    {!! Form::file('avatar',['class'=>'form-control']); !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-md-4 control-label">{{ __("NOM D'UTILISATEUR") }}</label>
                                                <div class="col-md-6">
                                                   <input type="text" id="name" class="form-control" placeholder="nom utilisateur" name="name" value="{{ Auth::user()->name }}" readonly="true">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-md-4 control-label">{{ __("EMAIL") }}</label>
                                                <div class="col-md-6">
                                                    <input type="text" id="email" class="form-control" placeholder="Enter your email address" name="email" value="{{ Auth::user()->email }}" readonly="true">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-md-4 control-label">{{ __("NOM") }}</label>
                                                <div class="col-md-6">
                                                    <input type="text" id="lastname" class="form-control" placeholder="Nom" name="lastname" value="{{ Auth::user()->lastname }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-md-4 control-label">{{ __("PRENOM") }}</label>
                                                <div class="col-md-6">
                                                   <input type="text" id="firstname" class="form-control" placeholder="Prénom" name="firstname" value="{{ Auth::user()->firstname }}">
                                                 </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label"></label>
                                                <div class="col-md-6">
                                                    {{ Form::submit(__('Mettre à jour le profil'),['class'=>'btn btn-primary btn-block btn-lg']) }}
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                              </div>
                            </div>
                            <div class="panel panel-default">
                              <div class="panel-heading" id="headingTwo">
                                   <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        {{ __('MODIFIER LE MOT DE PASSE') }}
                                   </a>
                               </div>
                              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="panel-body">
                                    <form method="POST" action="{{ route('password.update') }}" class="form-horizontal">
                                            @csrf
                                            @method('PUT') 
                                            <div class="form-group {{ $errors->has('old_password') ? 'has-error' : ''}}">
                                                <label for="old_password" class="col-md-4 control-label">{{ __('ANCIEN MOT DE PASSE') }} : </label>
                                                <div class="col-md-6">
                                                    <input type="password" id="old_password" class="form-control" placeholder="{{ __('Ancien mot de passe') }}" name="old_password">
                                                    @if ($errors->has('old_password'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('old_password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div> 
                                        
                                            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                                                <label for="password" class="col-md-4 control-label">{{ __('NOUVEAU MOT DE PASSE') }} : </label>
                                                <div class="col-md-6">
                                                    <input type="password" id="password" class="form-control" placeholder="{{ __('Entrer votre nouveau mot de passe') }}" name="password">
                                                    @if ($errors->has('password'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>           
                                                    
                                            <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : ''}}">
                                                <label for="confirm_password" class="col-md-4 control-label">{{ __('CONFIRMER LE MOT DE PASSE') }}: </label>
                                                <div class="col-md-6">
                                                    <input type="password" id="confirm_password" class="form-control" placeholder="{{ __('Entrer de nouveau votre mot de passe') }}" name="password_confirmation">
                                                    @if ($errors->has('confirm_password'))
                                                        <span class="help-block" role="alert">
                                                            <strong>{{ $errors->first('confirm_password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label"></label>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary btn-block btn-lg">{{ __('Modifier le mot de passe') }}</button>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                           
                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingThree"> 
                                  <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    {{ __('PARAMETRES DU COMPTE') }}
                                  </a> 
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="panel-body">
                                    <form method="POST" action="{{ route('profile.update') }}" class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group"> 
                                            <div class="col-md-4  {{ $errors->has('company') ? 'has-error' : ''}}">
                                                <label for="company">{{ __("ENTREPRISE") }} : </label>
                                                <input type="text" id="company" class="form-control"  name="company" value="{{ Auth::user()->profile()->pluck('company')[0] }}">
                                                @if ($errors->has('company'))
                                                    <span class="help-block" role="alert">
                                                        <strong>{{ $errors->first('company') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-4  {{ $errors->has('siret') ? 'has-error' : ''}}">
                                                <label for="siret">{{ __("SIRET") }} : </label>
                                                <input type="text" id="siret" class="form-control"   name="siret" value="{{ Auth::user()->profile()->pluck('siret')[0] }}">
                                            </div>
                                            <div class="col-md-4  {{ $errors->has('phone') ? 'has-error' : ''}}">
                                                <label for="phone">{{ __("TELEPHONE") }} : </label>
                                                <input type="text" id="phone" class="form-control"   name="phone" value="{{ Auth::user()->profile()->pluck('phone')[0] }}">
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <div class=" col-md-4  {{ $errors->has('address') ? 'has-error' : ''}}">
                                                <label for="address">{{ __("ADRESSE") }}  </label>
                                                <input type="text" id="address" class="form-control"  name="address" value="{{ Auth::user()->profile()->pluck('address')[0] }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="website">{{ __("SITE WEB") }}  </label>
                                                <input type="text" id="website" class="form-control"  name="website" value="{{ Auth::user()->profile()->pluck('website')[0] }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="fax">{{ __("FAX") }} : </label>
                                                <input type="text" id="fax" class="form-control"   name="fax" value="{{ Auth::user()->profile()->pluck('fax')[0] }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class=" col-md-6  {{ $errors->has('image') ? 'has-error' : ''}}">
                                                <label for="image">  {{ __("LOGO") }} : </label>
                                                <input type="file" name="image">
                                                @if ($errors->has('image'))
                                                    <span class="help-block" role="alert">
                                                        <strong>{{ $errors->first('image') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            @if(Auth::user()->profile()->pluck('type')[0]=='fournisseur')
                                            <div class="col-md-6">
                                                <label for="banner">  {{ __("Bannière") }} : </label>
                                                <input type="file" name="banner">
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
                                                <div  class="col-md-6">  
                                                    <label for="">{{ __("SECTEUR D'ACTIVITE") }}</label>
                                                    <select name="category_id" id="" class="form-control">
                                                        <option value="">{{ __("Choississez") }}</option>
                                                        @foreach($categories as $category)
                                                            <option <?php echo Auth::user()->profile()->pluck('category_id')[0] == $category->id ? 'selected' : ''?>
                                                            value="{{ $category->id }}">{{ $category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="fonction">{{ __("FONCTION") }}</label>
                                                    <select name="activity_id" id="" class="form-control">
                                                            <option value="">{{ __("Choississez") }}</option>
                                                            @foreach($activities as $activity)
                                                                <option <?php echo Auth::user()->profile()->pluck('activity_id')[0] == $activity->id ? 'selected' : ''?>
                                                                value="{{ $activity->id }}">{{ $activity->name}}</option>
                                                            @endforeach
                                                    </select>
                                                </div> 
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label for="firmsize">{{ __("TAILLE DE L'ENTREPRISE") }}</label>
                                                <select name="firmsize" id="firmsize" class="form-control">
                                                        <option value="1"<?php echo Auth::user()->profile()->pluck('firmsize')[0] ==1 ? 'selected' : '';?>>0-9</option>
                                                        <option value="2"<?php echo Auth::user()->profile()->pluck('firmsize')[0] ==2 ? 'selected' : '';?>>10-49</option>
                                                        <option value="3"<?php echo Auth::user()->profile()->pluck('firmsize')[0] ==3 ? 'selected' : '';?>>50-499</option>
                                                        <option value="4"<?php echo Auth::user()->profile()->pluck('firmsize')[0] ==4 ? 'selected' : '';?>>500-999</option>
                                                        <option value="5"<?php echo Auth::user()->profile()->pluck('firmsize')[0] ==5 ? 'selected' : '';?>>plus de 1000</option>
                                                    </select>
                                                    @if ($errors->has('firmsize'))
                                                    <span class="help-block" role="alert">
                                                        <strong>{{ $errors->first('firmsize') }}</strong>
                                                    </span>
                                                @endif  
                                            </div>
                                            <div class="col-md-6">
                                                <label for="country_id">{{ __("PAYS") }}</label>
                                                <select name="country_id" id="country_id" class="form-control">
                                                        <option value="">{{ __("Choississez") }}</option>
                                                        @foreach($countries as $country)
                                                            <option <?php echo Auth::user()->profile()->pluck('country_id')[0] == $country->id ? 'selected' : ''?>
                                                            value="{{ $country->id }}">{{ $country->name}}</option>
                                                        @endforeach
                                                </select> 
                                                @if ($errors->has('country_id'))
                                                    <span class="help-block" role="alert">
                                                        <strong>{{ $errors->first('country_id') }}</strong>
                                                    </span>
                                                @endif 
                                            </div>
                                        </div>
                                        <div class="form-group  {{ $errors->has('about') ? 'has-error' : ''}}">
                                            <div class="col-md-12">
                                                <label for="email_address_2">{{ __("A PROPOS") }} : </label>
                                                <textarea rows="5" name="about" class="form-control textarea-wysiwyg">
                                                    {{ Auth::user()->profile()->pluck('about')[0]  }}
                                                </textarea>
                                                @if ($errors->has('about'))
                                                    <span class="help-block" role="alert">
                                                        <strong>{{ $errors->first('about') }}</strong>
                                                    </span>
                                                @endif 
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-block btn-lg">{{ __("Mettre à jour") }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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