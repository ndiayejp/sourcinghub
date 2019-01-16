@extends('layouts.app')
<div class="h-spacer"></div>
@section('content')
<div class="container"> 
    <div class="row"> 
         <div class="col-sm-12 page-content col-thin-right">
            <div class="inner inner-box ads-details-wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="enable-long-words"><strong>{{ $tender->name }}</strong></h2>
                    </div>
                    <div class="col-md-6 text-right">
                         {{ __("Date de fin") }} <span class="label label-danger"> {{ $tender->tender_date }}</span>
                    </div>
                </div>
                <p> {!! $tender->body !!}</p>
                 <?php 
                    $sum = array();
                      for ($j =0 ; $j < $tender->replies; $j++){
                        $sum[$j] = 0;
                     }?>
                @if($tender->replies!=0)  
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="sheet0" class="sheet0 gridlines">
                            <tbody> 
                                <?php $tab = array(); $cpt = 0; ?> 
                                    <tr>   
                                        <td colspan="4" style="background:#fff"></td> 
                                        @for ($i = 0 ; $i < sizeof($tender->products);$i++ ) 
                                        <?php $deals= $tender->products[$i]->deals->count();?>
                                        @for ( $j = 0 ; ($j < $deals)&&($i==0) ; $j++ ) 
                                            <td class="style4" colspan="2">
                                                <h4 style="text-transform:uppercase">{{ $tender->products[$i]->deals[$j]->user->profile['company'] }} </h4>
                                                 <small>{{ $tender->products[$i]->deals[$j]->user->email}}</small>  <br>
                                                <small>{{ $tender->products[$i]->deals[$j]->user->profile['phone']}}</small>
                                            </td>
                                        @endfor 
                                    </tr>
                                @endfor 
                                <tr>
                                    <td class="style7">{{ __("Nom du poduit") }}</td>
                                    <td class="style7">{{ __("Description") }}</td>
                                    <td class="style7">{{ __("Quantité") }}</td>
                                    <td class="style7">{{ __("Unité") }}</td>  
                                    @for ($i=0; $i <  $deals ; $i++   )
                                        <td class="style7">{{ __('Prix unitaire') }}</td>
                                        <td class="style7">{{ __('Prix total') }}</td>
                                    @endfor 
                                </tr>
                                @foreach ( $tender->products as $k=>$v)
                                    <tr class="rowItem">
                                        <td>{{ $v['name'] }}</td>
                                        <td>{{ $v['body'] }} </td>
                                        <td>{{ $v['qte'] }}</td>
                                        <td>{{ $v['unit']  }}</td> 
                                        <?php $i = 0;$temp = 0;?>
                                        @foreach ($v->deals as $kk=>$vv ) 
                                            <td id="ItemPrice">{{ $vv['price'] }}</td> 
                                            <td class="Totalprice"  id="Totalprice-{{ $k }}-{{ $kk }}">{{  $vv['price']* $v['qte']}}</td> 
                                            <?php  
                                            $sum[$i] +=   $vv['price']* $v['qte'] ;  
                                            $i++; $cpt++; ?>
                                            
                                        @endforeach
                                    </tr> 
                                @endforeach
                                <tr class="grandTotal">
                                    <td colspan="4" style="text-align:left;background-color:#D1D1D1;">{{ __("Total des Articles") }}</td>
                                    @for ($i =0 ; $i <sizeof($sum) ; $i++)
                                        <td colspan="2"  id="totalSum-{{$i}}"  class="totalSum" style="text-align:center">   {{number_format( $sum[$i],0, '', ' ') }}</td>
                                    @endfor    
                                </tr>
                                <tr class="row10">
                                    <td colspan="4" style="background-color: #fdaf3a;border-bottom:1px solid #333">{{ __("Délai de livraison") }}</td>
                                   @for ($i = 0 ; $i < sizeof($tender->products);$i++ ) 
                                        <?php $deals= $tender->products[$i]->deals->count();?>
                                        @for ( $j = 0 ; ($j < $deals)&&($i==0) ; $j++ ) 
                                            <td colspan="2">
                                                <h4 style="text-transform:uppercase">{{ $tender->products[$i]->deals[$j]->delivery }} </h4>
                                              </td>
                                        @endfor 
                                    @endfor 
                                </tr>
                                <tr class="row10">
                                    <td colspan="4" style="background-color: #fdaf3a;border-bottom:1px solid #333">{{ __("Commentaires") }}</td>
                                   @for ($i = 0 ; $i < sizeof($tender->products);$i++ ) 
                                        <?php $deals= $tender->products[$i]->deals->count();?>
                                        @for ( $j = 0 ; ($j < $deals)&&($i==0) ; $j++ ) 
                                            <td colspan="2">
                                                <h4 style="text-transform:normal">{{ $tender->products[$i]->deals[$j]->body }} </h4>
                                              </td>
                                        @endfor 
                                    @endfor 
                                </tr>
                                <tr class="row10">
                                    <td colspan="4" style="background-color: #fdaf3a;border-bottom:1px solid #333">{{ __("Fichier attaché") }}</td>
                                    @for ($i = 0 ; $i < sizeof($tender->products);$i++ ) 
                                        <?php $deals= $tender->products[$i]->deals->count();?>
                                        @for ( $j = 0 ; ($j < $deals)&&($i==0) ; $j++ ) 
                                            <td colspan="2">
                                                <a href="{{ URL::to( 'uploads/' . $tender->products[$i]->deals[$j]->file)  }}" download="{{ $tender->products[$i]->deals[$j]->file}}">
                                                    {{ $tender->products[$i]->deals[$j]->file }} 
                                                </a>
                                            </td>
                                        @endfor 
                                    @endfor 
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                 @endif 
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>

    var jq=jQuery.noConflict();   
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
            jq('#'+tabSum[tabSum.length-1]['tag']).addClass("style15"); 
            tabSum = [] 
        }

     </script>   
@stop