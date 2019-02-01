<div class="col-sm-3 page-sidebar">
        <aside>
            <div class="inner-box">
                 <div class="user-panel-sidebar">
                    <div class="collapse-box">
                        <h5 class="collapse-title no-border">{{ __('Mon compte') }}
                            <a href="#MyClassified" data-toggle="collapse" class="pull-right" aria-expanded="true"><i class="fa fa-angle-down"></i></a>
                        </h5>
                        <div class="panel-collapse collapse in" id="MyClassified" aria-expanded="true" style="">
                            <ul class="acc-list">
                                <li>
                                    <a href="{{ route('account',Auth::user()->name) }}">
                                        <i class="fa fa-cog"></i> {{ __('Paramètres') }}
                                    </a>
                                </li> 
                                <li>
                                    <a href="{{ route('user_path') }}">
                                        <i class="fa fa-user-plus"></i> {{ __('Ajouter un collègue') }}
                                    </a>
                                </li> 
                            </ul>
                        </div>
                    </div>
                    @if(Auth::User() && (Auth::User()->profile)  && (Auth::user()->profile()->pluck('type')[0]=='acheteur'))
                        <div class="collapse-box">
                            <h5 class="collapse-title no-border">{{ __("Demandes") }}
                                <a href="#requests" data-toggle="collapse" class="pull-right" aria-expanded="true"><i class="fa fa-angle-down"></i></a>
                            </h5>
                            <div class="panel-collapse collapse in" id="requests" aria-expanded="true" style="">
                                <ul class="acc-list">
                                    <li>
                                        <a href="{{ route('tenders.index') }}">
                                            <i class="fa fa-edit"></i> {{ __(' Demandes de devis') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa fa-comment"></i> {{ __("Demandes d'information") }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div class="collapse-box">
                        <h5 class="collapse-title">
                            {{ __('Mes documents') }}
                            <a href="#MyAds" data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a>
                        </h5>
                        <div class="panel-collapse collapse in" id="MyAds">
                            <ul class="acc-list"> 
                                @if(Auth::User() && (Auth::User()->profile) && (Auth::user()->profile()->pluck('type')[0]=='fournisseur'))
                                    <li><a href="{{ route('posts') }}"><i class="icon-th-list"></i> {{ __("Appels d'offre ") }}</a>
                                    </li>
                                    <li><a href="{{ route('archivedf') }}"> <i class="fa fa-archive"></i> {{ __('Archives') }}</a></li>
                                    <li><a href="{{ route('quotations') }}"><i class="fa fa-balance-scale"></i> {{ __("Demandes de devis") }}</a>
                                    </li>
                                    <li><a href="{{ route('customers') }}"> <i class="fa fa-users"></i> {{ __('Mes clients') }} </a>
                                    </li>
                                    <li><a href="{{ route('favourite') }}"><i class="fa fa-heart"></i> {{ __('Offres favorites') }}
                                            <span class="badge">
                                                {{ Auth::user()->favorite_posts->where('pivot.user_id',Auth::user()->id)->count() }}
                                            </span>&nbsp;
                                        </a>
                                    </li>
                                @elseif(Auth::User() && (Auth::User()->profile)  && (Auth::user()->profile()->pluck('type')[0]=='acheteur'))
                                    <li>
                                        <a href="{{ route('myposts') }}"><i class="fa fa-copy"></i> {{ __('Mes offres') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('providers') }}"><i class="fa fa-users"></i> {{ __('Mes fournisseurs') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('inprogress') }}"><i class="fa fa-folder-open"></i> {{ __('Mes consultations en cours') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('archived') }}"><i class="fa fa-archive"></i> {{ __('Mes consultations archivées') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('drafts') }}"><i class="fa fa-pencil"></i> {{ __('Brouillons') }}</a>
                                    </li>
                                @endif
                            </ul>                                                              
                        </div>
                    </div>
                </div>
            </div>
             
        </aside>
    </div>