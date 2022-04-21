<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Video;
use App\Models\News;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use Redirect;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalUSers = User::all()->count();
        $totalCategories = Category::all()->count();
        $totalPosts = News::all()->count();
        $totalVideos = Video::all()->count();

        return view('home', compact('totalUSers', 'totalCategories', 'totalPosts', 'totalVideos'));
    }

    public function profile()
    {

        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        return view('user.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('profile')->with('error', 'Id not found');
        }

        $data = $request->all();

        if ($request->file('photo')) {

            try {

                unlink('assets/userImages' . '/' . $user->photo);

            } catch (\Exception$e) {

                // return redirect()->route('categories.index')->with('error', 'Image not found');

                $imageName = Carbon::now()->timestamp . '.' . $request->photo->extension();
                $request->photo->move(public_path('assets/userImages'), $imageName);

                $data['photo'] = $imageName;

                $user->photo = $data['photo'];
                // $user->save();
            }
        }

        if ($request->title) {
            $user->title = $request->title;
        }

        if ($request->email) {
            $user->email = $request->email;
        }

        if ($request->contact) {
            $user->contact = $request->contact;
        }
        if ($request->contact) {
            $user->address = $request->address;
        }

        $user->save();

        return redirect()->route('profile')->with('message', 'User updated Successfully');
    }

    public function profilePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6|different:old_password',

        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        if (Hash::check($request['old_password'], Auth::user()->password)) {
            User::where('id', auth()->user()->id)->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->route('profile')->with('message', 'Password updated successfully');
        } else {
            return redirect()->route('profile')->with('error', 'Old Password is not correct');
        }
    }
}
