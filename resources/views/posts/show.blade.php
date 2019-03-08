@extends('layouts.app')
@section('title')
    {{ __(' Annonce') }} {{ $post->name }} | {{config('app.name') }}
@stop
<div class="h-spacer"></div>
@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-header"> <h3 class="title-2"><i class="icon-docs"></i> <strong>{{ $post->name }}</strong></h3> </div>
        <div class="panel-body"> 
            <div class="row info-row">
                <div class="col-md-3">
                    <div>
                        <h5>{{ __("Appel d'offre ") }}</h5>
                        <p>@foreach ($post->opens as $open)
                            {{ $open->name.' ' }}
                        @endforeach</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <h5><i class="fa fa-calendar"></i> {{ __("Date de parution") }}</h5>
                    <p>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</p>
                </div>
                <div class="col-md-3">
                    <div>
                        <h5><i class="fa fa-calendar"></i> {{ __("Date de clôture") }}</h5>
                        <p>{{ \Carbon\Carbon::parse($post->closing_date)->format('d/m/Y')}}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div>
                        <h5><i class="fa fa-map-marker"></i> {{ __("Localisation") }}</h5>
                        <p> {{ $post->address_delivery.'- '.$post->country->name}}</p>
                    </div>
                </div>
            </div>
            <div class="row info-row">
                <div class="col-md-3">
                    <div>
                        <h5>{{ __("Secteur d'activité") }}</h5>
                        <p>{{ $post->category->name }}</p>
                    </div>
                </div>
               
                <div class="col-md-3">
                     <div>
                        <h5>{{ __("Domaine d'activité") }}</h5>
                        <p>{{ $post->area->name }}</p>
                    </div>
                </div>
                 <div class="col-md-3">
                     <div>
                        <h5><i class="icon-eye-3"></i> {{ __("Nombre de vues") }}</h5>
                        <p>{{ $post->view_count }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                     <div>
                        <h5></h5>
                        <p></p>
                    </div>
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
                                        <div class="panel-body">{!! $post->description !!}</div> 
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
                                            <ul class="list-group" style="margin-left:0 !important;">
                                             
                                                <li class="list-group-item" style="margin-left:0 !important;"><strong>{{ __("Secteur d'activité: ") }}</strong>{{ $post->user->profile->category->name }}</li>
                                                <li class="list-group-item" style="margin-left:0 !important;"><strong>{{ __("Taille: ") }}</strong>
                                                    @switch($post->user->profile()->pluck('firmsize')[0])
                                                        @case(1)
                                                            {{ __('0-9') }}
                                                            @break

                                                        @case(2)
                                                            {{ __('10-49') }}
                                                            @break
                                                        
                                                        @case(3)
                                                            {{ __('50-499') }}
                                                            @break

                                                        @case(4)
                                                            {{ __('500-999') }}
                                                            @break
                                                        
                                                        @case(5)
                                                        {{ __('plus de 1000') }}
                                                        @break

                                                        @default
                                                           {{ __('aucune information') }}
                                                    @endswitch
                                                </li>
                                                <li class="list-group-item" style="margin-left:0 !important;"><strong>{{ __("Pays: ") }} </strong>{{ $post->country->name }}</li>
                                                <li class="list-group-item" style="margin-left:0 !important;"><strong>{{ __("Ninéa: ") }}</strong> {{ $post->user->profile()->pluck('siret')[0] }}</li>
                                                <li class="list-group-item" style="margin-left:0 !important;"><strong>{{ __("Adresse de facturation: ") }}</strong> {{ $post->address_delivery }}</li>
                                            </ul>
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
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingFour">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse"   href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                {{ __("Contact de l'acheteur") }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                        <div class="panel-body">
                                            <ul class="list-unstyled">
                                                <li><b>{{ __("Fonction: ") }} </b>{{ Auth::user()->profile->activity->name }}</li>
                                                <li><b>{{ __("Téléphone: ") }} </b>{{ Auth::user()->profile()->pluck('phone')[0] }}</li>
                                                <li><b>{{ __("Adresse: ") }} </b>{{ Auth::user()->profile()->pluck('address')[0] }}</li>
                                                <li><b>{{ __("Email: ") }} </b>{{ $post->user->email }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <aside class="panel panel-body panel-details job-summery">
                            <ul>
                                <li>
                                    @if($post->company->avatarc)
                                      <img class="img-responsive" src="{{ URL::to('/') }}/img/avatarsc/{{ $post->company->avatarc }}" width="90px">
                                    @else
                                      <img src="{{URL::to('/')}}/img/noimage.jpg" class="img-responsive">
                                    @endif
                                </li>
                                <li>
                                    <p class="no-margin"><b>{{ __("Référence de l'offre: ") }}</b> {{ 'AO-'.$post->id.'-'.Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->year }}</p>
                                </li>
                                <li>
                                    <p class="no-margin"><strong>{{ __('Entreprise') }}:</strong> 
                                        <a href="{{ route('companies.edit', $post->company->id)}}">{{ $post->company->name }}</a> 
                                    </p>
                                </li>
                                <li>
                                    <p class="no-margin"> <strong>{{ __('Adresse') }}:</strong>&nbsp;  {{ Auth::user()->profile()->pluck('address')[0] }}
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
                                <table class="table table-bordered table-striped table-hover" id="board" class="sheet0 gridlines">
                                        <thead>
                                            <?php $tab = array(); $cpt = 0; ?>
                                                <tr>
                                                    <td colspan="4"></td> 
                                                    @for ($i = 0 ; $i < sizeof($post->items);$i++ ) 
                                                    <?php $proposals= $post->items[$i]->proposals->count();?>
                                                    @for ( $j = 0 ; ($j < $proposals)&&($i==0) ; $j++ ) 
                                                        <td colspan="3" style="background-color: #073b8a;color:#fff;border-right:2px solid #fff;">
                                                            <h4 style="text-transform:uppercase">{{ $post->items[$i]->proposals[$j]->user->profile['company'] }} </h4>
                                                            <span>{{ $post->items[$i]->proposals[$j]->user->firstname.' '.$post->items[$i]->proposals[$j]->user->lastname }}</span><br>
                                                            <span>{{ $post->items[$i]->proposals[$j]->user->email }}</span><br>
                                                            <span>{{ $post->items[$i]->proposals[$j]->user->profile['phone'] }}</span>
                                                        </td>
                                                    @endfor 
                                                </tr>
                                            @endfor 
                                            <tr>
                                                <td class="style7">{{ __("Items") }}</td>
                                                <td class="style7">{{ __("Description") }}</td>
                                                <td class="style7">{{ __("Quantity") }}</td>
                                                <td class="style7">{{ __("Unit") }}</td>  
                                                @for ($i=0; $i <  $proposals ; $i++   )
                                                    <td class="style7" style="border-left:2px solid #c3c2c2;width:auto">{{ __('Unit price') }}</td>
                                                    <td colspan="2" class="style7" style="border-right:2px solid #c3c2c2;width:auto">{{ __('Total') }} <small>{{ $post->offer_in_device }}</small></td>
                                                @endfor 
                                            </tr>
                                        </thead> 
                                        <tbody style="font-size:14px;"> 
                                            <?php 
                                                $sum = array();
                                                $tab = array();
                                                $sumTotal = array();
                                                for ($j =0 ; $j < $proposals; $j++){
                                                    $sum[$j] = 0;
                                                    $sumTotal[$j] = 0;
                                                }?>
                                            @foreach ( $post->items as $k=>$v)
                                                <tr id="row-{{ $k }}" class="rowItem">
                                                    <td style="font-weight:600;">{{ $v['item_name'] }}</td>
                                                    <td style="font-weight:600;">{{ $v['item_description'] }} </td>
                                                    <td class="text-center">{{ $v['item_qte'] }}</td>
                                                    <td class="text-center">{{ $v['item_unit']  }}</td>
                                                        <?php $i = 0; $g=1 ?>
                                                        @foreach ($v->proposals as $kk=>$vv )  
                                                            <?php   
                                                            $tab[$vv['id']] =  $vv['price']* $v['item_qte'];
                                                            $sum[$i] +=   $vv['price']* $v['item_qte'] ; ?>
                                                            <td class="text-right" style="border-left:2px solid #c3c2c2;">{{ number_format($vv['price'],0,',',' ') }}</td> 
                                                            <?php $tab[$i]= $vv['price']* $v['item_qte']  ; ?>
                                                            <td colspan="2"class="text-right Totalprice" style="border-right:2px solid #c3c2c2;" id="Totalprice-{{ $k }}-{{ $kk }}">  
                                                                {{  number_format($vv['price']*$v['item_qte'],0,',',' ') }} 
                                                            </td>
                                                            <?php $i++; $g++; ?> 
                                                        @endforeach
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4" class="style7 text-right">{{ __("Total des Articles") }}</td>
                                                @for ($i =0 ; $i <sizeof($sum) ; $i++)
                                                    <td colspan="3"  class="style7 text-right" style="border-right:2px solid #c3c2c2;border-left:2px solid #c3c2c2;">   {{ number_format($sum[$i],0, ',', ' ') }}</td>
                                                @endfor    
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="text-align:left; background:#000;color:#fff;font-weight:600;font-size:16px;">{{ __("Coût du transport") }}</td>
                                                @for ($i = 0 ; $i < sizeof($post->items);$i++ ) 
                                                    <?php $replies= $post->replies->count();?>
                                                    @for ( $j = 0 ; ($j < $replies)&&($i==0) ; $j++ ) 
                                                        <?php  $sumTotal[$j] += $sum[$j] + $post->replies[$j]->amount;?>
                                                        <td colspan="3" class="text-right" style="border-right:2px solid #c3c2c2;border-left:2px solid #c3c2c2;">{{ number_format($post->replies[$j]->amount,0,',',' ') }} </td>
                                                    @endfor
                                                @endfor  
                                            </tr>
                                            <tr class="grandTotal">
                                                <td colspan="4" style="text-align:left;background:#000;color:red;font-weight:600;font-size:16px;">{{ __("Grand Total ")  }} ({{ $post->offer_in_device }})</td>
                                                <?php 
                                                if(count($sumTotal)>0){
                                                     $minTotal =   min($sumTotal);
                                                }
                                               
                                                ?>
                                                @for ($i =0 ; $i <sizeof($sumTotal) ; $i++)
                                                    <td colspan="3" id="totalSum-{{$i}}" class="text-right totalSum" style="border-right:2px solid #c3c2c2;border-left:2px solid #c3c2c2;">
                                                        {{ number_format($sumTotal[$i],0,',',' ') }}
                                                    </td>
                                                @endfor    
                                            </tr>
                                            <tr class="row10">
                                                <td colspan="4" style="text-align:left;background:#000;color:#fff;font-weight:600;font-size:16px;">{{ __("Différence") }}</td>
                                                @for ($i =0 ; $i <sizeof($sumTotal) ; $i++)
                                                        <td colspan="3" class="text-right" style="border-right:2px solid #c3c2c2;border-left:2px solid #c3c2c2;"> 
                                                            <span><?php $amountDiff =  ($sumTotal[$i] - $minTotal );
                                                             echo number_format($amountDiff,0,',',' ');?>
                                                            </span>
                                                        </td>
                                                 @endfor
                                            </tr>
                                            @if(!empty($post->budget))
                                            <tr class="row9">
                                                <td colspan="3">{{ __('Budget') }}</td>
                                                <td colspan="9" style='text-align:center border-right:2px solid #c3c2c2;border-left:2px solid #c3c2c2;' class="column4"> {{ $post->budget }}</td>
                                            </tr>
                                            @endif
                                            <tr class="row10">
                                                <td colspan="4" style="background-color: #fdaf3a;border-bottom:1px solid #333;font-weight:600;font-size:16px;">{{ __("Termes de Paiement")}}</td>
                                                @for ($i = 0 ; $i < sizeof($post->items);$i++ )
                                                    <?php $replies= $post->replies->count();?>
                                                    @for ( $j = 0 ; ($j < $replies)&&($i==0) ; $j++ ) 
                                                    <td  colspan="3" class="text-center" style="border-right:2px solid #c3c2c2;border-left:2px solid #c3c2c2;">{{ $post->replies[$j]->payment }}</td>
                                                    @endfor
                                                @endfor
                                            </tr>
                                            <tr class="row10">
                                                <td colspan="4" style="background-color: #fdaf3a;border-bottom:1px solid #333;font-weight:600;font-size:16px;">{{ __("Date de livraison") }}</td>
                                                @for ($i = 0 ; $i < sizeof($post->items);$i++ )
                                                    <?php $replies= $post->replies->count();?>
                                                    @for ( $j = 0 ; ($j < $replies)&&($i==0) ; $j++ ) 
                                                    <td colspan="3" class="text-center" style="border-right:2px solid #c3c2c2;border-left:2px solid #c3c2c2;">{{ $post->replies[$j]->delivery }}</td>
                                                    @endfor
                                                @endfor
                                            </tr>
                                            <tr class="row10">
                                                <td colspan="4" style="background-color: #fdaf3a;border-bottom:1px solid #333;font-weight:600;font-size:16px;">{{ __("Incoterm") }}</td>
                                                @for ($i = 0 ; $i < sizeof($post->items);$i++ )
                                                    <?php $replies= $post->replies->count();?>
                                                    @for ( $j = 0 ; ($j < $replies)&&($i==0) ; $j++ ) 
                                                    <td colspan="3" class="text-center" style="border-right:2px solid #c3c2c2;border-left:2px solid #c3c2c2;">{{ $post->replies[$j]->incoterm->code }}</td>
                                                    @endfor
                                                @endfor
                                            </tr>
                                            <tr class="row10">
                                                <td colspan="4" style="background-color: #fdaf3a;border-bottom:1px solid #333;font-weight:600;font-size:16px;">{{ __("Commentaires") }}</td>
                                                @for ($i = 0 ; $i < sizeof($post->items);$i++ )
                                                    <?php $replies= $post->replies->count();?>
                                                    @for ( $j = 0 ; ($j < $replies)&&($i==0) ; $j++ ) 
                                                    <td colspan="3" class="text-center" style="border-right:2px solid #c3c2c2;border-left:2px solid #c3c2c2;">{!! $post->replies[$j]->body !!}</td>
                                                    @endfor
                                                @endfor
                                            </tr>
                                            <tr class="row10">
                                                <td colspan="4" style="background-color: #fdaf3a;border-bottom:1px solid #333;font-weight:600;font-size:16px;">{{ __("Fichier attaché") }}</td>
                                                @for ($i = 0 ; $i < sizeof($post->items);$i++ )
                                                    <?php $replies= $post->replies->count();?>
                                                    @for ( $j = 0 ; ($j < $replies)&&($i==0) ; $j++ ) 
                                                    <td  colspan="3" class="text-center" style="border-right:2px solid #c3c2c2;border-left:2px solid #c3c2c2;">
                                                        @if(!empty($post->replies[$j]->file))
                                                            {{ __("1 fichier") }} 
                                                            <a href="{{ URL::to( 'uploads/' . $post->replies[$j]->file)  }}" download="{{ $post->replies[$j]->file}}">
                                                                {{ $post->replies[$j]->file }} 
                                                            </a>
                                                        @else
                                                            {{ __('Aucun fichier attaché') }}
                                                        @endif
                                                    </td>
                                                    @endfor
                                                @endfor
                                            </tr>
                                            <tr style="background-color: #f9dbae;">
                                                <td colspan="4" style="background-color: #fff;font-weight:600;font-size:16px;" >{{ __("Attribution") }}</td>
                                                <form action="{{ route('assign.store',$post->id) }}" method="POST" id="formAssign" >
                                                @csrf
                                                <input type="hidden" value="{{ $post->id }}" name="postID">
                                                <input type="hidden" value="{{ Auth::user()->id }}" name="buyer">
                                                @for ($i = 0 ; $i < sizeof($post->items);$i++ )
                                                    <?php $replies= $post->replies->count();?>
                                                    @for ( $j = 0 ; ($j < $replies)&&($i==0) ; $j++ ) 
                                                    <td  colspan="3" class="style13 text-center" style="">
                                                        <input type="radio" name="provider" value="{{ $post->items[$i]->proposals[$j]->user->id }}" 
                                                        <?php echo  $getAssigns > 0 && $post->items[$i]->proposals[$j]->user->id == $post->assigns[$i]->provider_id? "checked" : ""  ?>>
                                                    </td>
                                                    @endfor
                                                @endfor 
                                            </tr>
                                            <tr class="row10">
                                                <td colspan="100%" class="text-center">
                                                    <button type="submit"  class="btn btn-primary btn-lg" name="assign" id="assignPost" <?php echo $getAssigns > 0 ? "disabled=disabled" : ""?>>
                                                        {{ __('Attribuer l\'offre')  }}
                                                    </button>
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
                                            <th>{{ __('Prix unitaire') }} {{ $post->offer_in_device }}</th>
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
                                    'Négocier'=>'Négocier','Avance'=>'Avance'],isset($postByOwner->replies[0]['payment']) ? $postByOwner->replies[0]['payment'] : '',['class' => 'form-control select','placeholder'=>'choisissez une modalité']) }}
                                    @if ($errors->has('payment'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('payment') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('delivery') ? 'has-error' : ''}}">
                                    {{ Form::label('delivery',__("Délai de Livraison ")) }}  <sup>*</sup>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        {{ Form::text('delivery',isset($postByOwner->replies[0]['delivery']) ? $postByOwner->replies[0]['delivery'] : '',['class'=>'form-control']) }}
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
                                <div class="form-group {{ $errors->has('file') ? 'has-error' : ''}}">
                                    {{ Form::label('file',__("Fichier attaché")) }} 
                                    <input type="file" name="file" class="form-control">
                                    @if ($errors->has('file'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                    @endif
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
@stop
@section('script')
    <script>

    var jq=jQuery.noConflict(); 

         jq('.select').select2();

        jq(".Inputdatetime").datetimepicker({
            autoclose: true,
            todayBtn: true,
            language:'fr'
        });

        jq('.textarea-wysiwyg').trumbowyg({
            btns: ['strong', 'em', '|', 'link','|','unorderedList', 
            'orderedList','|','justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull','|','viewHTML',
            '|','undo', 'redo'],
            autogrow: true,
            lang: 'fr'
        });

        jq('#assignPost').click(function(e){
            jq('#formAssign').submit();
        });

        jq('#sendPost').click(function(e){
            jq('#formReply').submit();
        });

        jq('#assignPost').click(function(e){
            jq('formAssign').submit();
        })
        // mettre les couleurs sur les prix les plus élevés et les plus faibles
        var elements = document.getElementsByClassName('rowItem');
        prices = [] 
        tabSum = []
        for(var i=0;i<elements.length;i++){
            var tds = elements[i].getElementsByClassName('Totalprice');
            jq(tds).each(function (i,val) {  
                prices.push({
                    'price': val.innerText.replace(/ /g,""), 
                    'tag':val.id
                })  
                prices.sort(function(a, b) { return a.price - b.price; }); 
            })
            jq('#'+prices[0]['tag']).addClass("style13"); 
            jq('#'+prices[prices.length-1]['tag']).addClass("style15"); 
            prices = [] 
        } 
        // couleur sur grand Total
        var elementsTotal = document.getElementsByClassName('grandTotal');
        for(var i=0;i<elementsTotal.length;i++){
             var sum = elementsTotal[i].getElementsByClassName('totalSum');
             jq(sum).each(function (i,val) {  
                tabSum.push({
                    'prix': val.innerText.replace(/ /g,""), 
                    'tag':val.id
                })  
                tabSum.sort(function(a, b) { return a.prix - b.prix; }); 
            })
            console.log(tabSum)
            jq('#'+tabSum[0]['tag']).addClass("style13"); 
            //jq('#'+tabSum[tabSum.length-1]['tag']).addClass("style15"); 
            tabSum = [] 
        }

     </script>   
@stop