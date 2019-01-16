@extends('layouts.backend.app')

@section('title','Utilisateurs')

@push('css')
     <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        {{--  <div class="block-header">
            <a class="btn btn-primary waves-effect" href="{{ route('admin.user.create') }}">
                <i class="material-icons">add</i>
                <span>{{ __('Ajouter un Utilisateur') }}</span>
            </a>
        </div>  --}}
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{ __('Tous les utilisateurs') }}
                            <span class="badge bg-blue">{{ $users->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('Avatar') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Prenom/Nom ') }}</th>
                                    <th>{{ __('Statut') }}</th>
                                    <th>{{ __("Mis en avant") }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach($users as $key=>$user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                @if($user->avatar == 1)
                                                <img src="{{ url(Auth::user()->avatar) }}" alt="" class="circle  userImg" width="48" height="48" alt="User">
                                                @else
                                                <img src="/assets/backend/images/user.png" width="48" height="48" alt="User" class="circle " />
                                                @endif
                                            </td>
                                            <td>{{ isset($user->profile()->pluck('type')[0]) ? $user->profile()->pluck('type')[0] : ""}}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ empty($user->firstname) ? ":)" : $user->fullName }}</td>
                                            <td>
                                                @if($user->active == 1)
                                                    <span class="badge bg-green">{{ __('Actif') }}</span>
                                                @else
                                                    <span class="badge bg-pink">{{ __('Non actif') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                 @if($user->featured == 1)
                                                    <span class="badge bg-green">{{ __('Mis en avant') }}</span>
                                                @else
                                                    <span class="badge bg-primary">{{ __('Non mis en avant') }}</span>
                                                @endif
                                            </td>
                                             <td class="text-center">
                                                <a href="{{ route('admin.user.edit',$user->id) }}" class="btn btn-info waves-effect">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <button class="btn btn-danger waves-effect" type="button" onclick="deleteUser({{ $user->id }})">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.user.destroy',$user->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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
        <!-- #END# Exportable Table -->
    </div>
@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteUser(id) {
            swal({
                title: 'Êtes vous sur?',
                text: "You won't be able to revert this!",
                type: 'Attention',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, Supprimer!',
                cancelButtonText: 'Non, Annuler!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush