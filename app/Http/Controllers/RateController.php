<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateRequest;
use App\Models\Rate;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $rate = Rate::all();
        if (count($rate) > 0) {
            return response()->json(['rates' => $rate], 200);
        } else {
            return response()->json(['rates' => 'empty rate in this profile'], 400);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RateRequest $request)
    {

        $rate = new Rate($request->all());
        if (!Rate::where('user_id', $rate->user_id)->exists()) {
            $rate->user_id = Auth::user()->id;
            if ($rate->save()) {
                return response()->json('success', 201);
            } else {
                return response()->json('faild', 400);
            }
        } else {
            abort("503", " This user has already rated ! ");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show(Rate $rate)
    {
        if ($rate) {
            return response()->json(['data' => $rate], 200);
        } else
            return response()->json(['data' => 'not found this id rate'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rate $rate)
    {
        $status = $rate->update($request->all());
        if ($status) {
            return response()->json(['message' => 'success for update', 'data' => $rate], 200);
        } else
            return response()->json(['data' => 'not found this id rate'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rate $rate)
    {
        $status = $rate->delete();
        if ($status == true) {
            return response()->json(['data' => 'success for delete'], 200);
        } else {
            return response()->json(['data' => 'faild for delete'], 400);
        }
    }
}
