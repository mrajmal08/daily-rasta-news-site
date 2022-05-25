<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use Redirect;
use Exception;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->role_id == 2){
            return redirect()->route('news.index')->with('error','Sorry you are not admin');
        }

        $users = User::orderBy('id', 'DESC')->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required',
        ]);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $data = $request->all();
        if ($request->has('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('assets/userImages'), $imageName);
            $data['photo'] = $imageName;
        }

        $data['password'] = Hash::make($request->password);
        User::create($data);

        return redirect()->route('users.index')->with('message','User added Successfully');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $user = User::findOrFail($id);

        if($user->super_admin == 'yes'){
            return redirect()->route('users.index')->with('error','Sorry Super Admin can not be edited');
        }
        return view('user.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error','Id not found');
        }

        $data = $request->all();

        if ($request->file('photo')) {

            try {

                unlink('assets/userImages' . '/' . $user->photo);
                $imageName = Carbon::now()->timestamp . '.' . $request->photo->extension();
                $request->photo->move(public_path('assets/userImages'), $imageName);
                $data['photo'] = $imageName;
                $user->photo = $data['photo'];

            } catch (\Exception $e) {


                $imageName = Carbon::now()->timestamp . '.' . $request->photo->extension();
                $request->photo->move(public_path('assets/userImages'), $imageName);
                $data['photo'] = $imageName;
                $user->photo = $data['photo'];
            }
        }

        if ($request->title) {
            $user->title = $request->title;
        }

        if ($request->email) {
            $user->email = $request->email;
        }
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        if ($request->contact) {
            $user->contact = $request->contact;
        }
        if ($request->address) {
            $user->address = $request->address;
        }

        if ($request->role_id) {
            $user->role_id = $request->role_id;
        }


        $user->save();


        return redirect()->route('users.index')->with('message','User updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::find($id);

        if($user->super_admin == 'yes'){
            return redirect()->route('users.index')->with('error','Sorry Super Admin can not be edited');
        }

        if (!$user) {
            return redirect()->route('users.index')->with('error','Id not found');
        }

        try {

            unlink('assets/userImages' . '/' . $user->image);
            $user->delete();
            return redirect()->route('users.index')->with('message', 'User deleted Successfully');

        } catch (\Exception $e) {

            $user->delete();

            return redirect()->route('users.index')->with('message', 'User deleted Successfully');
        }
    }
}
