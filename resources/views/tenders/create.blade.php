@extends('layouts.app')

<div class="h-spacer"></div>

@section('content')
<div class="container"> 
        <div class="row"> 
            @include('layouts/partials/_sidebar') 
            <div class="col-sm-9 page-content"> 
                <div class="panel panel-default">
                    <div class="panel-heading">
                         <div class="row">
                            <div class="col-md-6">
                                <h3>{{ __("Demande de devis") }} </h3>
                            </div>
                            <div class="col-md-6">
                                 <a href="{{ route('tenders.index') }}" class="pull-right">
                                 <i class="fa fa-list"></i> <b><u>{{ __("Liste des demandes de devis") }}</u></b>
                                </a>
                            </div>
                         </div>
                    </div>
                     
                    <div class="panel-body">
                        
                        @if(count($errors) >0 )
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                                </div>
                        @endif
                        
                        {!! Form::open(['action' => 'TendersController@store', 'method' => 'POST', 'id'=>'formTender']) !!}

                        @include('tenders.form')
                        <div class="form-group">
                            <button class="btn btn-primary" >
                                <i class="fa fa-plus-circle"></i>
                                {{ __("Enregistrer la demande de devis") }}
                            </button>   
                        </div> 
                    </div> 
                    {!! Form::close() !!}
                   
                    <div class="panel-footer"> 
                    </div>
                </div> 
            </div>
        </div>
</div>
    
@endsection

@section('script') 
    <script type="text/javascript"> 
             $('.textarea-wysiwyg').trumbowyg({
                btns: ['strong', 'em', '|', 'link','|','unorderedList', 
                'orderedList','|','justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull','|','viewHTML',
                '|','undo', 'redo'],
                autogrow: true,
                lang: 'fr'
            });

            $.ajaxSetup({ 
                headers: { 
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
            });

            $('#emails').multiple_emails();

            let  i=$('table tr').length;
            $('.table-add_line').click(function(){
                let count=$('table tr').length;
                let data = "<tr><td class='table-name'><input type='text' class='table-control form-control' name='product_name[]'></td>";
                data += "<td><input type='text' class='table-control form-control'  name='product_unit[]'></td>";
                data += "<td><input type='text' class='table-control form-control'  name='product_qte[]'></td>";
                data += "<td><textarea  class='table-control form-control' name='product_body[]' row='1'></textarea></td>";
                data += "<td><span class='remove-btn btn btn-danger'><i class='fa fa-trash'></i></span></td>";
                data += "</tr">
                $('table').append(data);
                i++;
            })
            $(document).on('click', '.remove-btn', function(){
                $(this).closest('tr').remove();
            })
          /*  $(document).on('submit','#formTender',function(e){
                e.preventDefault();
                $.ajax({  
                    url:$(this).attr('action'),  
                    method:$(this).attr('method'),
                    dataType: 'JSON',
                    data:$(this).serialize() 
                })
                .done(function(data){
                     toastr.success('Demande de devis enregistrée', 'Success Alert', {timeOut: 5000});
                     $('#formTender')[0].reset()
                    
                })
                .fail(function(data){
                    console.log("Error: ", data);
                    console.log("Errors->", data.error);
                })
            })*/
    </script>
 @endsection