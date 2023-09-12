<?php

namespace App\Http\Controllers;

use App\Models\gallery;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallerys = gallery::with('images')
            ->where('visible', '1')
            ->latest('updated_at')
            ->paginate(20);
        if (!empty($projects) === 0) {
            return response()->json(['message' => 'empty gallery !'], 400);
        }
        return response()->json(['message' => 'the gallery is not empty', 'data' => $gallerys], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gallery = new gallery($request->only([
            'title', 'detail', 'visible', 'worker_id'
        ]));
        $result = $gallery->save();
        $result_image = false;

        if ($request->hasFile('images')) {
            $imagesFiles = $request->file('images');

            foreach ($imagesFiles as $image) {
                $imagePath = Storage::disk('public')->put('project_image/gallarys',  $image);
                $img = new Image();
                $img->image_url = $imagePath;
                $img->slug = $gallery->slug;
                $result_image = $gallery->images()->save($img);
            }
        }

        // Check if the project and images were saved successfully
        if ($result || $result_image) {
            // Redirect or return a success response
            return response()->json(['success', 'Project and images stored successfully'], 200);
        } else {
            // Redirect or return an error response
            return response()->json(['error', 'Failed to store project and images'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(gallery $gallery)
    {
        $gallerys = gallery::latest('updated_at')
            ->paginate(20);
        if (!empty($projects) === 0) {
            return response()->json(['message' => 'empty gallery !'], 400);
        }
        return response()->json(['message' => 'the gallery is not empty', 'data' => $gallerys], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, gallery $gallery)
    {



        // if ($request->hasFile('images')) {
        //     $images = $gallery->images;
        //     $deletionStatus = true; // Assume all deletions are successful

        //     foreach ($images as $image) {
        //         // if (Storage::disk('public')->exists($image->image_url)) {
        //         $deletionStatus = Storage::disk('public')->delete($image->image_url);
        //         if (!$deletionStatus) {
        //             // Handle deletion failure immediately
        //             return response()->json(['message' => 'Failed to delete gallery images.'], 500);
        //         }
        //         // }
        //     }


        //     // // If all deletions were successful, return success response
        //     // return response()->json(['message' => 'Success for edit gallery!', 'data' => $deletionStatus], 200);
        //     $status = $gallery->update($request->all());

        //     $status = $gallery->images->delete();
        //     $imagesFiles = $request->file('images');

        //     foreach ($imagesFiles as $image) {
        //         $imagePath = Storage::disk('public')->put('project_image/gallarys',  $image);
        //         $img = new Image();
        //         $img->image_url = $imagePath;
        //         $img->slug = $gallery->slug;
        //         $gallery->images()->save($img);
        //     }
        // }

        // if (!$status) {
        //     return response()->json(['message' => 'faild to edit gallery !'], 400);
        // }
        // return response()->json(['message' => 'success for edit gallery !'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(gallery $gallery)
    {
        // $projects = gallery::where('slug', $gallery)->with('images')->first();
        if ($gallery) {
            $images = $gallery->images;

            foreach ($images as $image) {
                // Delete the image file from storage if needed
                Storage::disk('public')->delete($image->image_url);

                $image->delete(); // Delete the image record from the database
            }

            $gallery->delete(); // Delete the project record from the database
        }

        return response()->json(['message' => "success for delete the gallery and related images", 'data' => $gallery], 200);
    }
}
