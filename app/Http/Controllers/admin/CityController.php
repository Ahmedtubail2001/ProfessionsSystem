<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function elementEachPage()
    {
        return 20;
    }
    public function countNumRow($id)
    {
        // $specialty = specialties::count();
        $index = City::pluck('id')->search($id);
        return $index;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::paginate($this->elementEachPage());
        return view('cms.city.index')->with('cities', $cities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.city.create');
    }
    public function store(CityRequest $request, City $city)
    {
        $status = $city->create($request->all());
        return redirect()->back()->with('status', $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }
    public function edit(City $city)
    {

        return view('cms.city.edit')->with('city', $city);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, City $city)
    {
        $status = $city->update($request->all());
        $pageNum = ceil($this->countNumRow($city->id) / $this->elementEachPage());
        return redirect()->route('cities.index')->with(['statusEdit' => $status, 'id' => $city->id, 'pageNumber' => $pageNum]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $status = $city->delete();
        return redirect()->back()->with('status', $status);
    }
}
