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

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <div class="container">

                {{-- @can('edit') --}}
                <div class="page-header">
                    <h1 class="page-title">Roles Control</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('user.complaint') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Role Control</li>
                        </ol>
                    </div>
                </div>
                @if (auth()->user()->can('Roles Create'))
                    <div class="left">
                        <a class="btn btn-success" href="{{ route('new_role') }}"> Create New Role</a>
                    </div>
                @endif

                <!-- ROW-1 -->
                <div class="card">
                    <div class="card-body">

                        <table class="table  table-sm data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Roles</th>
                                    <th>Permission</th>
                                    <th width="100px">action</th>
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

    {{-- Form to Show User Control  --}}
    <div class="modal fade" id="ajaxModel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading1">{{ __('Show Role Details') }} </h4>
                </div>

                <div class="modal-body">
                    <form id="ShowRoleRequest" name="ShowRoleRequest" {{-- class="form-horizontal" method="GET"
                        action="{{ url('/user_control/show') }}" --}}>
                        @csrf
                        {{-- @method('PUT') --}}
                        <input type="hidden" name="role_id" id="role_id">


                        {{-- role --}}
                        <div class="form-group">
                            <label for="User Name" class="col-form-label control-label">{{ __('Role') }}</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="{{ old('role_id') }}" name="role_id"
                                    id="role_show" disabled>
                            </div>
                        </div>


                        {{-- permission --}}
                        <div class="form-group">
                            <label for="User Name" class="col-form-label control-label">{{ __('Permission') }}</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" value="{{ old('permission_id') }}" name="name"
                                    id="permission_show" disabled>
                            </div>
                        </div>

                        <div class="modal-footer"><a href="http://192.168.100.115:8123/rols_control">
                                <button class="btn btn-light">Close</button></a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end form View User Control --}}
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
                ajax: "{{ route('rols_control') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'permissions',
                        name: 'permissions'
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

    {{-- delete --}}
    <script>
        DeleteRep = (id) => {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger m-1',
                    cancelButton: 'btn btn-success m-1',
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({

                title: '{{ __('Are you sure?') }}',
                text: '{{ __('You will not be able to revert this details!') }}',
                icon: '{{ __('warning') }}',
                showCancelButton: true,
                confirmButtonText: '{{ __('Yes, delete it!') }}',
                cancelButtonText: '{{ __('No, cancel!') }}',
                reverseButtons: true

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/rols_control/deleterole') }}/" + id,
                        type: "delete",
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: 'delete'
                        },
                        success: function(data) {

                            $('.data-table').DataTable().ajax.reload(null, false);
                            swalWithBootstrapButtons.fire(
                                '{{ __('Deleted!') }}',
                                '{{ __('details has been deleted.') }}',
                                '{{ __('success') }}'
                            )
                        },
                    });

                } else if (

                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        '{{ __('Cancelled') }}',
                        '{{ __('details is safe') }}',
                        '{{ __('error') }}'
                    )
                }
            })
        }
    </script>

    {{-- show  --}}
    <script>
        $('body').on('click', '.ShowRoleRequest', function() {
            var roleRequest_id = $(this).data('id');
            $.get("{{ url('user_control/show') }}" + '/' + roleRequest_id,
                function(data) {
                    $('#ajaxModel1').modal('show');
                    $('#role_id').val(data.id);
                    $('#role_show').val(data.role);
                    $('#permission_show').val(data.permission);

                    console.log(data)
                })
        });
    </script>
@endsection
