@extends('layouts.admin.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Social Wall</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Manage Social Wall</li>
                        {{-- <li class="breadcrumb-item active"></li> --}}
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Social Wall</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tbl_user_list" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="10%">No.</th>
                                            <th width="20%">Image</th>
                                            <th width="50%">Description</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
@if(session()->has('message'))
    <script type="text/javascript">
        Toast.fire({
            icon: "{{ session()->get('icon') }}",
            title: "{{ session()->get('message') }}",
        });
    </script>
@endif
<script type="text/javascript">
    
    $(document).ready(function() {
        //intialize the data Table. 
        intializeProjectTable();
    });

    /*Intialze the datatable*/
    function intializeProjectTable()
    {
        user_list_table = $('#tbl_user_list').DataTable({
            dom: 'lBfrtip<"actions">',
                buttons: [],
                "destroy"   : true,
                "processing": true,
                "serverSide": true,
                'searching' : true,
                "pageLength": 10,
                "ajax":{
                    "url"     : "{{ route('admin.socialwall.index')}}",
                    "dataType": "json",
                    "type"    : "GET",
                    "data"    :{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    { "data": "post_img"},                    
                    { "data": "description"},                    
                    { "data": "action",orderable: false, searchable: false, className: "text-center" }
                ],
        });
    }

    /*Delete the post*/
    function deletePost(id)
    {
        Swal.fire({
            text: "Are you sure you want to delete this social post?",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.value) {
                
                //send request to server
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'GET',
                    url:"{{ url('admin/socialwall') }}"+'/'+id+'/postdelete',
                    success:function(data){
                        Swal.fire(
                            data['title'],
                            data['message'],
                            data['type']
                        ).then((result) => {
                            // Reload the table.
                            intializeProjectTable();
                        });
                    }
                });
            }
        })
    }
</script>
@endpush