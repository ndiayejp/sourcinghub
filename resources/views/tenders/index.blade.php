@extends('layouts.app')
<div class="h-spacer"></div>
@section('content')
<div class="container"> 
        <div class="row"> 
            @include('layouts/partials/_sidebar') 
            <div class="col-sm-9 page-content">
                <div class="inner-box"> 
                    <a href="{{route('tenders.create')}}" class="btn btn-success pull-right"> <i class="fa fa-plus"></i> {{ __("Nouvelle demande de devis") }}</a>
                    @if($tenders->count())
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __("Nom de la demande") }}</th>
                                    <th>{{ __('Offres') }}</th>
                                    <th>{{ __("Date de fin") }}</th>
                                    <th colspan="2"> {{ __("Date de création") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tenders as $tender)
                                    <tr>
                                        <td>{{$tender->name}}</td>
                                        <th><span class="label label-success">{{ $tender->replies }}</span></th>
                                        <td>{{$tender->tender_date}}</td>
                                        <td>{{$tender->created_at}}</td>
                                        <td class="text-center">
                                                <div class="btn-group" role="">
                                                <div class="btn-group">
                                                    <a href="{{route('tenders.edit', $tender)}}" class="btn btn-default"> <i class="fa fa-pencil"></i></a>
                                                </div>
                                                <div class="btn-group">
                                                    <a href="{{ route('tenders.show',$tender->id) }}" class="btn btn-default"> <i class="fa fa-eye"></i></a>
                                                </div>
                                                    <div class="btn-group">
                                                    <form class="form-inline" method="post" action="{{route('tenders.destroy', $tender)}}"
                                                    onsubmit="return confirm('Êtes vous sûr?')">
                                                    <input type="hidden" name="_method" value="delete">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <button type="submit"   class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
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
                                {{ __("Aucune demande de devis") }}
                                <a href="{{route('tenders.create')}}" class="btn btn-primary btn-sm">{{ __("Créer en une") }}!</a>
                            </p>
                        </div>
                    @endif 
                </div>
            </div>
        </div>
</div>
    
@endsection