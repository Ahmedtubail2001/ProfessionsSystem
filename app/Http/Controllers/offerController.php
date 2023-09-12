<?php

namespace App\Http\Controllers;

use App\Http\Requests\offerRequest;
use App\Models\Offer;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class offerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(offerRequest $request)
    {

        $offer = new Offer($request->all());
        $offer->user_id = Auth::user()->id;
        $offer->save();
        if ($offer) {
            return response()->json(['message' => $offer], 200);
        }
        return response()->json(['message' => 'faild to store offer'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
    public function update(Request $request, $slug)
    {
        $offer = Offer::where('slug', $slug)->first();
        $offer = $offer->update($request->all());
        if ($offer) {
            return response()->json(['message' => "success for edit the offer"], 200);
        }
        return response()->json(['message' => 'faild to update offer'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $status = Offer::where('slug', $slug)->delete();
        if (!$status) {
            return  response()->json(['message' => 'faild to delete the offer'], 400);
        }
        return  response()->json(['message' => 'success for delete the offer'], 200);
    }

    public function select_Offer(Request $request, $slug)
    {
        $validate = Validator::make(
            $request->all(),
            ['worker_id' => 'required|exists:workers,id'],
            [
                'worker_id.required' => "please enter worker id",
                'worker_id.exists' => 'this worker not exist ',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['message' => $validate->getMessageBag()->first()], 400);
        }
        $project = Project::where('slug', $slug)->first();
        $project->worker_id = $request['worker_id'];
        $status = $project->save();
        if (!$status) {
            return response()->json(['message' => 'register the offer not success'], 400);
        }
        return response()->json(['message' => 'success for register the worker offer'], 200);
    }
}
