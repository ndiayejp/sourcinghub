@extends('layouts.app')

@section('title')
      {{ $profile->company }}
@stop

@section('content')
    <div class="h-spacer"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 page-content">
                <div class="inner-box">
                    <div class="row">
                        <div class="col-md-3">
                                <aside class="panel panel-body panel-details job-summery">
                                    <ul>
                                        <li>
                                            @if($profile->image)
                                            <img class="img-responsive" src="{{ URL::to('/') }}/img/profile/{{ $profile->image }}" width="90px">
                                            @else
                                            <img src="{{ URL::to('/') }}/img/noimage.jpg" class="img-responsive">
                                            @endif
                                        </li> 
                                        <li>
                                            <p class="no-margin"> <strong>{{ __('Adresse') }}:
                                                </strong>&nbsp;  {{ $profile->address }}
                                            </p>
                                        </li> 
                                        <li>
                                            <p class="no-margin"> <strong>{{ __('Téléphone') }}:
                                                </strong>&nbsp;  {{ $profile->phone }}
                                            </p>
                                        </li> 
                                        <li>
                                            <p class="no-margin"> <strong>{{ __('Pays') }}:
                                                </strong>&nbsp;  {{ $profile->country->name }}
                                            </p>
                                        </li> 
                                        <li>
                                            <p class="no-margin"> <strong>{{ __('Pays') }}:
                                                </strong>&nbsp;  {{ $profile->country->name }}
                                            </p>
                                        </li> 
                                        <li>
                                            <p class="no-margin"> <strong>{{ __("Secteur d'activité") }}:
                                                </strong>&nbsp;  {{ $profile->category->name }}
                                            </p>
                                        </li> 
                                        <li>
                                            <p class="no-margin"> <strong>{{ __("Fonction") }}:
                                                </strong>&nbsp;  {{ $profile->activity->name }}
                                            </p>
                                        </li> 
                                        <li>
                                            <p class="no-margin"> <strong>{{ __("Taille de l'entreprise") }}:</strong>
                                                @if($profile->firmsize==1)
                                                   {{ __("0-9") }}
                                                @elseif($profile->firmsize==2)
                                                   {{ __("10-49") }}
                                                @elseif($profile->firmsize==3)
                                                   {{ __("50-499") }}
                                                @elseif($profile->firmsize==4)
                                                   {{ __("500-999") }}
                                                @elseif($profile->firmsize==5)
                                                   {{ __("Plus de 1000") }}
                                                @endif
                                            </p>
                                        </li> 
                                        @if(!empty($profile->website))
                                            <p class="no-margin"> <strong>{{ __("Site web") }}:
                                                </strong>&nbsp;  <a href="{{ $profile->website }}" target="_blank">{{ $profile->website }}</a>
                                            </p>
                                        @endif
                                            
                                    </ul>
                                </aside>
                        </div>
                        <div class="col-md-9">
                                <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <h4 class="panel-title">
                                                {{ $profile->company }}
                                            </h4>
                                        </div>
                                        <div class="panel-body">
                                                {!! $profile->about !!}
                                        </div> 
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop