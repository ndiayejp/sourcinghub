@extends('layouts.backend.app')
@section('title','Post')
@push('css')
@endpush

@section('content')
    <div class="container-fluid">
        <a href="{{ route('admin.post.index') }}" class="btn btn-danger waves-effect">
            {{ __('Retour') }}</a>
        <br>
        <br>
        <form action="{{ route('admin.post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
           @csrf
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> {{ $post->name }}<small>{{ __('Publié par') }} <strong> 
                                {{ $post->user->name }}</strong> 
                                {{ __('le') }} {{ $post->created_at->toFormattedDateString() }}
                           {{ __("pour le compte de l'entreprise") }} <strong>{{ $post->company->name }}</strong> </small>  </h2>
                        <p><small>{{ __("Date de fermeture") }} {{ $post->closing_date }}</small></p>
                        <p><small>{{ __("Date de livraison") }} {{ $post->delivery_date }}</small></p>
                        </div>
                        <div class="body">
                            <p>{!! $post->description !!}</p>
                            <table class="table table-bordered">
                                <thead>
                                    <th>{{ __("Méthode de paiement") }}</th>
                                    <th>{{ __("Devise") }}</th>
                                    <th>{{ __("Adresse de livraison") }}</th>
                                    <th>{{ __("Pays") }}</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $post->payment_method }}</td>
                                        <td>{{ $post->offer_in_device }}</td>
                                        <td>{{ $post->address_delivery }}</td>
                                        <td>{{ $post->country->name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h5> {{ __("Secteur d'activité") }}</h5>
                            <p> {{ $post->category->name }}</p>
                        </li>
                        <li class="list-group-item">
                            <h5>{{ __("Domaine d'activité") }}</h5>
                            <p>{{ $post->area->name }}</p>
                        </li>
                        
                    </ul> 
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h5> {{ __("Contact de l'acheteur") }}</h5>
                            <p>{{ $post->user->firstname.' '.$post->user->lastname }}</p>
                            <p>{{ $post->user->profile()->pluck('phone')[0] }}</p>
                            <p>{{ $post->user->profile()->pluck('address')[0] }}</p>
                            <p>{{ $post->user->email }}</p>
                        </li> 
                    </ul> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                             <div class="form-group">
                                <input type="checkbox" id="active" class="filled-in" name="active" value="1" {{ $post->active == true ? 'checked' : '' }}>
                                <label for="active">Mettre en ligne</label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">{{ __('Mettre à jour') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
        });
        function approvePost(id) {
            swal({
                title: 'Are you sure?',
                text: "You went to approve this post ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('approval-form').submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'The post remain pending :)',
                        'info'
                    )
                }
            })
        }
    </script>
@endpush