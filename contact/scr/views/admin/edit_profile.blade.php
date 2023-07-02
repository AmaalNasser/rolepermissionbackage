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
    {{-- <div class="main-content app-content mt-0"> --}}
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Edit Profile</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                    </ol>
                </div>
            </div>
            {{-- Edit password --}}
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Password</div>
                        </div>
                        <div class="card-body">
                            <form id="edit-avatar-form" action="{{ route('update.password') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label class="form-label">Current Password</label>
                                    <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                        <a href="javascript:void(0)"
                                            class="input-group-text bg-white text-muted toggle-password"
                                            data-input="current-password-input">
                                            <i class="zmdi zmdi-eye text-muted" id="eye-icon1" aria-hidden="true"></i>
                                        </a>
                                        <input name="current_password" class="input100 form-control"
                                            id="current-password-input" type="password" placeholder="Current Password"
                                            autocomplete="current-password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">New Password</label>
                                    <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                        <a href="javascript:void(0)"
                                            class="input-group-text bg-white text-muted toggle-password"
                                            data-input="new-password-input">
                                            <i class="zmdi zmdi-eye text-muted" id="eye-icon2" aria-hidden="true"></i>
                                        </a>
                                        <input name="new_password" class="input100 form-control" id="new-password-input"
                                            type="password" placeholder="New Password" autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                        <a href="javascript:void(0)"
                                            class="input-group-text bg-white text-muted toggle-password"
                                            data-input="confirm-password-input">
                                            <i class="zmdi zmdi-eye text-muted" id="eye-icon3" aria-hidden="true"></i>
                                        </a>
                                        <input name="confirm_password" class="input100 form-control"
                                            id="confirm-password-input" type="password" placeholder="Confirm Password"
                                            autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" id="update-password-btn"
                                        class="btn btn-success my-1">Update</button>
                                    <a href="javascript:void(0)" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Profile</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleInputname">Full Name</label>
                                            <input type="text" class="form-control" id="exampleInputname" name="full_name" placeholder="Full Name" value="{{ $user->full_name }}">
                                        </div>
                                        {{-- Designation --}}
                                        <div class="form-group">
                                            <label for="exampleInputdesignation">Designation</label>
                                            <input type="text" class="form-control" id="exampleInputdesignation" name="designation" placeholder="Designation" value="{{ $user->designation }}">
                                        </div>
                                        {{-- Date of Birth --}}
                                        <div class="form-group">
                                            <label class="form-label">Date Of Birth</label>
                                            <div class="row">
                                                <div class="col-md-4 mb-2">
                                                    <select class="form-control select2 form-select" name="birth_date">
                                                        <option value="0">Date</option>
                                                        @for ($day = 1; $day <= 31; $day++)
                                                            <option value="{{ $day }}" {{ $user->birth_date == $day ? 'selected' : '' }}>
                                                                {{ sprintf('%02d', $day) }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <select class="form-control select2 form-select" name="birth_month">
                                                        <option value="0">Mon</option>
                                                        @for ($month = 1; $month <= 12; $month++)
                                                            <option value="{{ $month }}" {{ $user->birth_month == $month ? 'selected' : '' }}>
                                                                {{ date('M', mktime(0, 0, 0, $month, 1)) }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <select class="form-control select2 form-select" name="birth_year">
                                                        <option value="0">Year</option>
                                                        @php
                                                            $currentYear = date('Y');
                                                            $startYear = $currentYear - 120;
                                                        @endphp
                                                        @for ($year = $currentYear; $year >= $startYear; $year--)
                                                            <option value="{{ $year }}" {{ $user->birth_year == $year ? 'selected' : '' }}>
                                                                {{ $year }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center chat-image mb-5">
                                            <div class="avatar avatar-xxl chat-profile mb-3 brround">
                                                <label for="avatar-input">
                                                    <input id="avatar-input" type="file" name="avatar" style="display: none;">
                                                    <img id="avatar-image" alt="avatar" src="{{ asset($user->avatar ?: 'assets/images/users/no-emp-image.png') }}" class="brround">
                                                </label>
                                            </div>
                                            <div class="main-chat-msg-name">
                                                <label for="avatar-input">
                                                    <h5 class="text-dark mb-0 fs-14 fw-semibold">{{ $user->name }}</h5>
                                                </label>
                                                <p>
                                                    <small class="text-muted">
                                                        @foreach ($user->roles as $role)
                                                            {{ $role->name }}
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email address" value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputnumber">Contact Number</label>
                                    <input type="number" class="form-control" id="exampleInputnumber" name="phone" placeholder="Contact number" value="{{ $user->phone }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Website</label>
                                    <input class="form-control" name="website" placeholder="http://splink.com" value="{{ $user->website }}">
                                </div>
                
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-success my-1">Update</button>
                                    <a href="javascript:void(0)" class="btn btn-danger my-1">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                


            </div>
        </div>

    </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    {{--  change the avatar --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the input file and update button elements
            var avatarInput = document.getElementById('avatar-input');
            var defaultAvatarSrc = "{{ asset('assets/images/users/no-emp-image.png') }}";
            var avatarImage = document.getElementById('avatar-image');

            // Check if a file is already selected
            if (!avatarInput.files || avatarInput.files.length === 0) {
                // Set the default avatar image source
                avatarImage.src = defaultAvatarSrc;
            }

            // Add a change event listener to the input file element
            avatarInput.addEventListener('change', function() {
                if (avatarInput.files.length > 0) {
                    var file = avatarInput.files[0];

                    var reader = new FileReader();

                    // Set up the onload event handler for the file reader
                    reader.onload = function(e) {
                        // Update the avatar image source
                        avatarImage.src = e.target.result;
                    };

                    reader.readAsDataURL(file);
                } else {
                    // No file selected, set the default avatar image source
                    avatarImage.src = defaultAvatarSrc;
                }
            });

            avatarImage.addEventListener('click', function() {
                avatarInput.click();
            });
        });
    </script>
    {{-- eye button to see password --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to toggle password visibility
            function togglePasswordVisibility(inputId, eyeIconId) {
                var input = $('#' + inputId);
                var eyeIcon = $('#' + eyeIconId);

                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    eyeIcon.removeClass('zmdi-eye').addClass('zmdi-eye-off');
                } else {
                    input.attr('type', 'password');
                    eyeIcon.removeClass('zmdi-eye-off').addClass('zmdi-eye');
                }
            }

            // Event handler for the eye button click
            $('.toggle-password').click(function() {
                var inputId = $(this).data('input');
                var eyeIconId = $(this).attr('id');
                togglePasswordVisibility(inputId, eyeIconId);
            });
        });
    </script>
@endsection
