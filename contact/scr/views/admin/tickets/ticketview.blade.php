@extends('admin.layouts.dashboard')
@inject('carbon', 'Carbon\Carbon')


@section('header')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.datatales.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
@endsection


@section('content')
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <h1 class="page-title"></h1>

            {{-- Customer Details --}}
            <div class="page-header">
                <h1 class="page-title">Ticket View</h1>
            </div>
            <!-- PAGE-HEADER END -->
            <!-- ROW-1 -->
            <div class="row">

                <div class="col-4">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Ticket Details</h4>
                            <dl class="row">
                                <dt class="col-sm-6">{{ __('Ticket ID') }}</dt>
                                <dd class="col-sm-6" style="text-align: end">{{ $ticket_data->id }}</dd>
                                {{-- Status --}}
                                <dt class="col-sm-6">{{ 'Status' }}</dt>
                                <dd class="col-sm-6" style="text-align: end">
                                    <span id="status_display">
                                        @if ($ticket_data->status == 'Open')
                                            <span style="color: green;">{{ $ticket_data->status }}</span>
                                        @else
                                            <span style="color: red;">{{ $ticket_data->status }}</span>
                                        @endif
                                    </span>
                                    <button id="edit_status_btn" class="btn btn-primary btn-sm ms-2"
                                        onclick="toggleStatusEdit()">
                                        <span id="status_text">Update</span>
                                    </button>
                                </dd>

                                <div id="status_form" style="display: none;">
                                    <form method="POST" action="{{ route('update_status', $ticket_data->id) }}">
                                        @csrf
                                        <div class="form-group">
                                            <select class="form-control" id="status" name="status">
                                                @if ($ticket_data->status == 'Open')
                                                    <option value="Close">Close</option>
                                                @else
                                                    <option value="Open">Open</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status_remark">Remarks:</label>
                                            <textarea class="form-control" id="status_remark" name="status_remark" rows="2" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>




                                {{-- closed At --}}
                                @if ($ticket_data->closed_at)
                                    <?php
                                    $date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ticket_data->closed_at);
                                    $closed_at = $date->format('Y-m-d H:i:s');
                                    ?>
                                    <div class="row align-items-center">
                                        <div class="col-sm-6">
                                            <dt><strong>{{ __('Closed at') }}</strong></dt>
                                        </div>
                                        <div class="col-sm-6" style="text-align: end; font-size: .875em;">
                                            <dd>{{ $closed_at }}</dd>
                                        </div>
                                    </div>
                                @endif
                                {{-- closed By --}}
                                <dt class="col-sm-6">{{ __('Closed by') }}</dt>
                                @if ($ticket_data->closed_by)
                                    <dd class="col-sm-6" style="text-align: end">
                                        {{ $ticket_data->user_data->name }}
                                    </dd>
                                @else
                                    <dd class="col-sm-6" style="text-align: end">-</dd>
                                @endif

                                <dt class="col-sm-6">{{ __('Created at') }}</dt>
                                <dd class="col-sm-6" style="text-align: end; font-size: .875em;">
                                    {{ $ticket_data->created_at }}</dd>
                                <dt class="col-sm-6">{{ __('Updated at') }}</dt>

                                @if ($responses == false)
                                    <dd class="col-sm-6" style="text-align: end; font-size: .875em;"> No Responses Yet
                                    </dd>
                                @elseif($responses->last() == null)
                                    <dd class="col-sm-6" style="text-align: end; font-size: .875em;"> No Responses Yet
                                    </dd>
                                @else
                                    <dd class="col-sm-6" style="text-align: end; font-size: .875em;">
                                        {{ $responses->last()->updated_at }} </dd>
                                @endif

                                <dt class="col-sm-6">{{ __('Last update') }}</dt>
                                <dd class="col-sm-6" style="text-align: end">{{ $ticket_data->client_data->name }}</dd>

                                <dt class="col-sm-6">{{ __('Complain Category') }}</dt>
                                <dd class="col-sm-6" style="text-align: end">{{ $ticket_data->category_data->name }}
                                </dd>

                                <dt class="col-sm-6">{{ __('Number of Replies') }}</dt>
                                {{-- <dd class="col-sm-6" style="text-align: end">{{ $ticket_data->id }}</dd> --}}

                                @php $count = 0; @endphp
                                @foreach ($responses as $response)
                                    {{-- Increment the count variable for each reply --}}
                                    @php $count++; @endphp
                                @endforeach
                                <dd class="col-sm-6" style="text-align: end"> {{ $count }}</dd>
                                {{-- Priority --}}
                                <dt class="col-sm-6">{{ 'Priority' }}</dt>
                                <dd class="col-sm-6" style="text-align: end">
                                    <span id="priority_display">
                                        @if ($ticket_data->priority == 'High')
                                            <span style="color: red;">{{ $ticket_data->priority }}</span>
                                        @elseif($ticket_data->priority == 'Normal')
                                            <span style="color: green;">{{ $ticket_data->priority }}</span>
                                        @elseif($ticket_data->priority == 'Low')
                                            <span style="color: blue;">{{ $ticket_data->priority }}</span>
                                        @endif
                                    </span>
                                    <button id="edit_priority_btn" class="btn btn-primary btn-sm ms-2"
                                        onclick="togglePriorityEdit()">
                                        <span id="priority_text">Edit Priority </span>
                                    </button>
                                </dd>
                                <form id="priority_form" method="POST"
                                    action="{{ route('update_priority', $ticket_data->id) }}" style="display: none;">
                                    @csrf
                                    <select class="form-control" name="priority">
                                        @if ($ticket_data->priority == 'High')
                                            <option value="Normal">Normal</option>
                                            <option value="Low">Low</option>
                                        @elseif ($ticket_data->priority == 'Normal')
                                            <option value="High">High</option>
                                            <option value="Low">Low</option>
                                        @elseif ($ticket_data->priority == 'Low')
                                            <option value="High">High</option>
                                            <option value="Normal">Normal</option>
                                        @endif
                                    </select>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-8">{{ __('Remarks:') }}</label>
                                        <textarea class="form-control" id="textAreaExample5" name="status_remark" rows="2" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm ms-2">
                                        Update
                                    </button>
                                </form>


                            </dl>
                        </div>
                    </div>
                </div>
                {{-- Complain Details --}}
                <div class="col-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="card text-left">
                                <div class="card-body">

                                    <dd class="col-sm-12" style="text-align:  end; font-size: .875em;">
                                        {{ $ticket_data['created_at']->hour }} hrs ago </dd>

                                    <h4 class="card-title">Complain Details</h4>
                                    <dl class="row">
                                        <dt class="col-sm-6">{{ __('Name:') }}</dt>
                                        <dd class="col-sm-6" style="text-align: end">
                                            {{ $ticket_data->client_data->name }}
                                        </dd>

                                        <dt class="col-sm-6">{{ __('complain subject:') }}</dt>
                                        <dd class="col-sm-6" style="text-align: end">
                                            {{ $ticket_data->complain_subject }}</dd>

                                        <dt class="col-sm-6">{{ __('Description:') }}</dt>
                                        <dd class="col-sm-6" style="text-align: end">{{ $ticket_data->details }}</dd>

                                        <dt class="col-sm-6">{{ __('Attachments:') }}</dt>
                                        <div class="col-3">
                                            @if ($ticket_data->file1 != null)
                                                <a href="{{ asset($ticket_data->file1) }}" target="_blank">
                                                    <small class="text-danger">View Attachment</small>
                                                </a>
                                            @else
                                                <small class="text-danger">none</small>
                                            @endif
                                        </div>
                                    </dl>

                                </div>
                            </div>
                            {{-- responses Set as clos, Re-open,edit proprity --}}


                            @foreach ($responses as $response)
                                <div class="col-12"></div>
                                <div class="col-12">
                                    <div
                                        class="card 
                                    @if ($response->respond_direction == 'c2m') bg-primary-transparent @endif">
                                        <div class="card-body">
                                            <dl class="row">
                                                <dd class="col-sm-6" style="font-size: .875em;">
                                                    {{ $response['created_at']->format('Y-m-d H:i:s') }}
                                                </dd>
                                                <dd class="col-sm-6" style="text-align: end; font-size: .875em;">
                                                    {{ $response['created_at']->diffForHumans() }}
                                                </dd>

                                                <dt class="col-sm-6">{{ __('Replied By:') }}</dt>
                                                @if ($response->respond_direction == 'c2m')
                                                    <dd class="col-sm-6" style="text-align: end">
                                                        {{ $response->client_data->name }} - <span class="text-muted"
                                                            style="font-size: smaller; font-style: italic;">({{ $response->email }})</span>
                                                    </dd>
                                                @else
                                                    <dd class="col-sm-6" style="text-align: end">
                                                        {{ Auth::user()->name }}
                                                    </dd>
                                                @endif

                                                <dt class="col-sm-3">{{ __('Message:') }}</dt>
                                                <dd class="col-sm-9">{!! $response->respond_txt !!}</dd>

                                                <dt class="col-sm-6">{{ __('Attachments:') }}</dt>

                                                @php $count = '0'; @endphp

                                                @for ($i = 1; $i <= 4; $i++)
                                                    @if ($response['file' . $i] != null)
                                                        <div class="col-3">
                                                            <a href="{{ asset($response['file' . $i]) }}"
                                                                target="_blank">
                                                                <small class="text-danger">View Attachment
                                                                    {{ $i }}</small>
                                                            </a>
                                                            @php $count++ @endphp
                                                        </div>
                                                    @endif
                                                @endfor

                                                @if ($count == 0)
                                                    <small class="text-danger">none</small>
                                                @endif

                                                {{-- Edit Message --}}
                                                <div class="col-12 text-end mt-3">
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('ticket.edit-message', ['id' => $response->id]) }}">Edit
                                                        Message</a>
                                                </div>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            @endforeach



                            {{-- form to add the replay --}}
                            <div class="col-12">
                                <div class="card text-left">
                                    <div class="card-body">
                                        <form action="{{ route('messageticket') }}" method="Post"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <h4 class="card-title">{{ __('Add a reply') }}</h4>
                                            <div class="form-outline mb-4">
                                                <div class="form-group">
                                                    <label class="col-sm-6">{{ __('The Message:') }}</label>
                                                    <textarea class="form-control" id="textAreaExample5" name="respond_txt" rows="3"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="file1" class="form-label">{{ __('Attchements:') }}
                                                    </label>
                                                    <input class="form-control form-control-sm" name="file1"
                                                        id="file1" type="file" />
                                                    <small class="text-muted">Max size 2 MB</small>
                                                </div>

                                                <div class="form-group">
                                                    <input type="hidden" id="client_id" name="client_id"
                                                        value="{{ $ticket_data->client_id }}" />
                                                    <input type="hidden" id="complain_id" name="complain_id"
                                                        value="{{ $ticket_data->id }}" />

                                                    <button type="submit"
                                                        class="btn btn-primary btn-sm">{{ __('Reply') }}</button>


                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ROW-1 END -->
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


    {{-- //blade (script) --}}
    <script type="text/javascript"></script>

    {{-- showPriorityForm --}}
    <script>
        function showPriorityForm() {
            var priorityDisplay = document.getElementById("priority_display");
            priorityDisplay.style.display = "none";
            var form = document.getElementById("priority_form");
            form.style.display = "block";
        }
    </script>

    {{-- //toggle Priority Edit --}}
    <script>
        function togglePriorityEdit() {
            var priorityDisplay = document.getElementById("priority_display");
            var editPriorityBtn = document.getElementById("edit_priority_btn");
            var priorityForm = document.getElementById("priority_form");

            if (priorityForm.style.display === "none") {
                priorityDisplay.style.display = "none";
                priorityForm.style.display = "block";
                editPriorityBtn.textContent = "Cancel";
            } else {
                priorityDisplay.style.display = "inline";
                priorityForm.style.display = "none";
                editPriorityBtn.textContent = "Edit Priority";
            }
        }
    </script>

    {{-- showStatusForm --}}
    <script>
        function showStatusForm() {
            var statusDisplay = document.getElementById("status_display");
            statusDisplay.style.display = "none";
            var form = document.getElementById("status_form");
            form.style.display = "block";
        }
    </script>

    {{-- toggle Status Edit --}}
    <script>
        function toggleStatusEdit() {
            var priorityDisplay = document.getElementById("priority_display");
            var editStatusBtn = document.getElementById("edit_status_btn");
            var statusForm = document.getElementById("status_form");

            if (statusForm.style.display === "none") {
                priorityDisplay.style.display = "none";
                statusForm.style.display = "block";
                editStatusBtn.textContent = "Cancel";
            } else {
                priorityDisplay.style.display = "inline";
                statusForm.style.display = "none";
                editStatusBtn.textContent = (priorityDisplay.textContent === "Open") ? "Close" : "Open";
            }
        }
    </script>
@endsection
