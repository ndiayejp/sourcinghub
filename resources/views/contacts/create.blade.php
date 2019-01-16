@extends('layouts.app')
@section('title','Nous contacter')
@section('content')
    <div class="h-spacer"></div>
    <section class="contact-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading"> <h3>{{ __("Un pigeon électronique ?") }}</h3> </div>
                        <div class="panel-body"> 
                            <p class="text-muted"> {{ __("Nous vous répondrons dans les plus brefs délais") }}  </p>
                            <form action="{{route('contact_path') }}" method="POST">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                            <label for="name" class="control-label"> {{ __("Nom") }}</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ old('name') }}"  >
                                            {!!$errors->first('name','<span class="help-block">:message</span>')!!}
                                        </div>
                                    </div> 
                                </div>  
                                <div class="mb-3">
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                        <label for="email">{{ __("Email") }}</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="yourname@exemple.com" value="{{ old('email') }}">
                                        {!!$errors->first('email','<span class="help-block">:message</span>')!!}
                                    </div>
                                </div>
                        
                                <div class="mb-3">
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                        <label for="message">{{ __("Message") }}</label>
                                        <textarea  class="form-control textarea-wysiwyg" rows="10" cols="10" id="message"   name="message">
                                            {{ old('message') }}
                                        </textarea>
                                        {!!$errors->first('message','<span class="help-block">:message</span>')!!}
                                    </div>
                                </div> 
                                <hr class="mb-4">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Envoyer le message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('script')
    <script>
        $('.textarea-wysiwyg').trumbowyg({
            btns: ['strong', 'em', '|', 'link','|','unorderedList', 
            'orderedList','|','justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull','|','viewHTML',
            '|','undo', 'redo'],
            autogrow: true,
            lang: 'fr'
        });
    </script>
@stop