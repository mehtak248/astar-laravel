@extends('layouts.admin.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Users List</h1>
                </div><!-- /.col -->
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content admin-leaderboard">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row input-daterange mb-3">
                                <div class="col-md-4">
                                    <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                                </div>
                                <div class="col-md-4">
                                    <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                                    <button type="button" name="refresh" id="refresh" class="btn btn-default">Clear</button>
                                </div>
                            </div>
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
    <script type="text/javascript">
        $(function() {
            window.LaravelDataTables = window.LaravelDataTables || {};
            window.LaravelDataTables["quizplayed-table"] = $("#quizplayed-table").DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "{{ route('admin.leaderboard') }}",
                    "type": "GET",
                    "dataType": "json",
                    "data": function(data) {
                        for (var i = 0, len = data.columns.length; i < len; i++) {
                            if (!data.columns[i].search.value) delete data.columns[i].search;
                            if (data.columns[i].searchable === true) delete data.columns[i].searchable;
                            if (data.columns[i].orderable === true) delete data.columns[i].orderable;
                            if (data.columns[i].data === data.columns[i].name) delete data.columns[i].name;
                        }
                        delete data.search.regex;
                        data._token = "{{ csrf_token() }}";
                        data.startDate = $('input[name="from_date"]').val();
                        data.endDate = $('input[name="to_date"]').val();
                    }
                },
                "columns": [{
                    "data": "rank",
                    "name": "rank",
                    "title": "Rank",
                    "orderable": true,
                    "searchable": true
                }, {
                    "data": "name",
                    "name": "name",
                    "title": "Name",
                    "orderable": true,
                    "searchable": true
                }, {
                    "data": "email",
                    "name": "email",
                    "title": "Email",
                    "orderable": true,
                    "searchable": true
                }, {
                    "data": "score",
                    "name": "score",
                    "title": "Score",
                    "orderable": true,
                    "searchable": true
                }],
                "dom": "Bfrtip",
                "order": [
                    [1, "desc"]
                ],
                "buttons": ["csv"],
                "initComplete": function(settings, json) {
                    $('.dt-buttons button.dt-button').addClass('btn btn-outline-primary');
                    $('.dt-buttons button.dt-button.buttons-csv .fa').toggleClass('fa-file-excel-o fa-file-excel');
                }
            });

            $(document).on('click', '#filter', function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();

                if (from_date !== '' && to_date !== '') window.LaravelDataTables["quizplayed-table"].draw();
            });

            $(document).on('click', '#refresh', function() {
                $('#from_date, #to_date').val('');
                window.LaravelDataTables["quizplayed-table"].draw();
            });
        });
    </script>

@endpush
