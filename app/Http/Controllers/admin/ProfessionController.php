<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostProfessionRequest;
use App\Models\Profession;
use App\Models\specialties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfessionController extends Controller
{
    public function elementEachPage()
    {
        return 10;
    }
    public function countNumRow($id)
    {
        # code...
        // $specialty = specialties::count();
        $index = Profession::pluck('id')->search($id);

        return $index;
    }
    public function validat($requests)
    {
        $validator = Validator::make(
            $requests->all(),
            [
                'title' => 'required|string',
                'description' => 'string|nullable',
                'allow_register' => 'boolean',
                'specialtie_id' => 'required|integer|min:1'
            ],
            [
                'title.required' => 'the title of profession is required',
                'title.string' => 'the title of profession must be string',
                'description.string' => 'the description of profession must be string',
                'allow_register.boolean' => 'the allow register of profession must be boolean',
                'specialtie_id.required' => 'the title of specialtie id is required',
                'specialtie_id.integer' => 'the title of specialtie id must be integer',
                'specialtie_id.min' => 'the specialtie id at laest 1'

            ]

        );
        return $validator;
    }

    public function create()
    {
        $result = specialties::select('id', 'title')->where('active', '!=', false)->get();
        return view('cms.profession.create')->with('specialty', $result);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate = 10;
        $result = Profession::with(['specialty' => function ($query) {
            $query->select('id', 'title');
        }])->select("*")->paginate($this->elementEachPage());
        // dd($result->toArray());
        return view('cms.profession.index')->with('professional', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Profession $professions)
    {
        $validator = $this->validat($request);
        if ($validator->fails()) {
            return redirect('admin/professional/create')
                ->withErrors($validator)
                ->withInput();
        }
        // dd($request->specialtie_id);

        $status = $professions::create($request->all());
        return redirect()->back()->with('status', $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //use slug 
        $profession = Profession::where('slug', $slug)
            ->firstOrFail();

        if ($profession) {
            return response()->json($profession, 200);
        } else {
            return response()->json(['message' => 'not find this profession '], 500);
        }
    }


    public function edit($id)
    {
        $profession = Profession::findOrFail($id);
        $result = specialties::select('id', 'title')->where('active', '!=', false)->get();
        $spec_id = $profession->specialtie_id;

        return view('cms.profession.edit')->with(['profession' => $profession, 'specialty' => $result, 'spec_id' => $spec_id]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $professional)
    {
        $validator = $this->validat($request);
        if ($validator->fails()) {
            return redirect('admin/professional/' . $professional . '/edit')
                ->withErrors($validator)
                ->withInput();
        }
        $profession = Profession::where('id', $professional)
            ->firstOrFail();
        $result = $profession->update(request()->all());
        //return number page  
        $pageNum = ceil($this->countNumRow($profession->id) / $this->elementEachPage());
        return redirect()->route('professional.index')->with(['statusEdit' => $result, 'id' => $profession->id, 'pageNumber' => $pageNum]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function destroy($professional)
    {
        $result = Profession::where('id', $professional)->delete();
        return redirect()->back()->with('status', $result);
    }

    public function index_restore()
    {
        $state = Profession::onlyTrashed()->paginate(10);

        // dd($state)->toArray();

        return view('cms.profession.restore_index')->with('professions', $state);
    }

    public function restore($id)
    {
        $state = Profession::where('id', $id)->restore();
        return redirect()->back()->with('status', $state);
    }
}
