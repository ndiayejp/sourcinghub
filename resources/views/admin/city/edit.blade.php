@extends('layouts.backend.app')

@section('title','Régions')

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
                          {{ __('Editer une région') }}
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.city.update',$city->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $city->name }}">
                                    <label class="form-label">{{ __('Nom de la région') }}</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('country_id') ? 'error' : ''}}">
                                    {!! Form::select('country_id', $countries,null, ['class' =>'form-control']); !!}
                                    @if ($errors->has('country_id'))
                                        <label class="error">
                                             {{ $errors->first('country_id') }} 
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
<script type="text/javascript">
    $('.selectpicker').selectpicker();
</script>
@endpush