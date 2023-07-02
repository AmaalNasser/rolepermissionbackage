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
                    <h1 class="page-title">Client Control</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('user.complaint') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit New User</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Create New Client</h2>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('client_control') }}"> Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-2">
                        <form method="POST" action="{{ route('clients.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Client Name:</strong>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <strong>Contact Name 1:</strong>
                                                <input type="text" class="form-control" name="contact_name_1" required>
                                            </div>
                                            <div class="form-group">
                                                <strong>Email 1:</strong>
                                                <input type="email" class="form-control" name="email1" required>
                                            </div>
                                            <div class="form-group">
                                                <strong>Contact Number 1:</strong>
                                                <input type="text" class="form-control" name="phone1" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <strong>Contact Name 2:</strong>
                                                <input type="text" class="form-control" name="contact_name_2" required>
                                            </div>
                                            <div class="form-group">
                                                <strong>Email 2:</strong>
                                                <input type="email" class="form-control" name="email2" required>
                                            </div>
                                            <div class="form-group">
                                                <strong>Contact Number 2:</strong>
                                                <input type="text" class="form-control" name="phone2" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Description:</strong>
                                        <textarea class="form-control" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Contract:</strong>
                                        <input type="file" class="form-control" name="contract">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Status:</strong>
                                        <select class="form-control" name="status" required>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Notes:</strong>
                                        <textarea class="form-control" name="notes"></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@endsection
