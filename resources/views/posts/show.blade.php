@extends('layouts.app')


@section('title')
{{ __(' Annonce') }} {{ $post->name }} | {{config('app.name') }}
@stop
<div class="h-spacer"></div>

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12 page-content col-thin-right">
            <div class="inner inner-box ads-details-wrapper">
                <h2 class="enable-long-words">
                    <strong>{{ $post->name }}</strong>
                </h2>
                <div class="row info-row">
                    <div class="col-md-8">
                            <ul class="list-unstyled">
                                <li style="margin-bottom:10px;">
                                    <span class="date"><i class=" icon-clock"> </i> {{ $post->created_at->diffForHumans() }} </span> -&nbsp;
                                    <span class="category"> 
                                            @foreach ($post->categories as $cat )
                                            <span class="label label-default">{{ $cat->name }}</span>
                                        @endforeach    
                                    </span>
                                </li>
                                <li>
                                    <span class="item-location"><i class="fa fa-map-marker"></i> {{ $post->address_delivery.'- '.$post->country->name}}  </span> -&nbsp;
                                    <span class="category">
                                        <i class="icon-eye-3"></i> {{ $post->view_count }}
                                    </span>
                                </li>
                            </ul>
                             
                    </div>
                    <div class="col-md-4 text-right">
                        <ul class="list-unstyled">
                            <li> <span class=" "> {{ __( "Date de lancement") }}:   {{ $post->created_at->format('d F Y').' ' }}  </span>  
                            </li>
                            <li> <span class=" "> {{ __("Date de clôture") }}: {{ date('d F Y', strtotime($post->closing_date))   }}  </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="ads-details">
                    <div class="row" style="padding-bottom: 20px;">
                            <div class="ads-details-info jobs-details-info col-md-9">
                                    <div class="panel-group" id="accordion" role="tablist"> 
                                            <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="headingThree">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse"   href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                {{ __("Description de l'appel d'offre") }}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="panel-body">
                                                                {!! $post->description !!}
                                                        </div> 
                                                  </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingThree">
                                                    <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse"   href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                            {{ __("Description de l'entreprise") }}
                                                    </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                    <div class="panel-body">
                                                            {!! $post->company->description !!}
                                                    </div>
                                                </div>
                                             
                                            </div>
                                            @if(count($post->files)!=0)
                                            <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="headingThree">
                                                        <h4 class="panel-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse"   href="#collapseOne" aria-expanded="false" aria-controls="collapseThree">
                                                                {{ __("Fichiers Attachés") }}
                                                        </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="panel-body">
                                                            @foreach($post->files as $file)
                                                                <p><a href="{{ URL::to( 'uploads/' .  $file->name)  }}" download="{{ $file->name}}">{{ $file->name}}</a> </p>
                                                            @endforeach
                                                        </div>
                                                    </div> 
                                            </div>
                                            @endif
                                        
                                    </div>
                            </div>
                            <div class="col-md-3">
									<aside class="panel panel-body panel-details job-summery">
										<ul>
                                            <li>
                                                @if($post->company->avatarc)
                                                <img   class="img-responsive" src="{{ URL::to('/') }}/img/avatarsc/{{ $post->company->avatarc }}" width="90px">
                                                @else
                                                <img src="{{URL::to('/')}}/img/noimage.jpg" class="img-responsive">
                                                @endif
                                            </li>
										   <li>
                                                <p class="no-margin"> <strong>{{ __('Entreprise') }}:</strong> 
                                                    <a href="{{ route('companies.edit', $post->company->id)}}">{{ $post->company->name }}</a> </p>
											</li>
											<li>
                                                <p class="no-margin"> <strong>{{ __('Adresse') }}:</strong>&nbsp;  {{ $post->company->address }}
												 </p>
											</li> 
                                             
										</ul>
                                    </aside>
                                     
								</div>
                    </div>
                    @if(Auth::user()->profile()->pluck('type')[0]=='acheteur')
                     @if($post->offers_count!=0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" id="sheet0" class="sheet0 gridlines">
                                            <tbody>
                                                    @for ($i = 0 ; $i < sizeof($post->items);$i++ ) 
                                                        <tr class="row0">
                                                            <td class="column0 style1 null"></td>
                                                            <td class="column1 style2 null style2" colspan="3"></td> 
                                                                <?php $proposals= $post->items[$i]->proposals->count();?>
                                                                @for ( $j = 0 ; ($j < $proposals)&&($i==0) ; $j++ ) 
                                                                    <td class="column4 style3 s style4" colspan="3">{{ $post->items[$i]->proposals[$j]->user->profile['company'] }} </td>
                                                                @endfor 
                                                        </tr>
                                                    @endfor  
                                                    <tr class="row1">
                                                        <td class="style7">{{ __("Nom de l'article") }}</td>
                                                        <td class="style7">{{ __("Description") }}</td>
                                                        <td class="style7">{{ __("Quantité") }}</td>
                                                        <td class="style7">{{ __("UoM") }}</td>  
                                                        @for ($i=0; $i <  $proposals ; $i++   )
                                                            <td class="column4 style7 s">{{ __('Prix unitaire') }}</td>
                                                            <td class="column5 style7 s">{{ __('Prix total') }}</td>
                                                            <td class="column6 style7 s">{{ __('Devise') }}</td>
                                                        @endfor 
                                                    </tr>
                                                    <?php 
                                                        $sum = array();
                                                        $sumTotal = array();
                                                        for ($j =0 ; $j < $proposals; $j++){
                                                            $sum[$j] = 0; 
                                                            $sumTotal[$j] = 0;
                                                        } 
                                                    ?>
                                                    @foreach ( $post->items as $k=>$v)
                                                        <tr class="row2">
                                                                <td>{{ $v['item_name'] }}</td>
                                                                <td>{{ $v['item_description'] }} </td>
                                                                <td>{{ $v['item_qte'] }}</td>
                                                                <td>{{ $v['item_unit']  }}</td>
                                                                        <?php $i = 0;?>
                                                                    @foreach ($v->proposals as $kk=>$vv )
                                                                        <?php   $sum[$i] +=   $vv['price']* $v['item_qte'] ; ?>
                                                                    
                                                                        <td id="ItemPrice">{{ $vv['price'] }}</td>
                                                                        <td class="column5 style13 Totalprice"  id="Totalprice-{{ $kk }}"> {{  $vv['price']* $v['item_qte']}}</td>
                                                                        <td>{{ $post->offer_in_device }}</td>
                                                                        <?php $i++;?>
                                                                    @endforeach
                                                        </tr> 
                                                        
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="4" style="text-align:center">Total des Articles</td>
                                                        @for ($i =0 ; $i <sizeof($sum) ; $i++)
                                                            <td colspan="2" id="totalSum" style="text-align:center">   {{ $sum[$i] }}</td>
                                                            <td>{{ $post->offer_in_device }}</td>
                                                            @endfor    
                                                    </tr>
                                                    <tr>
                                                        <td class="column0  null"></td>
                                                        <td colspan="3">Coût du transport</td>
                                                        @for ($i = 0 ; $i < sizeof($post->items);$i++ ) 
                                                             
                                                                    <?php $replies= $post->replies->count();?>
                                                                    
                                                                    @for ( $j = 0 ; ($j < $replies)&&($i==0) ; $j++ ) 
                                                                        <?php  $sumTotal[$j] += $sum[$j] + $post->replies[$j]->amount;?>
                                                                        <td  colspan="2" style="text-align:center">{{ $post->replies[$j]->amount }} </td>
                                                                        <td>{{ $post->offer_in_device }}</td>
                                                                    @endfor
                                                                   
                                                                    
                                                        @endfor  
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="text-align:center">Grand Total  </td>
                                                        @for ($i =0 ; $i <sizeof($sumTotal) ; $i++)
                                                            <td colspan="2" id="totalSum" style="text-align:center">   {{ $sumTotal[$i] }}</td>
                                                            <td>{{ $post->offer_in_device }}</td>
                                                            @endfor    
                                                    </tr>
                                                    <tr class="row10">
                                                        <td class="column0 style34 null"></td>
                                                        <td colspan="3">{{ __("Différence") }}</td>
                                                        @for ($i = 0 ; $i < sizeof($post->items);$i++ )
                                                            <?php $replies= $post->replies->count();?>
                                                            @for ( $j = 0 ; ($j < $replies)&&($i==0) ; $j++ ) 
                                                            <td  colspan="3"> </td>
                                                            @endfor
                                                        @endfor
                                                        
                                                    </tr>
                                                    <tr class="row9">
                                                        <td></td>
                                                        <td colspan="3">{{ __('Budget') }}</td>
                                                        <td colspan="9" style='text-align:center' class="column4"> {{ $post->budget }}</td>
                                                    </tr>
                                                    <tr class="row10">
                                                        <td class="column0 style34 null"></td>
                                                        <td colspan="3">Termes de Paiement</td>
                                                        @for ($i = 0 ; $i < sizeof($post->items);$i++ )
                                                            <?php $replies= $post->replies->count();?>
                                                            @for ( $j = 0 ; ($j < $replies)&&($i==0) ; $j++ ) 
                                                            <td  colspan="3">{{ $post->replies[$j]->payment }}</td>
                                                            @endfor
                                                        @endfor
                                                        
                                                    </tr>
                                                    <tr class="row10">
                                                        <td class="column0 style34 null"></td>
                                                        <td colspan="3">{{ __("Date de livraison") }}</td>
                                                        @for ($i = 0 ; $i < sizeof($post->items);$i++ )
                                                            <?php $replies= $post->replies->count();?>
                                                            @for ( $j = 0 ; ($j < $replies)&&($i==0) ; $j++ ) 
                                                            <td  colspan="3">{{ $post->replies[$j]->delivery }}</td>
                                                            @endfor
                                                        @endfor
                                                        
                                                    </tr>
                                                    <tr class="row10">
                                                        <td class="column0 style34 null"></td>
                                                        <td colspan="3">{{ __("Incoterm") }}</td>
                                                        @for ($i = 0 ; $i < sizeof($post->items);$i++ )
                                                            <?php $replies= $post->replies->count();?>
                                                            @for ( $j = 0 ; ($j < $replies)&&($i==0) ; $j++ ) 
                                                            <td  colspan="3">{{ $post->replies[$j]->incoterm->code }}</td>
                                                            @endfor
                                                        @endfor
                                                        
                                                    </tr>
                                                    <tr class="row10">
                                                        <td class="column0 style34 null"></td>
                                                        <td colspan="3">{{ __("Commentaires") }}</td>
                                                        @for ($i = 0 ; $i < sizeof($post->items);$i++ )
                                                            <?php $replies= $post->replies->count();?>
                                                            @for ( $j = 0 ; ($j < $replies)&&($i==0) ; $j++ ) 
                                                            <td  colspan="3">{{ $post->replies[$j]->body }}</td>
                                                            @endfor
                                                        @endfor
                                                        
                                                    </tr>
                                                    <tr class="row10">
                                                        <td class="column0 style34 null"></td>
                                                        <td colspan="3">{{ __("Fichier attaché") }}</td>
                                                        @for ($i = 0 ; $i < sizeof($post->items);$i++ )
                                                            <?php $replies= $post->replies->count();?>
                                                            @for ( $j = 0 ; ($j < $replies)&&($i==0) ; $j++ ) 
                                                            <td  colspan="3">
                                                                @if(!empty($post->replies[$j]->file))
                                                                    {{ __("1 fichier") }} 
                                                                @else
                                                                    {{ __('Aucun fichier attaché') }}
                                                                @endif
                                                            </td>
                                                            @endfor
                                                        @endfor
                                                        
                                                    </tr>
                                                    <tr class="row10">
                                                        <td class="column0 style34 null"></td>
                                                        <td colspan="3">{{ __("Attribution") }}</td>
                                                        <form action="{{ route('assign.store',$post->id) }}" method="POST" id="formAssign" >
                                                        @csrf
                                                        <input type="hidden" value="{{ $post->id }}" name="postID">
                                                        <input type="hidden" value="{{ Auth::user()->id }}" name="buyer">
                                                        
                                                        @for ($i = 0 ; $i < sizeof($post->items);$i++ )
                                                            <?php $replies= $post->replies->count();?>
                                                            @for ( $j = 0 ; ($j < $replies)&&($i==0) ; $j++ ) 
                                                            <td  colspan="3">
                                                                    <input type="radio" name="provider" value="{{ $post->items[$i]->proposals[$j]->user->id }}" 
                                                                    <?php 
                                                                    
                                                                        echo  $getAssigns > 0 && $post->items[$i]->proposals[$j]->user->id == $post->assigns[$i]->provider_id? "checked" : ""  ?>>
                                                                 
                                                            </td>
                                                            @endfor
                                                        @endfor 
                                                    </tr>
                                                  
                                                    <tr class="row10">
                                                           
                                                        <td colspan="14" class="text-center">
                                                            <input type="button" value="Attribuer" class="btn btn-primary btn-lg" name="assign" id="assignPost" <?php echo $getAssigns > 0 ? "disabled=disabled" : ""?>>
                                                            </form>
                                                        </td>
                                                    </tr>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                    @elseif(Auth::user()->profile()->pluck('type')[0]=='fournisseur') 
                        @if($post->state_id==1)
                            <form method="post" action="{{ route('posts.reply',$post->slug)}}" enctype="multipart/form-data" id="formReply">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <th>{{ __('Nom') }}</th>
                                                <th>{{ __('Description') }}</th>
                                                <th>{{ __('Quantité') }}</th>
                                                <th>{{ __('Unité') }}</th>
                                                <th>{{ __('Prix unitaire') }}</th>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach ($post->items as $k=>$item )
                                                    
                                                    <tr>
                                                        <input type="hidden" name="post_id[]" value="{{ $post->id }}" class="form-control">
                                                        <input type="hidden" name="user_id[]" value="{{ Auth::user()->id }}" class="form-control">
                                                        <input type="hidden" name="item_id[]" value="{{ $item['id'] }}" class="form-control">
                                                        <td><input type="text" name="item_name[]" value="{{ $item['item_name'] }}" class="form-control" readonly></td>
                                                        <td><textarea name="item_description[]" id="" cols="30" rows="1" class="form-control" readonly>{{ $item['item_description'] }}</textarea></td>
                                                        <td><input type="number" name="item_qte[]" value="{{ $item['item_qte'] }}" class="form-control" readonly></td>
                                                        <td>
                                                            <input type="text" name="item_unit[]" value="{{ $item['item_unit'] }}" class="form-control" readonly>
                                                        </td>
                                                        <td>
                                                            <div class="form-group {{ $errors->has("price.$k") ? 'has-error' : ''}}">
                                                                {!! Form::number('price[]',isset($postByOwner->proposals[$k]['price']) ? $postByOwner->proposals[$k]['price'] : '',array('class'=>'form-control')) !!}
                                                            
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
                            <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('incoterm_id') ? 'has-error' : ''}}">
                                        <input type="hidden" name="id" value="{{ $post->id }}" class="form-control">
                                        {!! Form::label('incoterm_id', 'Incoterm'); !!} <sup>*</sup>
                                        {!! Form::select('incoterm_id', $incoterms,isset($postByOwner->replies[0]['incoterm_id']) ? $postByOwner->replies[0]['incoterm_id'] : '', ['class' => 
                                        'form-control select','placeholder'=>__('choisissez un incoterm')]); !!}
                                        @if ($errors->has('incoterm_id'))
                                            <span class="help-block" role="alert">
                                                <strong>{{ $errors->first('incoterm_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('payment') ? 'has-error' : ''}}">
                                        {{Form::label('payment', __("Modalité de paiement"))}} <sup>*</sup>
                                        {{  Form::select('payment', ['Immédiat' => 'Immédiat', 
                                        '30 jours' => '30 jours','90 jours'=>__('90 jours'),
                                        'Négocier'=>'Négocier'],isset($postByOwner->replies[0]['payment']) ? $postByOwner->replies[0]['payment'] : '',['class' => 'form-control select','placeholder'=>'choisissez une modalité']) }}
                                        @if ($errors->has('payment'))
                                            <span class="help-block" role="alert">
                                                <strong>{{ $errors->first('payment') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('delivery') ? 'has-error' : ''}}">
                                        {{ Form::label('delivery',__("Date de Livraison ")) }}  <sup>*</sup>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            {{ Form::text('delivery',isset($postByOwner->replies[0]['delivery']) ? $postByOwner->replies[0]['delivery'] : '',['class'=>'form-control Inputdatetime']) }}
                                            @if ($errors->has('delivery'))
                                                <span class="help-block" role="alert">
                                                    <strong>{{ $errors->first('delivery') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
                                        {{ Form::label('amount',__("Côut du transport")) }} 
                                        {{ Form::number('amount',isset($postByOwner->replies[0]['amount']) ? $postByOwner->replies[0]['amount'] : '',['class'=>'form-control']) }}
                                        @if ($errors->has('amount'))
                                            <span class="help-block" role="alert">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('file',__("Fichier attaché")) }} 
                                        <input type="file" name="file" class="form-control">
                                        
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
                                        {{ Form::textarea('body',isset($postByOwner->replies[0]['body']) ? $postByOwner->replies[0]['body'] : '',['class'=>'form-control textarea-wysiwyg',
                                        'placeholder'=>__("Commentaires")]) }}
                                        @if ($errors->has('body'))
                                            <span class="help-block" role="alert">
                                                <strong>{{ $errors->first('body') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> 
                                @if($getAllUserReplies==0)
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="hidden" name="sendPost" value="sendPost">
                                            <input type="button" class="btn btn-success btn-lg btn-block" name="sendPost" id="sendPost" value="Envoyer mon offre">
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group">
                                            <div class="col-md-12">
                                                {{Form::button("Votre offre à bien été prise en compte ", ['class'=>'btn btn-danger btn-lg btn-block','name'=>'save','disabled'=>'disabled'])}}
                                            </div>
                                    </div>
                                @endif
                                        
                                
                            </div>
                            {!! Form::close() !!}
                            @else
                               <div class="text-center">
                                        <span class="btn btn-danger">
                                            {{ __("Vous ne pouvez plus faire de proposition pour cette offre") }}
                                        </span>
                               </div>
                                <div class="h-spacer"></div>
                        @endif
                    @endif
                    
                    @if(Auth::user()->role_id==2 && Auth::user()->id==$post->user_id)
                    <div class="content-footer text-left">
                        <a class="btn btn-default" href=" {{ route('posts.edit',$post->id) }}">
                        <i class="fa fa-pencil-square-o"></i> {{ __('Editer') }}
                        </a> 
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
    </div>
</div>

@stop

@section('script')
    <script>
        $('.select').select2();

        $(".Inputdatetime").datetimepicker({
            autoclose: true,
            todayBtn: true,
            language:'fr'
        });

        $('.textarea-wysiwyg').trumbowyg({
            btns: ['strong', 'em', '|', 'link','|','unorderedList', 
            'orderedList','|','justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull','|','viewHTML',
            '|','undo', 'redo'],
            autogrow: true,
            lang: 'fr'
        });

        $('#assignPost').click(function(e){
           
            $('#formAssign').submit();
        });

        $('#sendPost').click(function(e){
            $('#formReply').submit();
        });

        $('#assignPost').click(function(e){
            $('formAssign').submit();
        })

         
    </script>
@stop