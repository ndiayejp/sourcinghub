<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label>{{ __("Nom de la demande") }}</label>
    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Titre'])}}
 </div>
 <div class="row">
    <div class="col-sm-6">
       <div class="form-group {{ $errors->has('offer_in_device') ? 'has-error' : ''}}">
            {{Form::label('offer_in_device', __("Offres à faire en"))}} <sup>*</sup>
            {{  Form::select('offer_in_device', ['XOF' => __('XOF'), 'Euro' => 'Euro','Dollar'=>'Dollar'],null,['class' => 'form-control select','placeholder'=>'Choisissez une devise']) }}
            @if ($errors->has('offer_in_device'))
                <span class="help-block" role="alert">
                    <strong>{{ $errors->first('offer_in_device') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('tender_date') ? 'has-error' : ''}}">
            <label>{{ __("Date de fin") }}</label>
            <input type="date" class="form-control" name="tender_date"> 
        </div>
    </div>  
</div>
<input type="hidden" name="type" value="rfqe">
 <div class="form-group {{ $errors->has('offer_in_device') ? 'has-error' : ''}}">
    {{Form::label('offer_in_device', __("Offres à faire en"))}} <sup>*</sup>
    {{  Form::select('offer_in_device', ['XOF' => __('XOF'), 'Euro' => 'Euro','Dollar'=>'Dollar'],null,['class' => 'form-control select','placeholder'=>'Choisissez une devise']) }}
    @if ($errors->has('offer_in_device'))
        <span class="help-block" role="alert">
            <strong>{{ $errors->first('offer_in_device') }}</strong>
        </span>
    @endif
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
            <label>Description</label>
             <input type="hidden" name="type" value="rq">
            <textarea class="form-control textarea-wysiwyg" name="body"></textarea>
         </div>
    </div>
</div>
<hr>
 
<table class="table table-bordered table-form">
    <thead>
        <tr>
            <th>{{ __("Nom du produit") }}</th>
            <th>{{ __("Unité") }}</th>
            <th>{{ __("Quantité") }}</th>
            <th>{{ __("Description") }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="table-name {{ $errors->has('product_name.0') ? 'has-error' : ''}}">
                {{Form::text('product_name[]', '', ['class' => 'form-control productName'])}}
                
             </td>
            <td class="table-unit {{ $errors->has('product_unit.0') ? 'has-error' : ''}}" >
                {{Form::text('product_unit[]', '', ['class' => 'form-control unit'])}}
             </td>
            <td class="table-qte {{ $errors->has('product_unit.0') ? 'has-error' : ''}}">
                {{Form::text('product_qte[]', '', ['class' => 'form-control qte'])}}
             </td>
            <td class="table-body {{ $errors->has('product_body.0') ? 'has-error' : ''}}">
                 {{Form::textarea('product_body[]', '', ['class' => 'form-control productBody','rows' => 1])}}
             </td>
            <td class="table-remove">
                <span class="remove-btn btn btn-danger"><i class="fa fa-trash"></i></span>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td class="table-empty" colspan="2">
                <span   class="table-add_line btn btn-success btn-sm"><i class="fa fa-plus"></i> {{ __("Ajouter une ligne") }}</span>
            </td> 
        </tr> 
    </tfoot>
</table>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="emails">{{ __("Emails des fournisseurs à contacter") }}</label>
            <input type="text" id="emails" name="emails" class="form-control" placeholder="emails des fournisseurs">
            <span class="help-block">{{ __("Appuyez sur la touche espace ou séparez les emails par une virgule") }}</span>
        </div>
    </div>
</div>