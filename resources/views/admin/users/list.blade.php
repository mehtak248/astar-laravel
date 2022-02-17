@extends('layouts.admin.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Users</h1>
                </div><!-- /.col -->
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content admin-userList">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                {!! $dataTable->table() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    {!! $dataTable->scripts() !!}
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function() {
                setTimeout(() => {
                    $('.dt-buttons button.dt-button').addClass('btn btn-outline-primary');
                    $('.dt-buttons button.dt-button.buttons-csv .fa').toggleClass('fa-file-excel-o fa-file-excel');
                }, 50);
            });
        })(jQuery);
    </script>
@endpush
