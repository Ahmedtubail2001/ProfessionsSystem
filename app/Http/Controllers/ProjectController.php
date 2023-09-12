<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostProjectRequest;
use App\Models\City;
use App\Models\Image;
use App\Models\Profession;
use App\Models\Project;
use App\Models\specialties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Filter local scope
        $projects = Project::with('worker')
            ->with('profession')
            ->with('profession.specialty')
            ->with('user')
            ->with('images')
            ->with('city')
            ->where('accept', true)
            ->latest('updated_at')
            ->paginate(20);
        if (!empty($projects) === 0) {
            return response()->json(['message' => 'empty projects !'], 400);
        }
        return response()->json(['message' => 'the projects is not empty', 'data' => $projects], 200);
    }

    public function index_view()
    {
        // Filter local scope
        $projects = Project::with('worker')
            ->with('profession')
            ->with('profession.specialty')
            ->with('user')
            ->withCount('offer')
            ->with('images')
            ->with('city')
            ->latest('updated_at')
            ->paginate(20);

        return view('cms.projects.index')->with('projects', $projects);
    }

    public function dataProject()
    {
        $city = City::all();
        $profession = Profession::all();
        $specialty = specialties::all();
        return response()->json([
            "city" => $city,
            "profession" => $profession,
            "specialty" => $specialty,
            "values" => Project::values(),
        ], 200);
    }

    public function filter(Request $request)
    {
        // Filter local scope
        $projects = Project::with('worker')
            ->with('profession')
            ->with('profession.specialty')
            ->with('user')
            ->with('city')
            ->with('images')
            ->where('accept', true)
            ->filter($request)
            ->latest('updated_at')
            ->paginate(20);
        if (!empty($projects) === 0) {
            return response()->json(['message' => 'empty projects !'], 400);
        }
        return response()->json(['message' => 'the projects is not empty', 'data' => $projects], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(PostProjectRequest $request)
    {
        $project = new Project($request->only([
            'name', 'description', 'time_first',
            'notes', 'time_function', 'additional_file',
            'value', 'funds', 'city_id', 'description_location',
            'accept', 'worker_id', 'profession_id'
        ]));
        $project->user_id = Auth::guard('sanctum')->user()->id;

        $result = $project->save();
        $result_image = false;

        if ($request->hasFile('images')) {
            $imagesFiles = $request->file('images');

            foreach ($imagesFiles as $image) {
                // $imagePath = $image->store('project_img/projects', 'public');
                // $imagePath = $image->store('project_image/projects', [
                //     'disk' => 'public'
                // ]);
                $imagePath = Storage::disk('public')->put('project_image/projects',  $image);
                $img = new Image();
                $img->image_url = $imagePath;
                $img->slug = $project->slug;

                $result_image = $project->images()->save($img);
            }
        }

        // Check if the project and images were saved successfully
        if ($result  || $result_image) {
            // Redirect or return a success response
            return response()->json(['success', 'Project and images stored successfully'], 200);
        } else {
            // Redirect or return an error response
            return response()->json(['error', 'Failed to store project and images'], 400);
        }
    }

    public function filterFormData()
    {
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function offer($project)
    {
        //يحصل مشكلة عند أستخدام المودل الأصلية المرجعة من عملة الراوت
        $projects = Project::where('slug', $project)
            ->with('worker')
            ->with('images')
            ->with('offer', 'offer.user')
            ->with('profession')
            ->with('profession.specialty')
            ->with('user')
            ->where('accept', true)
            ->firstOrFail();


        if (!$projects) {
            return response()->json(['message' => 'empty projects !'], 400);
        }
        return response()->json(['data' => $projects], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($project)
    {
        $projects = Project::where('slug', $project)->with('images')->first();
        if ($projects) {
            $images = $projects->images;

            foreach ($images as $image) {
                // Delete the image file from storage if needed
                Storage::disk('public')->delete($image->image_url);

                $image->delete(); // Delete the image record from the database
            }

            $projects->delete(); // Delete the project record from the database
        }

        return response()->json(['message' => "success for delete the project and related images", 'data' => $projects], 200);
    }

    public function destroy_view($slug)
    {
        $projects = Project::where('slug', $slug)->with('images')->first();
        if ($projects) {
            $images = $projects->images;

            foreach ($images as $image) {
                // Delete the image file from storage if needed
                Storage::disk('public')->delete($image->image_url);

                $image->delete(); // Delete the image record from the database
            }

            $projects->delete(); // Delete the project record from the database
        }
        return redirect()->back();
        // return response()->json(['message' => "success for delete the project and related images", 'data' => $projects], 200);
    }
}
