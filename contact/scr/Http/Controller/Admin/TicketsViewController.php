<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComplainResponse;
use Illuminate\Http\Request;
use App\Models\Complains;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;


class TicketsViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('change_password')->except('updatepassword');
    }
    /* All Ticket */
    public function ticket(Request $request)
    {
        if ($request->ajax()) {
            $data = Complains::select('*');
            return Datatables::of($data)
                ->editColumn('client_id', function ($row) {
                    return $row->client_data->name;
                })
                ->editColumn('project_id', function ($row) {
                    return $row->project_data->name;
                })
                ->editColumn('complain_category_id', function ($row) {
                    return $row->category_data->name;
                })
                // ->editColumn('closed_by', function ($row) {
                //     return $row->closed_by_data->name;
                //     })
                ->editColumn('file1', function ($row) {
                    $content = "<a href='" . asset($row->file1) . "' target='_blank'>View <i class='fa fa-file-pdf-o'></i></a>";
                    if ($row->file1 != '' && $row->file1 != null) {
                        return $content;
                    } else {
                        return "<small class='text-danger'>none</small>";
                    }
                })

                /* open the View and Edit*/
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . url('ticket/' . $row->id . '/edit') . '"><i class="fa fa-eye class="center""></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'file1'])
                ->make(true);
        }

        return view('admin.ticket');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|max:255',
            'project_id' => 'required|max:255',
            'complain_category_id' => 'required|max:255',
            'complain_subject' => 'required|max:255',
            'details' => 'required|max:255',
        ]);

        $ticket = Complains::findOrFail($id);
        $ticket->client_id = $request->name;
        $ticket->project_id = $request->email;
        $ticket->complain_category_id = $request->email;
        $ticket->complain_subject = $request->name;
        $ticket->details = $request->email;
        $ticket->updated_by = Auth::user()->id;
        $ticket->save();

        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $ticket_data = Complains::find($id);
        $responses = ComplainResponse::where("complain_id", $id)->get();

        return view('admin.tickets.ticketview', compact('ticket_data', 'responses'));
    }

    //update response message
    public function updateMessage(Request $request, $id)
    {
        $response = ComplainResponse::find($id);
        $response->respond_txt = $request->input('respond_txt');
        $response->save();

        return redirect()->route('ticket.edit', ['id' => $response->complain_id]);
    }


    //file upload, and storage of a complain response
    public function creatMessage(Request $request)
    {
        $validateData = $request->validate(
            [
                'file1' => 'mimes:pdf,jpg,png,jpeg,gif|max:2048',
                'respond_txt' => 'required',
            ],
            [
                'file1.mimes' => 'You can upload only one of these formats:pdf,jpg,png,jpeg,gif',
                'respond_txt.required' => 'You have to provide deatails',
            ]
        );

        if ($request->hasFile('file1')) {
            $file = $request->file('file1');
            $extension = $file->getClientOriginalExtension();
            $file_name = time() . '_m2c.' . $extension;
            $file->move(public_path('uploads/responses/'), $file_name);
            $path = "uploads/responses/$file_name";
        } else {
            $path = null;
        }
        $data = new ComplainResponse;
        $data->client_id = $request->client_id;
        $data->respond_txt = $request->respond_txt;
        $data->complain_id = $request->complain_id;
        $data->file1 = $path;

        $data->user_id = Auth::user()->id;
        $data->respond_direction = "m2c";


        $data->save();
        return redirect()->back();
    }

    //edit response message
    public function editMessage(Request $request, $id)
    {
        $response = ComplainResponse::find($id);
        return view('admin.tickets.edit-message', compact('response'));
    }


    public function updatePriority(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'priority' => 'required|in:High,Normal,Low',
            'status_remark' => 'required|string|max:255',
        ]);

        // Find the ticket by ID
        $ticket = Complains::find($id);

        if (!$ticket) {
            // Handle the case where the ticket is not found
            return response()->json(['error' => 'Ticket not found'], 404);
        }

        // Store the old priority
        $oldPriority = $ticket->priority;

        // Update the ticket's priority
        $ticket->priority = $validatedData['priority'];
        $ticket->save();

        // Create the update message
        $updateMsg = auth()->user()->name . " updated the ticket priority from $oldPriority to $ticket->priority";
        // Append the message if provided
        if (!empty($request->status_remark)) {
            $updateMsg .= "\n\nRemarks: " . $request->status_remark;
        }

        // Create a new ComplainResponse
        ComplainResponse::create([
            'complain_id' => $id,
            'priority' => $ticket->priority,
            'respond_txt' => $updateMsg,
            'client_id' => $ticket->client_id,
            'user_id' => auth()->user()->id,
            'respond_direction' => "m2c",
            'file1' => null
        ]);

        return redirect()->back()->with('success', 'Priority updated successfully');
    }


    public function updateStatus(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'status' => 'required|in:Open,Close',
            'status_remark' => 'required|string',
        ]);

        // Find the ticket by ID
        $ticket = Complains::find($id);

        if (!$ticket) {
            // Handle the case where the ticket is not found
            return response()->json(['error' => 'Ticket not found'], 404);
        }

        // Store the old status
        $oldStatus = $ticket->status;

        // Update the ticket's status and save it
        $ticket->status = $validatedData['status'];
        $ticket->save();

        // Create the update message
        $updateMsg = auth()->user()->name . " updated the ticket status from $oldStatus to $ticket->status <br>";

        // Append the remark if provided
        if (!empty($request->status_remark)) {
            $updateMsg .= "<b>Remarks:</b>   <br>" . $request->status_remark;

            // Create a new ComplainResponse
            ComplainResponse::create([
                'complain_id' => $id,
                'status' => $ticket->status,
                'respond_txt' => $updateMsg,
                'client_id' => $ticket->client_id,
                'user_id' => auth()->user()->id,
                'respond_direction' => "m2c",
                'file1' => null
            ]);
            return redirect()->back();
        } else {
            // Return back with an error message if remark is not provided
            return redirect()->back()->withErrors(['error' => 'Please enter a remark before updating the status']);
        }
    }

    /* To View opened ticketsonly  (This sis not Opening function)*/
    public function open_ticket(Request $request)
    {
        if ($request->ajax()) {
            $data = Complains::where('status', '=', 'Open')->get();
            return Datatables::of($data)
                ->editColumn('client_id', function ($row) {
                    return $row->client_data->name;
                })
                ->editColumn('project_id', function ($row) {
                    return $row->project_data->name;
                })
                ->editColumn('complain_category_id', function ($row) {
                    return $row->category_data->name;
                })
                ->editColumn('file1', function ($row) {
                    $content = "<a href='" . asset($row->file1) . "' target='_blank'>View <i class='fa fa-file-pdf-o'></i></a>";
                    if ($row->file1 != '' && $row->file1 != null) {
                        return $content;
                    } else {
                        return "<small class='text-danger'>none</small>";
                    }
                })

                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . url('ticket/' . $row->id . '/edit') . '"><i class="fa fa-eye class="center""></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'file1'])
                ->make(true);
        }
        return view('admin.tickets.open_ticket');
    }
    /* To view closed ticketsonly  (This sis not closing function)*/
    public function close_ticket(Request $request)
    {
        if ($request->ajax()) {
            $data = Complains::where('status', '=', 'Close')->get();
            return Datatables::of($data)
                ->editColumn('client_id', function ($row) {
                    return $row->client_data->name;
                })
                ->editColumn('project_id', function ($row) {
                    return $row->project_data->name;
                })
                ->editColumn('complain_category_id', function ($row) {
                    return $row->category_data->name;
                })
                ->editColumn('file1', function ($row) {
                    $content = "<a href='" . asset($row->file1) . "' target='_blank'>View <i class='fa fa-file-pdf-o'></i></a>";
                    if ($row->file1 != '' && $row->file1 != null) {
                        return $content;
                    } else {
                        return "<small class='text-danger'>none</small>";
                    }
                })

                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . url('ticket/' . $row->id . '/edit') . '"><i class="fa fa-eye class="center""></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'file1'])
                ->make(true);
        }
        return view('admin.tickets.close_ticket');
    }
}
