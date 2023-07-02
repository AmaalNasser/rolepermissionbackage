{{ app()->setLocale(Auth::user()->lang) }}
@extends('admin.layouts.dashboard')
@section('header')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.datatales.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}

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
                    <h1 class="page-title">Edit Role Control</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Role Control</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <!-- ROW-1 -->

                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12">
                                <div class="card text-left">
                                    <div class="card-body">

                                        {{-- form --}}
                                        <form id="UserForm" name="UserForm" class="form-horizontal" method="post"
                                            action="{{ route('rols_control_update', Auth::user()->id) }}">
                                            @csrf
                                            @method('PUT')
                                            {{-- Role --}}
                                            <div class="form-group">
                                                <label for="dispute_title"
                                                    class="control-label col-sm">{{ __('Role') }}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" value=" {{ $role->name }}"
                                                        name="role" id="name">
                                                </div>
                                            </div>

                                            <div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <div class="card text-left">
                                    <div class="card-body">
                                        <strong> User Permissions:</strong>
                                        <div class="text-wrap" class="form-control" name="permission_name[]"
                                            id="permission_name" required>
                                            <div class="example">

                                                <div class="tags">
                                                    {{-- @foreach ($role_permission as $permissions) --}}
                                                    @if ($role_permission->isEmpty())
                                                        <div class="alert alert-warning" role="alert">
                                                            There are no permission assigned to the user.
                                                        </div>
                                                    @else
                                                        @foreach ($role_permission as $permissions)
                                                            <span class="tag">
                                                                {{ $permissions }}
                                                                <a href="{{ url('rols_control/' . $role->id . '/remove_permission/' . $permissions) }}"
                                                                    class="tag-addon"><i class="fe fe-x"></i></a>
                                                            </span>
                                                        @endforeach
                                                    @endif
                                                    {{-- @endforeach --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    {{-- ADD Permission --}}
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <strong>Add Permission:</strong>
                                <div class="example">
                                    <form method="POST" action="{{ route('add_permission', [$role->id]) }}">
                                        @csrf
                                        <select class="form-control form-control-sm" name="permission[]" id="permission[]"
                                            required multiple>
                                            @if ($unassigned_permissions->isEmpty())
                                                <option value="">No More Permissions to Add!</option>
                                            @else
                                                @foreach ($unassigned_permissions as $permissions)
                                                    <option value="{{ $permissions->name }}">{{ $permissions->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        {{-- submit --}}
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-primary" onclick="" value="Add">

                                            <a href="{{ route('user_control') }}">
                                                <button class="btn btn-light">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW-1 END -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}

    {{-- edit Role Request --}}
    <script>
        $('body').on('click', '.editRoleRequest', function() {
            var roleRequest_id = $(this).data('id');
            $.get("{{ url('rols_control/editrole/') }}" + '/' + roleRequest_id,
                function(data) {
                    $('#ajaxModel').modal('show');
                    $('#role_id').val(data.id);
                    $('#permission_id').val(data.roles);

                })
        });
    </script>
@endsection
