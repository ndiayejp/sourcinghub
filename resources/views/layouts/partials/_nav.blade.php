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
                    <li><a href="{{ route('root_path') }}"class="blue-color"><i class="icon-home fa"></i></a></li>
                    <li><a href="{{ route('about_path') }}">{{ __("Qui sommes-nous?") }}</a></li>
                    <li><a href="#">{{ __("Nos formules") }}</a></li>
                    <li><a href="{{ route('contact_path') }}">{{ __("Contact") }}</a></li>
                </ul> 
                <ul class="nav navbar-nav navbar-right"> 
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"> <i class="icon-user fa"></i>{{ __('Connexion') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><i class="icon-user-add fa"></i> {{ __("S'inscrire") }}</a>
                        </li>
                       
                        <li class="postadd">
                            <a class="btn btn-orange white" href="/posts/create">
                                <i class="fa fa-plus-circle"></i> {{ __("Publiez une Offre") }}
                            </a>
                        </li>
                     @else
                         <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                 <i class="fa fa-power-off hidden-sm"></i> {{ __('Déconnexion') }}
                            </a> 
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        <li class="dropdown">
                            <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button"  data-toggle="dropdown" aria-haspopup="true">
                                {{ Auth::user()->firstname ? Auth::user()->firstname.' '.Auth::user()->lastname :  Auth::user()->name}} <span class="caret"></span>
                            </a> 
                            <ul class="dropdown-menu user-menu" >
                                <li>
                                    <a href="{{ route('account',Auth::user()->name) }}"><i class="icon-home"></i>  {{ __('Mon compte') }}</a>
                                </li> 
                                @if(Auth::user()->profile()->pluck('type')[0]=='acheteur')
                                    {{--  <li>
                                        <a href="{{ route('mycompanies') }}"><i class="icon-town-hall"></i> {{ __('Mon entreprise') }}</a>
                                    </li>  --}}
                                    <li>
                                        <a href="{{ route('myposts') }}"><i class="icon-th-thumb"></i> {{ __('Mes offres') }}</a>
                                    </li>
                                @endif 
                            </ul>
                        </li>
                        @if(Auth::user()->profile()->pluck('type')[0]=='acheteur')
                            <li class="postadd">
                                <a class="btn btn-block btn-orange white" href="/posts/create">
                                    <i class="fa fa-plus-circle"></i> {{ __("Publiez une Offre") }}
                                </a>
                            </li>
                        @endif
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>