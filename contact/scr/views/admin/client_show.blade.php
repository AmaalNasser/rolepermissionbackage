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
                    <h1 class="page-title"></h1>
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
                                <h2>Edit New Client </h2>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('client_control') }}"> Back</a>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body pt-2">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <h5 class="card-title m-0">Client Name</h5>
                                        <input type="text" name="name" value="{{ $client->name }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title m-0">Contact name 1</h5>
                                            <input type="text" name="contact_name_1"
                                                value="{{ $client->contact_name_1 }}" class="form-control">

                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title m-0">Email 1</h5>
                                            <input type="email" name="email_1" value="{{ $client->email_1 }}"
                                                class="form-control">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title m-0">Phone 1</h5>
                                            <input type="text" name="phone_1" value="{{ $client->phone_1 }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title m-0">Contact name 2</h5>
                                            <input type="text" name="contact_name_2"
                                                value="{{ $client->contact_name_2 }}" class="form-control">

                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title m-0">Email 2</h5>
                                            <input type="email" name="email_2" value="{{ $client->email_2 }}"
                                                class="form-control">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title m-0">Phone 2</h5>
                                            <input type="text" name="phone_2" value="{{ $client->phone_2 }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <h5 class="card-title m-0">Description</h5>
                                        <textarea name="description" class="form-control">{{ $client->description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Status:</strong>
                                        <select class="form-control" name="status" required>
                                            <option value="active" {{ $client->status == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="inactive" {{ $client->status == 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <h5 class="card-title m-0">Notes</h5>
                                        <textarea name="notes" class="form-control">{{ $client->notes }}</textarea>
                                    </div>
                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
