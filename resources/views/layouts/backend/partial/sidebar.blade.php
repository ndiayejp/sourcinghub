<aside id="leftsidebar" class="sidebar">
        <div class="user-info">
            @if(Auth::user()->avatar)
                 <div class="image">
                    <img src="{{ url(Auth::user()->avatar) }}" alt="" class="userImg" width="48" height="48" alt="User">
                 </div>
            @else
            <div class="image">
                    <img src="/assets/backend/images/user.png" width="48" height="48" alt="User" />
                </div>
            @endif
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ empty(Auth::user()->firstname) ? Auth::user()->name : Auth::user()->firstname.' '.Auth::user()->lastname }}
                </div>
                <div class="email">{{ Auth::user()->email }}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li role="seperator" class="divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                <i class="material-icons">input</i>{{ __('Déconnexion') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="menu">
            <ul class="list">
                <li class="header">{{ __(' NAVIGATION') }}</li>
                @if(Request::is('admin*'))
                    <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="material-icons">dashboard</i> <span>{{ __('Tableau de bord') }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                        <a href="{{ route('admin.category.index') }}">
                            <i class="material-icons">apps</i>  <span>{{ __('Catégories') }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/post*') ? 'active' : '' }}">
                        <a href="{{ route('admin.post.index') }}">
                            <i class="material-icons">library_books</i>  <span>{{ __("Appels d'Offres") }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/tender*') ? 'active' : '' }}">
                        <a href="{{ route('admin.tender.index') }}">
                            <i class="material-icons">receipt</i>  <span>{{ __('Demandes de devis') }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/country') ? 'active' : '' }}">
                        <a href="{{ route('admin.country.index') }}">
                            <i class="material-icons">place</i> <span>Pays</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/incoterm') ? 'active' : '' }}">
                        <a href="{{ route('admin.incoterm.index') }}">
                            <i class="material-icons">view_headline</i> <span>Incoterm</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/state') ? 'active' : '' }}">
                        <a href="{{ route('admin.state.index') }}">
                            <i class="material-icons">flag</i> <span>{{ __("Statuts Appel d'offre") }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/open') ? 'active' : '' }}">
                        <a href="{{ route('admin.open.index') }}">
                            <i class="material-icons">language</i> <span>{{ __("Localité des marchés") }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/unit') ? 'active' : '' }}">
                        <a href="{{ route('admin.unit.index') }}">
                            <i class="material-icons">ballot</i> <span>{{ __("Unités de facturation") }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/user') ? 'active' : '' }}">
                        <a href="{{ route('admin.user.index') }}">
                            <i class="material-icons">account_circle</i> <span>{{__("Utilisateurs")}}</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/banner') ? 'active' : '' }}">
                        <a href="{{ route('admin.banner.index') }}">
                            <i class="material-icons">image</i> <span>{{__("Bannières")}}</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.user.subscribers') }}">
                            <i class="material-icons">chat</i> <span>{{__("Mailings")}}</span>
                        </a>
                    </li>
                    <li class="header">{{ __('Système') }}</li>
    
                    <li class="{{ Request::is('admin/settings') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings') }}"><i class="material-icons">settings</i> <span>{{ __('Paramètres') }}</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i><span>{{ __('Déconnexion') }}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endif
            </ul>
        </div>
        <div class="legal">
            <div class="copyright"> &copy; 2018 <a href="javascript:void(0);">{{ config('app.name', 'Laravel') }}</a>.</div>
            <div class="version"> <b>Version: </b> 1.0.0 </div>
        </div>
    </aside>