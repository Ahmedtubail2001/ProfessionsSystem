<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequestSpecialties;
use App\Models\specialties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpecialtiesController extends Controller
{
    // public function __construct()
    // {
    //     //بشرط أن تتحول كل ال parametar لمودل
    //     $this->authorize(specialties::class, 'speciality');
    // }
    public function elementEachPage()
    {
        return 10;
    }
    public function countNumRow($id)
    {

        // $specialty = specialties::count();
        $index = specialties::pluck('id')->search($id);

        return $index;
    }

    public function validat($requests)
    {
        $validator = Validator::make(
            $requests->all(),
            [
                'title' => 'required|string|min:3|max:44',
                'active' => 'boolean'
            ],
            [
                'title.required' => 'the title required',
                'title.string' => 'the title must be string',
                'title.min' => 'too short at least 3 character',
                'title.max' => 'too long at more 44 character',
                // 'active.required' => 'the active is required',
                'active.boolean' => 'the active must boolean'
            ]

        );
        return $validator;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', specialties::class);
        return view('cms.specialties.create');
    }
    public function index()
    {
        $this->authorize('viewAny', specialties::class);

        // $result = specialties::with('profession')->whereHas('profession', function (Builder $query) {
        //     $query->where('allow_register', 1);
        // })->get();
        $result = specialties::select("*")->paginate($this->elementEachPage());

        return view('cms.specialties.index')->with('speciality', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, specialties $specialty)
    {
        $this->authorize('create', specialties::class);

        $validator = $this->validat($request);
        if ($validator->fails()) {
            return redirect('admin/specialities/create')
                ->withErrors($validator)
                ->withInput();
        }

        $stat = $specialty::create($request->all());
        return redirect()->back()->with('stat', $stat);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\specialties  $specialties
     * @return \Illuminate\Http\Response
     */
    public function show(specialties $specialty)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\specialties  $specialties
     * @return \Illuminate\Http\Response
     */
    public function edit($specialty)
    {


        $specialty = specialties::findOrFail($specialty);
        $this->authorize('update',  $specialty);
        return response()->view('cms.specialties.edit', ['specialty' => $specialty]);
    }

    public function update(Request $request, $specialty)
    {

        $validator = $this->validat($request);
        if ($validator->fails()) {
            return redirect('/admin/specialities/' . $specialty . '/edit')
                ->withErrors($validator)
                ->withInput();
        }
        $specialty = specialties::findOrFail($specialty);
        $this->authorize('update', $specialty);
        $status = $specialty->update($request->all());
        // return redirect()->back()->with('status', $status);
        $pageNum = ceil($this->countNumRow($specialty->id) / $this->elementEachPage());
        return redirect()->route('specialities.index')->with(['statusEdit' => $status, 'id' => $specialty->id, 'pageNumber' => $pageNum]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\specialties  $specialties
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialties = specialties::findOrFail($id);
        $this->authorize('delete', $specialties);
        $state = specialties::where('id', $id)->delete();
        return redirect()->back()->with('state', $state);
    }

    public function index_restore()
    {

        $this->authorize('viewAny', specialties::class);

        $state = specialties::onlyTrashed()->paginate(10);

        // dd($state)->toArray();

        return view('cms.specialties.restore_index')->with('speciality', $state);
    }

    public function restore($id)
    {
        $specialties = specialties::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $specialties);

        $state = specialties::where('id', $id)->restore();
        return redirect()->back()->with('status', $state);
    }
}
