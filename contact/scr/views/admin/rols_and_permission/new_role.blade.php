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
                    <h1 class="page-title">Roles Control</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit New Role</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Create New Role</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('rols_control') }}"> Back</a>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-2">
                    <form method="POST" action="{{ route('storerole') }}">
                        @csrf
                        <div class="row">
                            {{-- Roles --}}
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Role:</strong><input type="text" class="form-control" name="role_name">
                                </div>
                            </div>

                            {{-- Permissions --}}
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Permission:</strong>
                                    <div class="input-group mb-3">

                                        <select class="form-control" name="permission_name[]" id="permission_name" required
                                            multiple>
                                            @foreach ($all_permissions_in_database as $permission)
                                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- submit --}}
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <!-- ROW-1 END -->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}

    <!-- JavaScript code for Permissions-->
    <script>
        let selectedOptions = [];
        let select = document.getElementById('permission_name');
        select.addEventListener('change', function() {
            selectedOptions = [];
            let options = select.options;
            for (let i = 0; i < options.length; i++) {
                if (options[i].selected) {
                    selectedOptions.push(options[i].value);
                }
            }
        });
    </script>
@endsection
