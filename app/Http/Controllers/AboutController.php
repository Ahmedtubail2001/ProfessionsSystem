<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostAboutRequest;
use App\Models\About;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use resources\lang\ar\message;


class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        // ->only('index');
        //->except('');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $header = About::select('id', 'name', 'title', 'description', 'image')->where("name", "header")->first();
        $about_us = About::select('id', 'name', 'title', 'description', 'image')->where("name", "about_us")->first();
        // $header->image = Storage::url($header->image);
        // $about_us->image = Storage::url($about_us->image);

        // $structure_language_ar = [
        //     "about" => trans('message.about'),
        //     "header" => trans('message.header'),
        //     "career guide" => trans('message.career_guide'),
        // ];

        // $structure_language_ar = [
        //     "about" => trans('message.about'),
        //     "header" => trans('message.header'),
        //     "career guide" => trans('message.career_guide'),
        // ];

        return response()->json([
            "header" => $header,
            "about_us" => $about_us,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostAboutRequest $request)
    {
        // 

        // $request->validate([
        //     'name' => 'required|string|min:3|max:15',
        //     'title' => 'required|string|min:3|max:15'
        // ]);
        // if ($request->user()->tokenCan('abouts.create')) {
        //     abort('403', 'not allow');
        // }
        $rules = [
            'title' => 'required|string',
            'image' => 'required'

        ];

        // $validator = Validator::make($request->all(), $rules);
        // $request->validate();

        $image = $request->file('image');
        // ->store('images');
        $path = "project_img/img_about/";
        $name = time() + rand(1, 1000) . "." . $image->getClientOriginalExtension();
        Storage::disk('public')->put($path . $name,  file_get_contents($image));

        $about = new About();
        $about->name = $request['name'];
        $about->title = $request['title'];
        $about->description = $request['description'];
        $about->image = $path . $name;
        $request = $about->save();
        // if ($validator->failed()) {
        // }
        return response()->json([
            "message" => "The about have been successfully stored",
            "about_save" => $request

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //deleted all
        // About::truncate();
        $news = About::findOrFail($about->id);
        // $image_path = app_path("project_img/img_about/{$news->image}");

        // if (File::exists($image_path)) {
        //     //File::delete($image_path);
        //     unlink($image_path);
        // }$news->image
        Storage::disk('public')->delete($news->image);
        // $news->delete();
        $news->delete();
        return response()->json([
            "message" => "The form has been deleted "
        ], 200);
    }
}
