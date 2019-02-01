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
                        <h2> {{ __('Editer bannière')  }} {{ $banner->id }}</h2>
                    </div>
                    <div class="body">
                         {!! Form::model($banner,['method' => 'put','url' => route('admin.banner.update',$banner),'files'=>true]) !!}
                              <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('name') ? 'error' : ''}}">
                                    <label>{{ __('Nom du fournisseur') }}</label>
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $banner->name }}">
                                </div>
                                @if ($errors->has('name'))
                                    <label class="error" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group">
                               <div class="row">
                                   <div class="col-md-3">
                                       <img src="/banners/{{  $banner->image }}" class="img-responsive"/>
                                   </div>
                                   <div class="col-md-9">
                                       <div class="form-line {{ $errors->has('image') ? 'error' : ''}}">
                                            <label for="image">{{ __("Image(300x600 minimum)") }}</label>
                                                {!! Form::file('image', array('class' => 'image')) !!}
                                        </div>
                                        @if ($errors->has('image'))
                                                <label class="error" role="alert">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </label>
                                            @endif
                                   </div>
                               </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line {{ $errors->has('end_at') ? 'error' : ''}}">
                                    <label for="end_at">{{ __("Date de fin") }}</label>
                                   {{Form::date('end_at', $banner->end_at, ['class' => 'form-control', 'placeholder' => 'Titre'])}}
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
                                   {{Form::text('link', $banner->link, ['class' => 'form-control', 'placeholder' => 'URL'])}}
                                </div>
                                @if ($errors->has('link'))
                                    <label class="error" role="alert">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </label>
                                @endif
                            </div> 
                           <div class="form-group">
                                <input type="checkbox" id="active"  name="active" value="1" {{ $banner->active == true ? 'checked' : '' }}>
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