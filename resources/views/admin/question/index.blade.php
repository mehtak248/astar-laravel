@extends('layouts.admin.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Question</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Manage Questions</li>
                        <li class="breadcrumb-item active">Questions</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Questions List</h3>
                            <a href="{{ route('admin.questions.create') }}" class="btn btn-primary float-right" title="Add New Question"><i class="fa fa-plus" aria-hidden="true"></i> Add Question</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tbl_question_list" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Questions</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
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

    function intializeProjectTable()
    {
        user_list_table = $('#tbl_question_list').DataTable({
            dom: 'lBfrtip<"actions">',
                buttons: [],
                "destroy"   : true,
                "processing": true,
                "serverSide": true,
                'searching' : true,
                "pageLength": 10,
                "ajax":{
                    "url"     : "{{ route('admin.questions.index')}}",
                    "dataType": "json",
                    "type"    : "GET",
                    "data"    :{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    { "data": "question"},
                    { "data": "action",orderable: false, searchable: false, className: "text-center" }
                ],
        });
    }

    function deleteQuestion(id)
    {
        Swal.fire({
            text: "Are you sure you want to delete this question?",
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
                    url:"{{ url('admin/questions/')}}"+'/'+id+'/delQuestion',
                    success:function(data){
                        Swal.fire(
                            data['title'],
                            data['message'],
                            data['type']
                        ).then((result) => {
                            //Reload the table.
                            intializeProjectTable();
                        });
                    }
                });
            }
        })
    }
</script>
@endpush