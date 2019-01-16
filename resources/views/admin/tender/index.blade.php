@extends('layouts.backend.app')
@section('title','Demande de devis')
@push('css')
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>{{ __("Toutes les demandes de devis") }} <span class="badge bg-blue"> {{ $tenders->count() }}</span></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                     <th>{{ __("Intitulé de l'offre") }}</th> 
                                     <th>{{ __("Entreprise") }}</th>
                                     <th>{{ __('Représentant') }}</th>
                                     <th>{{ __('Statut') }}</th>
                                     <th>{{ __('Actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($tenders as $key=>$tender)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ str_limit($tender->name,'30') }}</td>
                                            <td>{{ $tender->user->profile->company }}</td>
                                            <td>
                                                <span>{{ $tender->user->name }}</span> 
                                                <span style="display:block">{{ $tender->user->firstname.' '.$tender->user->lastname }}</span>
                                            </td>
                                             <td>
                                                @if($tender->active == true)
                                                    <span class="badge bg-blue">{{ __('Publié') }}</span>
                                                @else
                                                    <span class="badge bg-pink">{{ __('En attente') }}</span>
                                                @endif
                                            </td>
                                             <td class="text-center">
                                                <a href="{{ route('admin.tender.edit',$tender->id) }}" class="btn btn-info waves-effect" title="voir l'offre">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                <button class="btn btn-danger waves-effect" type="button" onclick="deletePost({{ $tender->id }})" title="supprimer">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                <form id="delete-form-{{ $tender->id }}" action="{{ route('admin.tender.destroy',$tender->id) }}" method="POST" style="display: none;">
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
        function deletePost(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
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