<div class="header">
    <nav class="navbar navbar-site navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand logo logo-title" href="{{ url('/') }}">
                    <img src="{{URL::to('/')}}/img/sourcingHub.png" class="img-responsive">
                </a>
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div> 
            <div class="navbar-collapse collapse" id="navbarSupportedContent"> 
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="{{ route('root_path') }}"><i class="fa fa-home fa"></i></a></li>
                    <li><a href="{{ route('about_path') }}">{{ __("Qui sommes-nous?") }}</a></li>
                    <li><a href="#">{{ __("Nos formules") }}</a></li>
                    <li><a href="{{ route('contact_path') }}">{{ __("Contact") }}</a></li>
                </ul> 
                <ul class="nav navbar-nav navbar-right"> 
                     @if (!auth()->check())
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="fa fa-lock fa"></i> {{ __('Connexion') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> {{ __("S'inscrire") }}</a></li> 
                        <li class="postadd"><a class="btn btn-orange white" href="{{ route('posts.create') }}"> <i class="fa fa-plus-circle"></i> {{ __("Publier un appel d'offre") }}</a></li>
                    @else
                        <li class="dropdown navbar-notification ">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="fa fa-bell"></span>
                                <span class="badge badge-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
                            </a>
                            <ul class=" notification-list dropdown-menu">
                                @foreach (Auth::user()->unreadNotifications as $notification)
                                    <li>
                                         <a href="{{ route('notifications.show',['id'=>$notification->id]) }}">
                                         {{ ($notification->type)::toText($notification->data) }}
                                         </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off hidden-sm"></i> {{ __('Déconnexion') }} </a> 
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        <li class="dropdown">
                            <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button"  data-toggle="dropdown" aria-haspopup="true">
                                {{ Auth::user()->firstname ? Auth::user()->firstname.' '.Auth::user()->lastname :  Auth::user()->name}} <span class="caret"></span>
                            </a> 
                            <ul class="dropdown-menu user-menu" >
                                <li class="dropdown-header">{{ __("MON COMPTE") }}</li>
                                 <li role="separator" class="divider"></li>
                                <li><a href="{{ route('account',Auth::user()->name) }}">{{ __('Paramètres') }}</a></li>
                                <li><a href="{{ route('user_path') }}">{{ __('Ajouter un collègue') }}</a></li>  
                                @if(Auth::User() && (Auth::User()->profile) && (Auth::user()->profile()->pluck('type')[0]=='acheteur')) 
                                    <li role="separator" class="divider"></li> 
                                    <li class="dropdown-header">{{ __("MES DOCUMENTS") }}</li>
                                    <li role="separator" class="divider"></li> 
                                    <li><a href="{{ route('myposts') }}">{{ __("Mes offres") }}</a></li>
                                    <li> <a href="{{route('tenders.index')}}">{{ __("Demandes de devis") }}</a></li>
                                @endif 
                                 @if(Auth::User() && (Auth::User()->profile) && (Auth::user()->profile()->pluck('type')[0]=="fournisseur"))
                                    <li role="separator" class="divider"></li>
                                    <li class="dropdown-header">{{ __("MES DOCUMENTS") }}</li>
                                    <li role="separator" class="divider"></li>
                                    <li class="postadd"><a href="{{ route('posts') }}">{{ __("Appels d'offre ") }}</a></li>
                                    <li><a href="{{ route('archivedf') }}">{{ __('Archives') }}</a></li>
                                    <li><a href="{{ route('quotations') }}">{{ __("Demandes de devis") }}</a></li>
                                    <li><a href="{{ route('customers') }}">{{ __('Mes clients') }} </a></li>
                                    <li><a href="{{ route('favourite') }}">{{ __('Offres favorites') }} </a> </li>
                                @endif
                            </ul>
                        </li>
                        @if(Auth::User() && (Auth::User()->profile) && (Auth::user()->profile()->pluck('type')[0]=="acheteur"))
                            <li class="postadd"> <a class="btn btn-block btn-orange white" href="{{ route('posts.create') }}"><i class="fa fa-plus-circle"></i> {{ __("Publier un appel d'offre") }}</a></li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>