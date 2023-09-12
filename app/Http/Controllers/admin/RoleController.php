<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role_has_permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function elementEachPage()
    {
        return 10;
    }
    public function countNumRow($id)
    {
        # code...
        // $specialty = specialties::count();
        $index = Admin::pluck('id')->search($id);

        return $index;
    }

    public function validat($requests)
    {
        $validator = Validator::make(
            $requests->all(),
            [
                'name' => 'required',
                'guards' => 'required|in:web,admin,higher_admin|string',

            ],
            [
                'name.required' => 'the name of profession is required',
                // 'name.string' => 'the name of profession must be string',
                'guards.required' => 'the guard name of profession is required',
                'guards.string' => 'the guard name of profession must be string',
                'guards.in' => 'Take the gaurds not on the list',

            ]

        );
        return $validator;
    }
    /**
     * Show the form for creating the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Role::class);

        return view('cms.spatie.roles.create');
    }

    public function index()
    {
        $this->authorize('create', Role::class);
        $result = Role::withCount('permissions')->paginate($this->elementEachPage());
        return view('cms.spatie.roles.index')->with('roles', $result);
    }

    /**
     * Store the newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Role::class);

        $validator = $this->validat($request);
        // $status = Role::create($request->all());
        ///////
        if (!$validator->fails()) {
            $role = new Role();
            $role->name = $request['name'];
            $role->guard_name = $request['guards'];
            $status = $role->save();
            return response()->json(['message' => $status ? 'success for add new role' : 'faild for add new role'], $status ? 201 : 404);
        } else {
            return response()->json(['message' => $validator->getMessageBag()], 400);
        }
    }

    /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $this->authorize('update', $role);
        return view('cms.spatie.roles.edit')->with('role', $role);
    }

    /**
     * Update the resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validat($request);
        if (!$validator->fails()) {
            $role = Role::findOrFail($id);
            $this->authorize('update',  $role);

            $role->name = $request['name'];
            $role->guard_name = $request['guards'];
            $status = $role->save();
            return response()->json(['message' => $status ? 'success for edit the role' : 'faild for edit the role'], $status ? 201 : 404);
        } else {
            return response()->json(['message' => $validator->getMessageBag()], 400);
        }
    }

    /**
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $this->authorize('delete', $role);
        $status = Role::destroy($id);
        $status = Role_has_permissions::where('role_id', $id)->delete();
        return response()->json(['message' => $status ? 'success for delete the role' : 'faild for delete role'], $status ? 201 : 404);
    }
}
