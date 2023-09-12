<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Database\Seeders\PermissionSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function elementEachPage()
    {
        return 10;
    }
    public function countNumRow($id)
    {
        # code...
        // $specialty = specialties::count();
        $index = Permission::pluck('id')->search($id);

        return $index;
    }

    public function validat($requests)
    {
        $validator = Validator::make(
            $requests->all(),
            [
                'name' => 'required|string',
                'guards' => 'required|in:web,admin,higher_admin|string',

            ],
            [
                'name.required' => 'the name of profession is required',
                'name.string' => 'the name of profession must be string',
                'guards.required' => 'the guard name of profession is required',
                'guards.string' => 'the guard name of profession must be string',
                'guards.in' => 'Take the gaurds not on the list',

            ]

        );
        return $validator;
    }

    public function create()
    {
        $this->authorize('create', Permission::class);
        return view('cms.spatie.permissions.create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Permission::class);

        $result = Permission::select("*")->paginate($this->elementEachPage());
        return view('cms.spatie.permissions.index')->with('permissions', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // check if the user has admin with store new permissions
        $this->authorize('create', Permission::class);
        // validate syntax of data send
        $validator = $this->validat($request);
        // $status = permission::create($request->all());
        //if validate success save the data if store in DB
        if (!$validator->fails()) {
            $permission = new Permission();
            $permission->name = $request['name'];
            $permission->guard_name = $request['guards'];
            $status = $permission->save();
            return response()->json(['message' => $status ? 'success for add new permission' : 'faild for add new permission'], $status ? 201 : 404);
        } else {
            // return get message error if fails validation
            return response()->json(['message' => $validator->getMessageBag()], 400);
        }
    }

    public function edit($id)
    {


        $permissions = Permission::findOrFail($id);
        $this->authorize('update', $permissions);
        return view('cms.spatie.permissions.edit')->with('permissions', $permissions);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $validator = $this->validat($request);
        if (!$validator->fails()) {
            $permission = Permission::findOrFail($id);
            $this->authorize('update',  $permission);
            $permission->name = $request['name'];
            $permission->guard_name = $request['guards'];
            $status = $permission->save();
            return response()->json(['message' => $status ? 'success for edit the permission' : 'faild for edit the permission'], $status ? 201 : 404);
        } else {
            return response()->json(['message' => $validator->getMessageBag()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $this->authorize('delete', $permission);
        $status = Permission::destroy($id);

        return response()->json(['message' => $status ? 'success for delete the permission' : 'faild for delete permission'], $status ? 201 : 404);
    }
}
