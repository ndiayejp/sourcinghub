@extends('layouts.app')
<div class="h-spacer"></div>
@section('content')
<div class="container"> 
    <div class="row"> 
         <div class="col-sm-12 page-content col-thin-right">
            <div class="inner inner-box ads-details-wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="enable-long-words">
                            <strong>{{ $tender->name }}</strong>
                            <span style="display:block;margin-top:10px;">
                                <small><strong>{{ __("Proposition à faire en ") }}</strong> {{  $tender->offer_in_device }}</small>
                            </span>
                        </h2>
                    </div>
                    <div class="col-md-6 text-right">
                       {{ __("Date de fin: ") }} <span class="label label-danger"> {{ $tender->tender_date }}</span>
                    </div>
                </div>
                <div class=" info-row"> {!! $tender->body !!}</div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                {{ __("Contact de l'acheteur") }}
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                        <div class="panel-body">
                            <ul class="list-unstyled">
                                <li><b>{{ __("Identification") }}</b> {{ $tender->user->firstname.' '.$tender->user->lastname }}</li>
                                <li><b>{{ __("Téléphone") }}</b> {{ $tender->user->profile()->pluck('phone')[0] }}</li>
                                <li><b>{{ __("Adresse") }}</b> {{ $tender->user->profile()->pluck('address')[0] }}</li>
                                <li><b>{{ __("Email") }}</b> {{ $tender->user->email }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <form method="post" action="{{ route('tenders.reply',$tender->id)}}" enctype="multipart/form-data" id="formReply">
                   @csrf
                    <div class="form-group {{ $errors->has('delivery') ? 'has-error' : ''}}">
                       <label for="delivery">{{ __("Délai de livraison") }}</label>
                       <input type="text" name="delivery" class="form-control" placeholder="{{ __('exemple: 2 semaines') }}" value="{{ isset($tender->deals[0]['delivery']) ? $tender->deals[0]['delivery'] : '' }}">
                        @if ($errors->has('delivery'))
                            <span class="help-block">
                                <strong>{{ $errors->first('delivery') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
                        <label for="body">{{ __("Commentaires") }}</label> 
                            {{ Form::textarea('body',isset($tender->deals[0]['body']) ? $tender->deals[0]['body'] : '',['class'=>'form-control textarea-wysiwyg',
                                    'placeholder'=>__("Commentaires")]) }}
                        @if ($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{Form::label('Fichier', __('Joindre un fichier'))}} 
                        <input type="file" name="file" id="file"  class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>{{ __('Nom') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Quantité') }}</th>
                                        <th>{{ __('Unité') }}</th>
                                        <th>{{ __('Prix unitaire') }}</th>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" name="tender_id" value="{{ $tender->id }}" class="form-control">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" class="form-control">
                                        @foreach ($tender->products as $k=>$item )
                                            <tr> 
                                                <input type="hidden" name="item_id[]" value="{{ $item['id'] }}" class="form-control">
                                                <td><input type="text" name="item_name[]" value="{{ $item['name'] }}" class="form-control" readonly></td>
                                                <td><textarea name="item_body[]" id="" cols="30" rows="1" class="form-control" readonly>{{ $item['body'] }}</textarea></td>
                                                <td><input type="number" name="item_qte[]" value="{{ $item['qte'] }}" class="form-control" readonly></td>
                                                <td>
                                                    <input type="text" name="item_unit[]" value="{{ $item['unit'] }}" class="form-control" readonly>
                                                </td>
                                                <td>
                                                    <div class="form-group {{ $errors->has("price.$k") ? 'has-error' : ''}}">
                                                        {!! Form::number('price[]',isset($postByOwner->deals[$k]['price']) ? $postByOwner->deals[$k]['price'] : '',array('class'=>'form-control')) !!}
                                                        @if ($errors->has("price.$k"))
                                                            <span class="help-block" role="alert">
                                                                <strong><small>{{ $errors->first("price.$k") }}</small></strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody> 
                                </table> 
                            </div>
                        </div>
                   </div>
                   @if($getCountReply==0)
                   <div class="form-group"> 
                        <input type="hidden" name="sendQuotation" value="sendQuotation">
                        <input type="submit" class="btn btn-success btn-lg btn-block" value="Répondre à la demande de devis">
                    </div>
                    @else
                    <div class="form-group">
                        {{Form::button("Votre offre à bien été prise en compte ", ['class'=>'btn btn-danger btn-lg btn-block','name'=>'save','disabled'=>'disabled'])}}
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
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