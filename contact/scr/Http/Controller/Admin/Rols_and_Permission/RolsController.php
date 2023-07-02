<?php

namespace App\Http\Controllers\Admin\Rols_and_Permission;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth', 'change_password']);
    }

    public function new_role()
    {
        $all_permissions_in_database = Permission::all();

        return view('admin.rols_and_permission.new_role', compact('all_permissions_in_database'));
    }

    public function rols_control(Request $request)
    {
        if (!auth()->user()->can('Roles View Any')) {
            abort(403, 'Unauthorized action.');
        }
        if ($request->ajax()) {
            $data = DB::table('roles')->get();
            return datatables()::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . url('rols_control/' . $row->id . '/') . '"><i class="fa fa-eye class="center"></i></a>';
                    return $btn;
                })

                ->addColumn('permissions', function ($row) {
                    $permissions = DB::table('role_has_permissions')
                        ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                        ->where('role_has_permissions.role_id', $row->id)
                        ->pluck('permissions.name')
                        ->toArray();
                    return implode(', ', $permissions);
                })

                ->addColumn('action', function ($row) {
                    $btn = '';

                    //show/
                    if (auth()->user()->can('Roles View')) {
                        $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-bs-toggle="tooltip" data-bs-placement="top"  title="' . __('Show Role Details') . '" class="btn btn-blue fa fa-eye btn-sm m-1 ShowRoleRequest"></a>';
                    }

                    //delete
                    if (auth()->user()->can('Roles Delete')) {
                        $btn .= '<button  class="btn btn-danger btn-sm m-1" data-bs-toggle="tooltip" data-bs-placement="top"  title="' . __('Delete Role') . '"
                    onclick="DeleteRep(\'' . $row->id . '\')"><i class="fa fa-trash"></i></button> </div> ';
                    }

                    // edit
                    // if (auth()->user()->can('Roles Edit')) {
                    $btn .= '<a href="' . url('rols_control/' . $row->id . '/edit_permission') . '"> 
                    <i class="edit btn btn-primary btn-sm m-1" ><i class="fa fa-edit"></i></a>';
                    // }

                    return $btn;
                })
               

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.rols_and_permission.rols_control');
    }

    public function showrole(Request $request, $id)
    {
        $role = DB::table('roles')->find($id);
        return response()->json($role);
    }

    public function delete($id)
    {
        $deleted = DB::table('roles')->where('id', $id)->delete();
        return response()->json();
    }

    public function editrole(Request $request, $id)
    {
        $role = Role::find($id);
        return view('admin.rols_and_permission.rols_control', compact('role'));
    }

    public function storerole(Request $request)
    {
        $role = new Role();
        $role->name = $request->role_name;
        $role->save();

        $role->givePermissionTo($request->permission_name);
        return redirect()->route('rols_control');
    }


    /*
    edit the permission 
    */
    public function edit_permission($id)
    {
        // Auth::user()->hasPermissionTo('Edit Roles') ? true : abort(403);
        Auth::user()->hasAnyPermission(['Role Manager', 'Roles View Any', 'Roles View', 'Roles Edit', 'Roles Delete', 'Roles Create']) ? true : abort(403);
        $role = Role::find($id);
        $all_permissions_in_database = Permission::all();

        $role_permission = $role->getPermissionNames();
        $unassigned_permissions  = Permission::whereNotIn('id', $role->permissions()->pluck('id')->toArray())->get();
        return view('admin.rols_and_permission.edit_new_permission', compact('all_permissions_in_database', 'role_permission', 'unassigned_permissions', 'role'));
    }

    public function updaterole(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->role;
        $role->save();
        return redirect()->back();
    }
    /*
    Remove permission 
    */
    public function remove_permission($id, $role)
    {
        $user = Role::find($id);
        $user->revokePermissionTo($role);
        return redirect()->route('rols_control.edit_permission', $id);
    }
    /*
    Add permission 
    */
    public function add_permission(Request $request, $id)
    {
        $user = Role::find($id);
        $user->getPermissionNames();
        $user->givePermissionTo($request->permission);
        return redirect()->route('rols_control.edit_permission', $id);
    }
}
