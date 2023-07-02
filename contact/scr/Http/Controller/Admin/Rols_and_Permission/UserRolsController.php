<?php

namespace App\Http\Controllers\Admin\Rols_and_Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class UserRolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('change_password')->except('updatepassword');
    }
    public function user_control(Request $request)
    {
        if (!auth()->user()->can('Roles View Any')) {
            abort(403, 'Unauthorized action.');
        }
        if ($request->ajax()) {
            $data = User::select('*');
            return datatables()::of($data)
                ->editColumn('role_id', function ($row) {
                    $role = DB::table('roles')
                        ->where('id', $row->role_id)
                        ->pluck('name')
                        ->first();
                    return $role;
                })

                ->addColumn('action', function ($row) {
                    $btn = '';
                    // delete
                    if (auth()->user()->can('Roles Delete')) {
                        $btn .= '<button class="btn btn-danger btn-sm m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="' . __('Delete User') . '"
                                 onclick="DeleteRep(\'' . $row->id . '\')"><i class="fa fa-trash"></i></button> </div> ';
                    }
                    // edit
                    if (auth()->user()->can('Roles Edit')) {
                        $btn .= '<a href="' . url('user_control/' . $row->id . '/edit') . '"> 
                                 <i class="edit btn btn-primary btn-sm m-1" ><i class="fa fa-edit"></i></a>';
                    }
                    return $btn;
                })

                ->addColumn('roles', function ($user) {
                    $roles = $user->getRoleNames();
                    $taggedRoles = '';
                    foreach ($roles as $role) {
                        $taggedRoles .= '<span class="tag">' . $role . '</span> ';
                    }
                    return $taggedRoles;
                })
                ->rawColumns(['action', 'roles'])
                ->make(true);
        }
        return view('admin.rols_and_permission.user_control');
    }

    /*create new user */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->website = $request->website;
        $user->avatar = $request->avatar;
        $user->full_name = $request->full_name;
        $user->date_of_birth = $request->date_of_birth;
        $user->designation = $request->designation;


        $tempPassword = Str::random(8);

        $user->password = bcrypt($tempPassword);
        $user->change_password = false;

        $user->save();
        $user->assignRole([$request->role_name]);
        $mailData = [
            'title' => 'Your Temporary Password',
            'tempPassword' => $tempPassword,
            'url' => route('change_password', ['id' => $user->id]),
        ];

        Mail::to($request->email)->send(new Email($mailData));

        return redirect()->route('user_control');
    }

    public function new_user()
    {
        // $this->authorize('Roles Create');
        $all_roles_in_database = Role::all();
        return view('admin.rols_and_permission.new_user', compact('all_roles_in_database'));
    }
    public function deleteRequest($id)
    {
        $delete = User::find($id);
        $delete->delete();
        return response()->json();
    }

    public function edituser($id)
    {
        $user = User::find($id);

        // Check if the user has the "Roles Edit" permission
        if (!$user->hasPermissionTo('Roles Edit')) {
            // Display the 403 error page
            abort(403, 'Unauthorized action.');
        }

        $all_roles_in_database = Role::all();
        $user_roles = $user->getRoleNames();
        $unassigned_roles = Role::whereNotIn('id', $user->roles()->pluck('id')->toArray())->get();
        return view('admin.rols_and_permission.edit_new_user', compact('all_roles_in_database', 'user_roles', 'unassigned_roles', 'user'));
    }

    public function updateuser(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->role_id = $request->role_id;

        $user->save();
        return redirect()->back();
    }

    /*Remove Roles*/
    public function remove_role($id, $role)
    {
        $user = User::find($id);
        $user->removeRole($role);
        return redirect()->route('user_control.edit', $id);
    }

    /*Add Roles */
    public function add_role(Request $request, $id)
    {
        $user = User::find($id);
        $user->getRoleNames();
        $user->assignRole($request->role);
        return redirect()->route('user_control.edit', $id);
    }

    /*Change password Mailtarp */
    public function change_password($id)
    {
        
        $data = User::findOrFail($id);
        return view('admin.rols_and_permission.change_password', compact('data'));
    }


    /*Update password Mailtarp*/
    public function updatepassword(Request $request, $id)
    {
        $validated = $request->validate([
            'new_password' => [
                'nullable',
                'min:8',
                'confirmed',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value && !password_verify($request->password, Auth::user()->password)) {
                        $fail(__('Current password is not correct'));
                    }
                },
            ],
        ], [
                'new_password.min' => __('Password should be a minimum of 8 characters'),
                'new_password.confirmed' => __('Please make sure to confirm the new password'),
            ]);

        $user = User::findOrFail($id);

        if (password_verify($request->password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->change_password = true;
            $user->save();

            // Save the new password in a variable
            $newPassword = $request->new_password;

            // Update the mailData array with the new password
            $mailData = [
                'title' => 'Your Temporary Password',
                'tempPassword' => $newPassword,
                'url' => route('change_password', ['id' => $user->id]),
            ];

            Mail::to($user->email)->send(new Email($mailData));

            $notification = [
                'alert_type' => 'success',
                'message2' => __('Password updated successfully!'),
                'title' => __('Password updated successfully!'),
            ];
            Log::info($notification);
            return response()->json($notification);
        } else {
            $notification = [
                'alert_type' => 'error',
                'message2' => __('Current password is not correct'),
                'title' => __('Current password is not correct'),
            ];

            return response()->json($notification);
        }
    }

}