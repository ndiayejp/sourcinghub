@extends('layouts.backend.app')

@section('title','incoterm')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                          {{ __('Editer un incoterm') }}
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.incoterm.update',$incoterm->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('name') ? 'error' : ''}}">
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $incoterm->name }}">
                                    <label class="form-label">{{ __('Nom de la catégorie') }}</label>
                                </div>
                                @if ($errors->has('name'))
                                    <label class="error" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group form-float">
                                    <div class="form-line {{ $errors->has('code') ? 'error' : ''}}">
                                        <input type="text" id="code" class="form-control" name="code" value="{{ $incoterm->code }}">
                                        <label class="form-label">{{ __('Code') }}</label>
                                    </div>
                                    @if ($errors->has('code'))
                                        <label class="error" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </label>
                                    @endif

                            </div>
                         

                            

                            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.incoterm.index') }}">{{ __('Retour') }}</a>
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