<footer class="main-footer">
    <div class="footer-content">
            <div class="container">
                    <div class="col-lg-12">
                        <ul class="list-unstyled list-inline text-center ">
                            <li><a href="#">{{ __('Politique de confidentialité') }}  </a></li>|
                            <li><a href="#">  {{ __('Mentions légales ') }}</a></li> |
                            <li><a href="{{ route('contact_path') }}">  {{ __('Contact') }}</a></li>
                        </ul>
                    </div>   
                    <div class="col-lg-12 text-center">
                        <hr>
                        <p>&copy;{{ date('Y')}} Built for 
                            <a href="#">{{ config('app.name')}}</a> 
                            by <a href="#">@CartaLink SA</a>.</p>
                     </div>
            </div>
    </div>

    <div id="backToTop">
        <a href="#top"><i class="icon-up-open-big"></i></a>
    </div>
    
</footer>