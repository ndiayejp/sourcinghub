@extends('layouts.backend.app')

@section('title','unité de facturation')

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
                          {{ __('Editer une unité') }}
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.unit.update',$unit->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('name') ? 'error' : ''}}">
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $unit->name }}">
                                    <label class="form-label">{{ __('Nom ') }}</label>
                                </div>
                                @if ($errors->has('name'))
                                    <label class="error" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group form-float">
                                    <div class="form-line {{ $errors->has('code') ? 'error' : ''}}">
                                        <input type="text" id="code" class="form-control" name="code" value="{{ $unit->code }}">
                                        <label class="form-label">{{ __('Code ') }}</label>
                                    </div>
                                    @if ($errors->has('code'))
                                        <label class="error" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </label>
                                    @endif
                                </div>
                         

                            

                            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.unit.index') }}">{{ __('Retour') }}</a>
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