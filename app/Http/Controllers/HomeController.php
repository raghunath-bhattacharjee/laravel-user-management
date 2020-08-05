<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.home', compact('users'));
    }

    public function showProfile()
    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::find(Auth::id());
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');

        $user->address = $request->get('address');
        $user->city = $request->get('city');
        $user->state = $request->get('state');
        $user->country = $request->get('country');
        $user->dob = $request->get('dob');
        $user->save();

        if ($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
            $user->save();
            Auth::logout();
        }

        $request->session()->flash('alert-success', 'Profile successful updated!');
        return redirect()->back();
    }

    public function addUser()
    {
        if (!Auth::user() || Auth::user()->user_type == User::NORMAL_USER) {
            abort(401);
        }
        return view('admin.add-user');
    }


    public function createUser(Request $request)
    {
        if (!Auth::user() || Auth::user()->user_type == User::NORMAL_USER) {
            abort(401);
        }

        $validator = Validator::make($request->all(), [
            'username' => 'required|min:1|max:255',
            'first_name' => 'required|min:1|max:255',
            'last_name' => 'required|min:1|max:255',
            'email' => 'required|min:1|max:255',

            'status' => 'required|boolean',
            'user_type' => 'required',

            'password' => 'required|min:1|max:255',

            'address' => 'required|min:1|max:255',
            'city' => 'required|min:1|max:255',
            'state' => 'required|min:1|max:255',
            'country' => 'required|min:1|max:255',
            'dob' => 'required|min:1|max:255',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $blog = new User();
        $blog = $this->saveDetails($request, $blog);
        $blog->save();

        $request->session()->flash('alert-success', 'User successful created.');
        return redirect()->back();
    }

    public function showEditUser($id)
    {
        if (!Auth::user() || Auth::user()->user_type == User::NORMAL_USER) {
            abort(401);
        }

        $user = User::find($id);
        if ($user) {
            return view('admin.edit_user', compact('user'));
        } else {
            abort(404);
        }
    }

    public function updateUser($id, Request $request)
    {
        if (!Auth::user() || Auth::user()->user_type == User::NORMAL_USER) {
            abort(401);
        }

        $validator = Validator::make($request->all(), [
            'username' => 'required|min:1|max:255',
            'first_name' => 'required|min:1|max:255',
            'last_name' => 'required|min:1|max:255',
            'email' => 'required|min:1|max:255',

            'status' => 'required|boolean',
            'user_type' => 'required',

            'address' => 'required|min:1|max:255',
            'city' => 'required|min:1|max:255',
            'state' => 'required|min:1|max:255',
            'country' => 'required|min:1|max:255',
            'dob' => 'required|min:1|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $blog = User::find($id);
        $blog = $this->saveDetails($request, $blog);
        $blog->save();
        $request->session()->flash('alert-success', 'Blog successful updated.');
        return redirect()->back();
    }

    private function saveDetails(Request $request, $user)
    {
        $user->username = $request->get('username');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');

        $user->status = $request->get('status');
        $user->user_type = $request->get('user_type');

        $user->address = $request->get('address');
        $user->city = $request->get('city');
        $user->state = $request->get('state');
        $user->country = $request->get('country');
        $user->dob = $request->get('dob');

        if ($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }

        return $user;
    }

    public function deleteUser($id, Request $request)
    {
        //only root user can delete other user
        if (!Auth::user() || Auth::user()->user_type == User::NORMAL_USER) {
            abort(401);
        }

        $user = User::find($id);
        $user->delete();

        $request->session()->flash('alert-success', 'User successful deleted');
        return redirect()->back();
    }
}
