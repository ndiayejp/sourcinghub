@extends('layouts.backend.app') 
@section('title','Utilisateur') 
@push('css') 
@endpush 
@section('content')
    <div class="container-fluid">
         <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header"><h2>{{ __('Editer un Utilisateur') }}</h2></div> 
                    <div class="body">
                        <form action="{{ route('admin.user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <strong>{{ __('Nom utilisateur') }}</strong> <p>{{ $user->name }}</p>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <strong>{{ __('Email') }}</strong>
                                        <p>{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <strong>{{ __("Type d'utilisateur") }}</strong>
                                        <p>{{ $user->profile()->pluck('type')[0] }}</p>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <strong>{{ __("Nom de la société") }}</strong>
                                        <p>{{ $user->profile()->pluck('company')[0] }}</p>
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <strong>{{ __("Adresse") }}</strong>
                                        <p>{{ $user->profile()->pluck('address')[0] }}</p>
                                    </div>  
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <strong>{{ __("Téléphone") }}</strong>
                                        <p>{{ $user->profile()->pluck('phone')[0] }}</p>
                                    </div> 
                                </div>
                            </div>
                            @if($user->profile()->pluck('type')[0]=="fournisseur")
                                <div class="form-group form-float">
                                    <strong>{{ __("Siret") }}</strong>
                                    <p>{{ $user->profile()->pluck('siret')[0] }}</p>
                                </div>   
                            @endif 
                            <div class="form-group">
                                <input type="checkbox" id="active" class="filled-in" name="active" value="1" {{ $user->active == true ? 'checked' : '' }}>
                                <label for="active">Mettre en ligne</label>
                            </div>
                            @if( $user->profile()->pluck('type')[0] =="fournisseur" )
                                <div class="form-group">
                                    <input type="checkbox" id="featured" class="filled-in" name="featured" value="1" {{ $user->featured == true ? 'checked' : '' }}>
                                    <label for="featured">Mettre en avant</label>
                                </div>
                            @endif 
                            <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.user.index') }}">{{ __('Retour') }}</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">{{ __('Mettre à jour') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush