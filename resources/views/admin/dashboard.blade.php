@extends('layouts.backend.app')
@section('title',__('Tableau de bord'))
@push('css')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header"><h2>{{ __('TABLEAU DE BORD') }}</h2></div>
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
                    <div class="info-box bg-green">
                        <div class="icon"><i class="material-icons">playlist_add_check</i></div>
                        <div class="content">
                            <a href="{{ route('admin.post.index') }}" style="text-decoration:none">
                                <div class="text">{{ __("Appels d'offres") }}</div>
                                <div class="number">{{ $posts->count() }}</div>
                            </a>
                        </div>
                    </div>
             </div>

             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> 
                    <div class="info-box bg-black">
                        <div class="icon"><i class="material-icons">playlist_add_check</i></div>
                        <div class="content">
                            <a href="{{ route('admin.tender.index') }}" style="text-decoration:none">
                                <div class="text">{{ __("Demandes de devis") }}</div>
                                <div class="number"> {{ $tenders }}</div>
                            </a>
                        </div>
                    </div>
             </div>
           
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <div class="icon"><i class="material-icons">library_books</i> </div>
                    <div class="content">
                        <a href="{{ route('admin.post.index') }}" style="text-decoration:none">
                            <div class="text">{{ __("Offres actives") }}</div>
                            <div class="number">{{ $total_pending_posts }}</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange">
                    <div class="icon"><i class="material-icons">mail</i></div>
                    <div class="content"> 
                        <a href="{{ route('admin.user.subscribers') }}" style="text-decoration:none">
                            <div class="text">{{ __('newsletter') }}</div>
                            <div class="number">{{$subscribers}}</div>
                        </a> 
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <div class="info-box bg-pink">
                    <div class="icon"><i class="material-icons">apps</i></div>
                    <div class="content">
                        <a href="{{ route('admin.category.index') }}" style="text-decoration:none">
                            <div class="text">{{ __("CATEGORIES") }}</div>
                            <div class="number">{{ $category_count }}</div>
                        </a>
                    </div>
                </div>
                <div class="info-box bg-purple">
                    <div class="icon"><i class="material-icons">account_circle</i></div>
                    <div class="content">
                        <a href="{{ route('admin.user.index') }}" style="text-decoration:none">
                            <div class="text">{{ __("UTILISATEURS") }}</div>
                            <div class="number">{{ $author_count }}</div>
                        </a>
                    </div>
                </div>
                <div class="info-box bg-deep-purple">
                    <div class="icon"><i class="material-icons">fiber_new</i></div>
                    <div class="content">
                        <a href="{{ route('admin.user.index') }}" style="text-decoration:none">
                            <div class="text">{{ __("NOUVEL UTILISATEUR") }}</div>
                            <div class="number">{{ $new_authors_today }}</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                <div class="card">
                    <div class="header"><h2>{{ __('Offres les plus populaires') }}</h2></div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>{{ __('Classement') }}</th>
                                        <th>{{ __('Nom') }}</th>
                                        <th>{{ __('Auteur') }}</th>
                                        <th>{{ __('Vues') }}</th>
                                        <th>{{ __('Favoris') }}</th>
                                        <th>{{ __('Statut') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($popular_posts as $key=>$post)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ str_limit($post->name,'20') }}</td>
                                            <td>{{ !empty($post->user->firstname) ? $post->user->firstname.' '.$post->user->lastname : $post->user->name }}</td>
                                            <td>{{ $post->view_count }}</td>
                                            <td>{{ $post->favorite_to_users_count }}</td>
                                             <td>
                                                @if($post->active == true)
                                                    <span class="label bg-green">{{ __('Publié') }}</span>
                                                @else
                                                    <span class="label bg-red">{{ __('Hors ligne') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary waves-effect" target="_blank" href="{{ route('admin.post.show',$post->slug) }}">{{ __('Voir') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header"> <h2>{{ __('TOP 10 DES UTILISATEURS LES PLUS ACTIFS  ') }}</h2></div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                <tr>
                                    <th>{{ __('Classement') }}</th>
                                    <th>{{ __('Nom') }}</th>
                                    <th>{{ __('Offres') }}</th>
                                    <th>{{ __('Commentaires') }}</th>
                                    <th>{{ __('Favoris') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($active_authors as $key=>$author)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                @if(!empty($author->lastname)) {{ $author->fullName }}
                                                @else {{ $author->name }}
                                                @endif
                                            </td>
                                            <td>{{ $author->posts_count }}</td>
                                            <td>{{ $author->comments_count }}</td>
                                            <td>{{ $author->favorite_posts_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
 
    <script src="{{ asset('assets/backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>
 
    <script src="{{ asset('assets/backend/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/morrisjs/morris.js') }}"></script>

    <script src="{{ asset('assets/backend/plugins/chartjs/Chart.bundle.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/flot-charts/jquery.flot.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/flot-charts/jquery.flot.resize.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/flot-charts/jquery.flot.pie.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/flot-charts/jquery.flot.categories.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/flot-charts/jquery.flot.time.js')}}"></script>

    <script src="{{ asset('assets/backend/plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>
    <script src="{{ asset('assets/backend/js/pages/index.js') }}"></script>
@endpush