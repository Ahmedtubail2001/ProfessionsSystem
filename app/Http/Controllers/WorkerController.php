<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\postEditWorker;
use App\Http\Requests\PostWorkerRequest;
use App\Models\gallery;
use App\Models\Project;
use App\Models\Rate;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate = 10;
        $result = Worker::select("*")
            ->paginate($paginate);

        return response()->json(["Worker data" => $result], 200);
    }

    public function index_view()
    {
        $result = Worker::with('profession')
            ->with('user')
            ->latest('updated_at')
            ->paginate(20);

        return view('cms.workers.index')->with('workers', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostWorkerRequest $request)
    {
        // ['professional_experience', 'cover_image', 'id_number', 'address', 'experience-year', 'password', 'user_id', 'profession_id'];
        // $image = $request->file('cover_image');
        // $path = "project_img/cover_img/";
        // $name = time() + rand(1, 1000) . "." . $image->getClientOriginalExtension();
        // Storage::disk('local')->put($path . $name,  file_get_contents($image));
        //-------Base 64-------------
        //    why use Base64
        // Compatibility: Base64-encoded data can be easily transmitted over protocols that only support text, such as HTTP, SMTP, or JSON-based APIs. It ensures that the image data is not lost or corrupted during transmission.

        $base64 = $request['cover_image'];
        if (!$base64) {
            return response()->json(['error' => 'Please enter a base64 image string.']);
        }

        //  This line of code uses a regular expression to remove the image format and base64 encoding prefix from a string representing an image encoded in base64 format.
        $base64 = preg_replace("/^data:image\/(png|jpeg|jpg|svg|gif);base64,/", '', $base64);
        //decode from base64 image
        $data = base64_decode($base64);
        $imageSize = getimagesizefromstring($data);
        $path = "project_img/cover_img/";
        $name = time() + rand(1, 1000) . "." . explode("/", $imageSize['mime'])[1];
        Storage::disk('public')->put($path . $name,  $data);

        $worker = new Worker();
        $worker->professional_experience = $request['professional_experience'];
        $worker->cover_image = $path . $name;
        $worker->id_number = $request['id_number'];
        $worker->address = $request['address'];
        $worker->experience_year = $request['experience_year'];
        // $worker->password = $request['password'];
        $worker->user_id = Auth::user()->id;
        $worker->profession_id = $request['profession_id'];
        $worker->phone_number = $request['phone_number'];
        $file = $request->file('CV');
        if (isset($file)) {
            $pathFile = "project_img/Files/";
            $nameFile = time() + rand(1, 1000) . "." . $file->getClientOriginalExtension();
            Storage::disk('public')->put($pathFile . $nameFile,  file_get_contents($file));
            $worker->CV = $pathFile . $nameFile;
        }



        $status = $worker->save();
        $user = User::where('id', Auth::user()->id)->first();
        // $user->update(['role' => 1]);
        $user->role = '1';
        $user->save();
        // $status = Worker::create($request->except('cover_image'), ['cover_image' => $path . $name]);

        if ($status) {
            $user =  Auth::user();
            $name =  $user->name;
            $email =  $user->email;
            $image_url = $user->image;
            if ($image_url) {
                $image_url = url('app/public', [
                    'image' => $image_url,
                ]);
            } else {
                $image_url = 'http://via.placeholder.com/80x80';
            }

            $status = Mail::send('emails.registerWorker', [
                'name' => $name,
                'email' => $email,
                'image_url' => $image_url
            ], function ($message) {
                $message->to(Auth::user()->email, 'Professional System')
                    ->subject('success for registar as aworker');
            });

            return response()->json(['message' => 'Record inserted successfully.', 'data' => $status], 200);
        } else {
            return response()->json(['message' => 'Failed to insert record.'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $worker = Worker::where('slug', $slug)->with('user')->first();
        if ($worker) {
            return response()->json(['data' => $worker], 200);
        } else {
            return response()->json(['message' => 'not find this specialties '], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(PostWorkerRequest $request, $slug)
    {
        $worker = Worker::where('slug', $slug)->first();
        // Storage::disk('local')->delete($worker->cover_image);
        //The shortcut process loads the image on every update
        if (Storage::disk('public')->exists($worker->cover_image)) {
            Storage::disk('public')->delete($worker->cover_image);
        }
        //تدخل مباشرة على ملف ال App
        if (Storage::disk('public')->exists($worker->CV)) {
            Storage::disk('public')->delete($worker->CV);
        }

        $image = $request->file('cover_image');
        if (isset($image)) {
            $path = "project_img/cover_img/";
            $name = time() + rand(1, 1000) . "." . $image->getClientOriginalExtension();
            Storage::disk('public')->put($path . $name,  file_get_contents($image));
        }
        //  $this->URLFile($request->file('cover_image'));
        $worker->professional_experience = $request['professional_experience'];
        $worker->cover_image  = $path . $name;
        $worker->id_number = $request['id_number'];
        $worker->address = $request['address'];
        $worker->experience_year = $request['experience_year'];
        // $worker->password = $request['password'];
        $worker->user_id = $request['user_id'];
        $worker->profession_id = $request['profession_id'];
        $worker->phone_number = $request['phone_number'];
        $file = $request->file('CV');
        if (isset($file)) {
            $pathFile = "project_img/Files/";
            $nameFile = time() + rand(1, 1000) . "." . $file->getClientOriginalExtension();
            Storage::disk('public')->put($pathFile . $nameFile,  file_get_contents($file));
            $worker->CV = $pathFile . $nameFile;
        }
        $status = $worker->save();

        if ($status) {
            return response()->json(['message' => 'success for update Process', 'data' =>  $status], 200);
        } else {
            return response()->json(['message' => 'not find this Worker '], 500);
        }
    }

    public function profile_info()
    {
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $worker = Worker::where('slug', $slug)->first();

        if (Storage::disk('public')->exists($worker->cover_image)) {
            Storage::disk('public')->delete($worker->cover_image);
        }
        if (Storage::disk('public')->exists($worker->CV)) {
            Storage::disk('public')->delete($worker->CV);
        }
        $result = $worker::destroy($worker->id);
        Auth::user()->role = 0;
        if ($worker) {
            return response()->json(['message' => 'success for DELETE Process', 'data' => $result], 200);
        } else {
            return response()->json(['message' => 'not find this Worker '], 500);
        }
    }


    public function destroy_view($slug)
    {
        $worker = Worker::where('slug', $slug)->first();

        if (Storage::disk('public')->exists($worker->cover_image)) {
            Storage::disk('public')->delete($worker->cover_image);
        }
        if (Storage::disk('public')->exists($worker->CV)) {
            Storage::disk('public')->delete($worker->CV);
        }
        $result = $worker::destroy($worker->id);
        Auth::user()->role = 0;

        return redirect()->back()->with('status', $result);
    }

    public function sendEmailRegister()
    {
        $user =  Auth::user();
        $name =  $user->name;
        $email =  $user->email;
        $image_url = $user->image;
        if ($image_url) {
            $image_url = url('app/public', [
                'image' => $image_url,
            ]);
        } else {
            $image_url = 'http://via.placeholder.com/80x80';
        }
        $status = Mail::send('emails.registerWorker', [
            'name' => $name,
            'email' => $email,
            'image_url' => $image_url
        ], function ($message) {
            $message->to(Auth::user()->email, 'Professional System')
                ->subject('return to website');
        });
        $user = User::where('id', Auth::user()->id)->first();
        $user->role = '0';
        $user->save();
        if ($status) {
            return response()->json(['message' => 'Check your email'], 200);
        }
        return response()->json(['message' => $image_url], 200);
        // 
    }

    public function profile_comment($slug)
    {
        $worker = Worker::where('slug', $slug)->first();
        $rate = Rate::owner($worker->id)->with('user')->get();
        if (count($rate) > 0) {
            return response()->json(['rates' => $rate], 200);
        } else {
            return response()->json(['rates' => 'the rate and comment is empty'], 400);
        }
    }

    public function profile_gallery($slug)
    {
        $worker = Worker::where('slug', $slug)->first();
        $gallery = gallery::owner($worker->id)->with('images')->latest('updated_at')->get();
        if (count($gallery) > 0) {
            return response()->json(['gallery' => $gallery], 200);
        } else {
            return response()->json(['gallery' => 'the gallery is empty'], 400);
        }
    }


    public function profile_work($slug)
    {
        $worker = Worker::where('slug', $slug)->first();
        $work = Project::owner($worker->id)->with('images')->latest('updated_at')->get();
        if (count($work) > 0) {
            return response()->json(['works' => $work], 200);
        } else {
            return response()->json(['works' => 'Never received business before'], 400);
        }
    }

    public function data_profile($slug)
    {
        $worker = Worker::where('slug', $slug)
            ->with('rate')
            ->withSum('rate as star_rate', 'rate')
            ->withCount('rate')
            ->with('user')
            ->first();
        $worker->star_rate = ($worker->star_rate / ($worker->rate_count * 10)) * 10;

        // && count($worker) != 0
        if ($worker != null) {
            return response()->json(['data' => $worker], 200);
        }
        return response()->json(['data' => 'the data is empty'], 400);
    }

    public function Edit_cover(Request $request, $slug)
    {
        $validate = Validator::make($request->all(), [
            'cover_image' => 'required|image'
        ], [
            'cover_image.required' => 'please select a cover image ',
            'cover_image.image' => "this file must be an image",
        ]);
        if ($validate->fails()) {
            return response()->json(['message' => $validate->getMessageBag()->first()], 400);
        }


        $worker = Worker::where('slug', $slug)->first();
        if (Storage::disk('public')->exists($worker->cover_image)) {
            Storage::disk('public')->delete($worker->cover_image);
        }
        $image = $request->file('cover_image');
        if (isset($image)) {
            $path = "project_img/cover_img/";
            $name = time() + rand(1, 1000) . "." . $image->getClientOriginalExtension();
            Storage::disk('public')->put($path . $name,  file_get_contents($image));
        }

        $worker->cover_image  = $path . $name;
        $status = $worker->save();
        if ($status) {
            return response()->json(['message' => 'success for update the cover image'], 200);
        }
        return response()->json(['message' => 'faild for update the cover image'], 400);
    }

    public function Edit_image_profile(Request $request, $slug)
    {
        $validate = Validator::make($request->all(), [
            'image' => 'required|image'
        ], [
            'image.required' => 'please select a profile image ',
            'image.image' => "this file must be an image",
        ]);
        if ($validate->fails()) {
            return response()->json(['message' => $validate->getMessageBag()->first()], 400);
        }


        $worker = Worker::where('slug', $slug)->with('user')->first();
        if (Storage::disk('public')->exists($worker->user->image)) {
            Storage::disk('public')->delete($worker->user->image);
        }
        $image = $request->file('image');
        if (isset($image)) {
            $path = "project_image/user_img/";
            $name = time() + rand(1, 1000) . "." . $image->getClientOriginalExtension();
            Storage::disk('public')->put($path . $name,  file_get_contents($image));
        }

        $worker->user->image  = $path . $name;
        $status = $worker->user->save();
        if ($status) {
            return response()->json(['message' => 'success for update the image'], 200);
        }
        return response()->json(['message' => 'faild for update the image'], 400);
    }

    public function Edit_data_profile(postEditWorker $request, $slug)
    {
        $worker = Worker::where('slug', $slug)->first();
        $user = User::where('id', $worker->user_id)->first();

        //  $this->URLFile($request->file('cover_image'));
        $worker->professional_experience = $request['professional_experience'];
        $worker->id_number = $request['id_number'];
        $worker->address = $request['address'];
        $worker->experience_year = $request['experience_year'];
        // $worker->password = $request['password'];
        $worker->user_id = Auth::user()->id;
        $worker->profession_id = $request['profession_id'];
        $worker->phone_number = $request['phone_number'];

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->city_id = $request['city_id'];

        $file = $request->file('CV');
        if (isset($file)) {
            // if (Storage::disk('local')->exists($worker->CV)) {
            Storage::disk('public')->delete($worker->CV);
            // }
            $pathFile = "project_img/Files/";
            $nameFile = time() + rand(1, 1000) . "." . $file->getClientOriginalExtension();
            Storage::disk('public')->put($pathFile . $nameFile,  file_get_contents($file));
            $worker->CV = $pathFile . $nameFile;
        }
        $status = $worker->save();
        $statusUser = $user->save();
        if ($status && $statusUser) {
            return response()->json(['message' => 'success for update Process', 'data' =>  $status], 200);
        } else {
            return response()->json(['message' => 'not find this Worker '], 500);
        }
    }
}
