<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function elementEachPage()
    {
        return 10;
    }
    // permission_id

    public function validat($request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'permission_id' => 'required',
                // |exists:permissions|numeric
            ],
            [
                'permission_id.required' => 'the permission id is required',
                // 'permission_id.exists' => 'the permission id is not exists in permission table',
                // 'permission_id.numeric' => ' the permission must be numeric',
            ]
        );
        return $validate;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($roleId)
    {
        // dd($roleId);
        $roles = Role::where('id', $roleId)->select('guard_name')->get();
        // dd($roles[0]->guard_name);
        $permissions = Permission::where('guard_name', $roles[0]->guard_name)
        ->select('*')->paginate($this->elementEachPage());
        $rolePermissions = Role::findOrFail($roleId)->permissions;
        if (count($rolePermissions) > 0) {
            foreach ($permissions as $permission) {
                $permission->setAttribute('assigned', false);
                foreach ($rolePermissions as $rolePermission) {
                    if ($permission->id == $rolePermission->id) {
                        $permission->assigned = true;
                    }
                }
            }
        }

        return view('cms.spatie.roles.role-permissions')->with(['role_id' => $roleId, 'permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $role_id)
    {
        $validator = $this->validat($request);
          ///
        if (!$validator->fails()) {
            $role = Role::findOrfail($role_id);
            $permission = Permission::findOrfail($request->permission_id);
            // model parametar
            if ($role->hasPermissionTo($permission)) {
                $role->revokePermissionTo($permission);
            } else {
                $role->givePermissionTo($permission);
            }
            return response()->json(['message' => 'Permission update successfully'], 200);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
