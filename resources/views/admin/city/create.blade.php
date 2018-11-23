@extends('layouts.backend.app')

@section('title','Régions')

@push('css')
<link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">

@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           {{ __('Nouvelle région') }}
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.city.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group form-float ">
                                <div class="form-line {{ $errors->has('name') ? 'error' : ''}}">
                                    <input type="text" id="name" class="form-control" name="name">
                                    <label class="form-label">{{ __('Nom de la région') }}</label>
                                    @if ($errors->has('name'))
                                        <label class="error" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </label>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('country_id') ? 'error' : ''}}">
                                        {!! Form::select('country_id', $countries,null, ['class' => 
                                        'form-control selectpicker','placeholder'=>'Choississez un pays']); !!}
                                        @if ($errors->has('country_id'))
                                            <label class="error" role="alert">
                                                <strong>{{ $errors->first('country_id') }}</strong>
                                            </label>
                                        @endif
                                </div>
                                   
                            </div>

                            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.city.index') }}">{{ __('Retour') }}</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">{{ __('Envoyer') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<script type="text/javascript">
    $('select').selectpicker();
</script>
@endpush