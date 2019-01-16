@extends('layouts.app')
<div class="h-spacer"></div>
@section('content')
<div class="container"> 
        <div class="row"> 
            @include('layouts/partials/_sidebar') 
            <div class="col-sm-9 page-content">
                <div class="inner-box">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                @if($tenders->count())
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __("Nom de la demande") }}</th>
                                            <th>{{ __("Date de fin") }}</th>
                                            <th colspan="2"> {{ __("Date de création") }}</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach($tenders as $tender)
                                            <tr>
                                                <td>{{$tender->name }}</td>
                                                <td>{{$tender->tender_date}}</td>
                                                <td>{{$tender->created_at}}</td>
                                                <td class="text-center">
                                                    <div class="btn-group"> 
                                                        <div class="btn-group">
                                                            <a href="{{ route('quotation.details',$tender->tender_id) }}" class="btn btn-default"> <i class="fa fa-eye"></i></a>
                                                        </div> 
                                                    </div> 
                                                </td>
                                            </tr> 
                                        @endforeach 
                                        {{ $tenders->links() }}
                                    </tbody>
                                </table> 
                                @else
                                    <div class="invoice-empty">
                                        <p class="invoice-empty-title">
                                            {{ __("Aucune demande de devis reçue") }}
                                         </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                </div>
            </div>
        </div>
</div>
@endsection