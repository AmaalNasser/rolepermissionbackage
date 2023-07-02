<?php

namespace App\Http\Controllers\Admin;

use Yajra\DataTables\Facades\DataTables;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use Illuminate\Http\Request;

class ClientControlController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'change_password']);
    }
    public function client_control(Request $request)
    {
        if ($request->ajax()) {
            $clients = Clients::select(['id', 'name', 'status'])->get();

            return DataTables::of($clients)
                ->addColumn('action', function ($client) {
                    $editUrl = route('clients.edit', $client->id);
                    $deleteUrl = route('clients.delete', $client->id);

                    $btn = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="' . __('Edit Client Details') . '"><i class="fa fa-edit"></i></a>';

                    $btn .= '<button class="btn btn-danger btn-sm m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="' . __('Delete Client') . '" onclick="deleteClient(' . $client->id . ')"><i class="fa fa-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.client_control');
    }
    public function new_client()
    {
        $client = new Clients(); // Create an empty client object
        return view('admin.new_client', compact('client'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'contact_name_1' => 'required|string',
            'contact_name_2' => 'required|string',
            'email1' => 'required|email',
            'email2' => 'required|email',
            'phone1' => 'required|string',
            'phone2' => 'required|string',
            'description' => 'required|string',
            'contract' => 'nullable|file',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string',
        ]);

        $client = new Clients();
        $client->name = $validatedData['name'];
        $client->contact_name_1 = $validatedData['contact_name_1'];
        $client->email_1 = $validatedData['email1'];
        $client->phone_1 = $validatedData['phone1'];
        $client->contact_name_2 = $validatedData['contact_name_2'];
        $client->email_2 = $validatedData['email2'];
        $client->phone_2 = $validatedData['phone2'];
        $client->description = $validatedData['description'];
        $client->status = $validatedData['status'];
        $client->notes = $validatedData['notes'];

        // Handle uploading the contract if provided
        if ($request->hasFile('contract')) {
            $contractPath = $request->file('contract')->store('contracts');
            $client->contract = $contractPath;
        }

        $client->save();

        return redirect()->route('client_control')->with('success', 'Client created successfully.');
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'contact_name_1' => 'required|string',
            'contact_name_2' => 'required|string',
            'email_1' => 'required|email',
            'email_2' => 'required|email',
            'phone_1' => 'required|string',
            'phone_2' => 'required|string',
            'description' => 'required|string',
            'contract' => 'nullable|file',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string',
        ]);
        $client = Clients::findOrFail($id);
        $client->name = $validatedData['name'];
        $client->contact_name_1 = $validatedData['contact_name_1'];
        $client->contact_name_2 = $validatedData['contact_name_2'];
        $client->email_1 = $validatedData['email_1'];
        $client->email_2 = $validatedData['email_2'];
        $client->phone_1 = $validatedData['phone_1'];
        $client->phone_2 = $validatedData['phone_2'];
        $client->description = $validatedData['description'];
        $client->status = $validatedData['status'];
        $client->notes = $validatedData['notes'];

        // Handle updating the contract if necessary
        if ($request->hasFile('contract')) {
            $contractPath = $request->file('contract')->store('contracts');
            $client->contract = $contractPath;
        }

        $client->save();

        return redirect()->route('client_control')->with('success', 'Client updated successfully.');
    }
    public function destroy($id)
    {
        $client = Clients::findOrFail($id);
        $client->delete();

        return response()->json(['success' => true]);
    }
    public function show($id)
    {
        $client = Clients::findOrFail($id);
        return view('admin.client_show', compact('client'));
    }
    public function edit($id)
    {
        $client = Clients::findOrFail($id);

        return view('admin.client_show', compact('client'));
    }
}
