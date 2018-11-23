@extends('layouts.app')

@section('title')
{{ __('Mes entreprises') }} | {{config('app.name') }}
@stop

<div class="h-spacer"></div>
@section('content')
    <div class="container"> 
        <div class="row"> 
            @include('layouts/partials/_sidebar') 
            <div class="col-sm-9 page-content">
                <div class="inner-box">
                    <h2 class="title-2">
                        <i class="icon-docs"></i> {{ __('Mon entreprise') }}
                    </h2>
                    
                    <div class=" table-responsive"> 
                            <div class="table-action"></div>
                            <table id="addManageTable" class="table">
                                <thead>
                                    <tr>
                                      
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Photo') }}</th>
                                        <th>{{ __('Entreprise') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('téléphone') }}</th>
                                        <th>{{ __('Options') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($companies as $company)
                                    <tr>    
                                        
                                        <td class="add-id-td">{{ $company->id }}</td>
                                        <td class="add-img-td">
                                            @if(!empty($company->avatarc))
                                              <img style="width:50px;" src="{{URL::to('/')}}/img/avatarsc/{{ $company->avatarc }}" class="img-thumbnail">
                                            @else
                                            <img style="width:50px;" src="{{URL::to('/')}}/img/picture.jpg" class="img-thumbnail">
                                            @endif
                                         </td>
                                        <td class="ads-details-td">{{ $company->name }}</td>
                                        <td class="ads-details-td">{{ $company->email }}</td>
                                        <td class="ads-details-td">{{ $company->phone }}</td>
                                        <td class="action-td">
                                            <ul class="list-inline">
                                                <li><a href="{{ route('companies.edit',$company->id)}}" class="btn btn-default"><i class="fa fa-pencil"></i></a></li> 
                                                 
                                            </ul>
                                        </td>
                                    </tr>
                                   @endforeach 

                                   {{ $companies->links() }}
                                </tbody>
                            </table> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@stop