<footer class="main-footer">
    <div class="footer-content">
            <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="title"> <b>{{ __("Suivez-nous") }}</b></h3>
                            <p>{{ __("Retrouvez sourcingHub sur les réseaux sociaux et suivez toutes nos actualités et offres") }}</p>
                            <ul class="list-inline">
                                <li><a href="#"><i class="fa fa-facebook fa-2x"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter  fa-2x"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin  fa-2x"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-md-5">
                            <h3 class="title"><b>{{ __("Abonnement newsletter") }}</b></h3>
                            <form method="POST" action="{{ route('subscriber.store') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input class="form-control" name="email" type="email" placeholder="{{ __('Saississez votre adresse email') }}">
                                <div class="input-group-btn">
                                  <button class=" btn btn-orange white" type="submit"><i class="fa fa-envelope"></i> Inscription</button>
                                </div>
                            </div>
                           
                        </form>
                        </div>
                        <div class="col-lg-3">
                            <ul class="list-unstyled text-right ">
                                <li><a href="#">{{ __('Politique de confidentialité') }}  </a></li>
                                <li><a href="#">  {{ __('Mentions légales ') }}</a></li>
                                <li><a href="{{ route('contact_path') }}">  {{ __('Contact') }}</a></li>
                            </ul>
                        </div> 
                    </div>  
                   <div class="row">
                        <div class="col-lg-12 text-center">
                        <hr>
                        <p>&copy;{{ date('Y')}} Built for 
                            <a href="#">{{ config('app.name')}}</a> by <a href="#">@CartaLink SA</a>.</p>
                     </div>
                   </div>
            </div>
    </div>
    <div id="backToTop">
        <a href="#top"><i class="icon-up-open-big"></i></a>
    </div>
</footer>