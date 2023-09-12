<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function elementEachPage()
    {
        return 10;
    }
    public function countNumRow($id)
    {
        # code...
        // $specialty = specialties::count();
        $index = User::pluck('id')->search($id);

        return $index;
    }

    public function validat($requests)
    {
        $validator = Validator::make(
            $requests->all(),
            [
                'name' => 'required|string',
                'email' => 'required|email|string',
                'permission' => 'required|string',

            ],
            [
                'name.required' => 'the name of user is required',
                'name.string' => 'the name of user must be string',

                'email.required' => 'the email of user is required',
                'email.email' => 'the email of user must be email',
                'email.string' => 'the email of user must be string',

                'email.required' => 'the email of user is required',
                'email.string' => 'the email of user must be string',

            ]

        );
        return $validator;
    }

    public function create()
    {
        return view('cms.users.create');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::withCount('permissions')->paginate($this->elementEachPage());

        return view('cms.users.index')->with('users', $users);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update($id)
    {
        $user = User::find($id);
        $active = $user->active ? '0' : '1';
        $user->active = $active;
        $status = $user->save();
        if ($status) {
            return response()->json(['message' => 'success'], 200);
        } else {
            return response()->json(['error' => $status], 400);
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
        $status = User::destroy($id);
        if ($status) {
            return response()->json(['message' => 'Success for delete'], 200);
        } else {
            return response()->json(['error' => 'Something went wrong'], 400);
        }
    }

    public function check_email(Request $request)
    {
        // dd($request);
        $validate = Validator::make(
            $request->all(),
            [
                "email"    => 'required|exists:users,email',
            ],
            [
                "email.required"    => 'the email is required ',
                "email.exists"      => "this Email doesn't exists",
            ]
        );
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $email_user = User::where('email', $request->input('email'))->first();


        $image_url = $email_user->image;
        if ($image_url) {
            $image_url = url('app/public', [
                'image' => $image_url,
            ]);
        } else {
            $image_url = 'http://via.placeholder.com/80x80';
        }
        Mail::send('emails.ResetPassword', [
            'name'          => $email_user->name,
            'email'          => $email_user->email,
            'image_url'          => $image_url,

        ], function ($message) use ($email_user) {
            $message->from('Profession_System@gmail.com', 'Profession System');
            $message->sender('Profession_System@gmail.com', 'forgot password');
            $message->to($email_user->email, $email_user->name);
            $message->subject('reset the password');
        });
        session(['email_reset' => $request->input('email')]);

        return redirect()->back()->with('status', true);
    }

    public function pageChangePassword()
    {
        return view('cms.users.changePassword');
    }


    public function reset_password(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'password' => ['required', 'min:8', 'confirmed'],
            'email' => ['required', 'email', 'exists:users,email']
        ], [
            "password.required" => 'the password is required',
            "password.min" => "The Password must be at least :min characters.",
            "password.confirmed" => 'Confirm Password does not match.',
            "email.required" => 'Email field can\'t empty!',
            "email.email" => "must email",
            "email.exists" => 'This Email is not exists!'
        ]);
        if ($validate->fails()) {
            return Response([$validate->messages()], 400);
        }
        $password = Hash::make($request['password']);
        $user = User::where('email', $request['email'])->first();
        $user->password = $password;
        $status = $user->save();
        if ($status) {
            session()->forget('email_reset');
        }
        return redirect()->back()->with('status', $status);
    }
}
