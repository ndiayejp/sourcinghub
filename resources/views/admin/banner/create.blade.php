@extends('layouts.backend.app')

@section('title','Bannière')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
         <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2> {{ __('Nouvelle bannière') }} </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('name') ? 'error' : ''}}">
                                    <label>{{ __('Nom du fournisseur') }}</label>
                                    <input type="text" id="name" class="form-control" name="name">
                                </div>
                                @if ($errors->has('name'))
                                    <label class="error" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group">
                               <div class="form-line {{ $errors->has('image') ? 'error' : ''}}">
                                   <label for="image">{{ __("Image") }}</label>
                                    {!! Form::file('image', array('class' => 'image')) !!}
                               </div>
                               @if ($errors->has('image'))
                                    <label class="error" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="form-line {{ $errors->has('end_at') ? 'error' : ''}}">
                                    <label for="end_at">{{ __("Date de fin") }}</label>
                                   {{Form::date('end_at', '', ['class' => 'form-control', 'placeholder' => 'Titre'])}}
                                </div>
                                @if ($errors->has('end_at'))
                                    <label class="error" role="alert">
                                        <strong>{{ $errors->first('end_at') }}</strong>
                                    </label>
                                @endif
                            </div> 
                            <div class="form-group">
                                <div class="form-line {{ $errors->has('link') ? 'error' : ''}}">
                                    <label for="end_at">{{ __("URL") }}</label>
                                   {{Form::text('link', '', ['class' => 'form-control', 'placeholder' => 'URL'])}}
                                </div>
                                @if ($errors->has('link'))
                                    <label class="error" role="alert">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </label>
                                @endif
                            </div> 
                           <div class="form-group">
                                <input type="checkbox" id="active"  name="active" value="1">
                                <label for="active">Publier</label>
                            </div>
                            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.banner.index') }}">{{ __('Retour') }}</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">{{ __('Envoyer') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush