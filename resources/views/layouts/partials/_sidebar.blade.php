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
                                        <i class="icon-cog"></i> {{ __('Paramètres') }}
                                    </a>
                                </li>
                                 
                                    <li>
                                        <a href="{{ route('user_path') }}">
                                            <i class="icon-user-add"></i> {{ __('Ajouter un collègue') }}
                                        </a>
                                    </li>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="collapse-box">
                        <h5 class="collapse-title">
                            {{ __('ACCES RAPIDES') }}
                            <a href="#MyAds" data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a>
                        </h5>
                        <div class="panel-collapse collapse in" id="MyAds">
                            <ul class="acc-list"> 
                               @if(Auth::user()->profile()->pluck('type')[0]=='fournisseur') 
                                    <li>
                                        <a href="{{ route('archivedf') }}">
                                            <i class="icon-folder"></i> {{ __('Archives') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('customers') }}">
                                            <i class="icon-users"></i> {{ __('Mes clients') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('favourite') }}">
                                            <i class="icon-heart"></i> {{ __('Offres favorites') }}
                                            <span class="badge">
                                                    {{ Auth::user()->favorite_posts->where('pivot.user_id',Auth::user()->id)->count() }}
                                            </span>&nbsp;
                                        </a>
                                    </li>
                                @elseif(Auth::user()->profile()->pluck('type')[0]=='acheteur')
                                    <li>
                                        <a href="{{ route('myposts') }}">
                                            <i class="icon-book-open"></i> {{ __('Mes offres') }}
                                         </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('providers') }}">
                                            <i class="icon-users"></i> {{ __('Mes fournisseurs') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('inprogress') }}">
                                            <i class="icon-book"></i> {{ __('Mes consultations en cours') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('archived') }}">
                                            <i class="icon-folder-open"></i> {{ __('Mes consultations archivées') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('drafts') }}">
                                            <i class="icon-pencil"></i> {{ __('Brouillons') }}
                                        </a>
                                    </li>
                                @endif
                            </ul>                                                              
                        </div>
                    </div>
                    
                </div>
             </div>
        </aside>
    </div>