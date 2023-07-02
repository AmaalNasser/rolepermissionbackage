@extends('admin.layouts.dashboard')

@section('header')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.datatales.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
    <title>Tickets</title>
    <style>
        table tbody tr {
            background-color: transparent !important;
            border-collapse: collapse;
        }
    </style>
@endsection
@section('content')
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <div class="container">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Tickets Control</h1>

                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('user.complaint') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tickets</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="card">
                    <div class="card-body">
                        <h3>Ticket Control</h3>
                        <table class="table table-sm data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>client</th>
                                    <th>project</th>
                                    <th>complain category</th>
                                    <th>complain subject</th>
                                    <th>attached files</th>
                                    <th>priority</th>
                                    <th width="100px">details</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- ROW-1 END -->
        </div>
    </div>

    {{-- model form --}}
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}

    {{-- datatable --}}
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ticket') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'client_id',
                        name: 'client_id'
                    },
                    {
                        data: 'project_id',
                        name: 'project_id'
                    },
                    {
                        data: 'complain_category_id',
                        name: 'complain_category_id'
                    },
                    {
                        data: 'complain_subject',
                        name: 'complain_subject'
                    },
                    {
                        data: 'file1',
                        name: 'file1'
                    },
                    {
                        data: 'priority',
                        name: 'priority',
                        render: function(data, type, full, meta) {
                            var color;
                            switch (data) {
                                case 'High':
                                    color = 'red';
                                    break;
                                case 'Normal':
                                    color = 'green';
                                    break;
                                case 'Low':
                                    color = 'blue';
                                    break;
                                default:
                                    color = 'inherit';
                                    break;
                            }
                            return '<span style="color: ' + color + ';">' + data + '</span>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false

                    },
                ]
            });

        });
    </script>
@endsection
