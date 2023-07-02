{{ app()->setLocale(Auth::user()->lang) }}
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
        <div class="main-container container-fluid">
            <div class="container">
                <div class="page-header">
                    <h1 class="page-title">Client Control</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('user.complaint') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Client Control</li>
                        </ol>
                    </div>
                </div>

                <div class="left">
                    <a class="btn btn-success" href="{{ route('new_client') }}">Create New Client</a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-sm data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th width="100px">Action</th>
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
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('client_control') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            window.deleteClient = function(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger m-1',
                        cancelButton: 'btn btn-success m-1',
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to revert this details!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('/clients') }}/" + id,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}",
                                _method: 'DELETE'
                            },
                            success: function(data) {
                                $('.data-table').DataTable().ajax.reload(null, false);
                                swalWithBootstrapButtons.fire('Deleted!',
                                    'Details has been deleted.', 'success');
                            },
                            error: function(xhr) {
                                swalWithBootstrapButtons.fire('Error!',
                                    'An error occurred while deleting the details.',
                                    'error');
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire('Cancelled', 'Details is safe.', 'error');
                    }
                });
            };
        });
    </script>
@endsection
