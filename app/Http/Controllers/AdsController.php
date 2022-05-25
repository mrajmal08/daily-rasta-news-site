<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Ads;
use Validator;
use DateTime;
use Redirect;

class AdsController extends Controller
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

        if (Auth::user()->role_id == 2) {
            return redirect()->route('news.index')->with('error', 'Sorry you are not admin');
        }

        $ads = Ads::orderBy('id', 'DESC')->get();
        return view('ads.index', compact('ads'));
    }

    public function create()
    {
        return view('ads.create');
    }

    public function store(Request $request)
    {

        $data = $request->all();
        if ($request->has('image')) {
            $validator = Validator::make($request->all(), [
                'image' => 'required|max:500',
            ]);
            if ($validator->fails()) {
                return redirect()->route('ads.index')->with('error', 'Image size can not be greter than 500kb');
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/adsFiles'), $imageName);
            $data['image'] = $imageName;
        }

        if ($request->has('video')) {
            $validator = Validator::make($request->all(), [
                'video' => 'required|file|max:3072',
            ]);
            if ($validator->fails()) {
                return redirect()->route('ads.index')->with('error', 'Video size can not be greter than 3MB');
            }

            $videoName = time() . '.' . $request->video->extension();
            $request->video->move(public_path('assets/adsFiles'), $videoName);
            $data['video'] = $videoName;
        }

        $data['user_id'] = Auth::user()->id;
        $source = $request->date_upto;
        $date = new DateTime($source);
        $data['date_upto'] = $date->format('Y.m.d');

        Ads::create($data);

        return redirect()->route('ads.index')->with('success', 'Ads created successfully');
    }

    public function edit($id)
    {
        $ads = Ads::find($id);
        return view('ads.edit', compact('ads'));
    }

    public function update(Request $request, $id)
    {

        $ads = Ads::find($id);
        $data = $request->all();

        if ($request->has('image')) {
            try {

                unlink('assets/adsFiles' . '/' . $ads->image);

                $validator = Validator::make($request->all(), [
                    'image' => 'required|max:500',
                ]);
                if ($validator->fails()) {
                    return redirect()->route('ads.index')->with('error', 'Image size can not be greter than 500kb');
                }

                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('assets/adsFiles'), $imageName);
                $data['image'] = $imageName;
                $ads->image = $data['image'];

            } catch (\Exception$e) {
                $validator = Validator::make($request->all(), [
                    'image' => 'required|max:500',
                ]);
                if ($validator->fails()) {
                    return redirect()->route('ads.index')->with('error', 'Image size can not be greter than 500kb');
                }

                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('assets/adsFiles'), $imageName);
                $data['image'] = $imageName;
                $ads->image = $data['image'];
            }
        }

        if ($request->has('video')) {

            try {

                unlink('assets/adsFiles' . '/' . $ads->video);

            } catch (\Exception$e) {
                $validator = Validator::make($request->all(), [
                    'video' => 'required|file|max:3072',
                ]);
                if ($validator->fails()) {
                    return redirect()->route('ads.index')->with('error', 'Video size can not be greter than 3MB');
                }

                $videoName = time() . '.' . $request->video->extension();
                $request->video->move(public_path('assets/adsFiles'), $videoName);
                $data['video'] = $videoName;
                $ads->video = $data['video'];
            }
        }

        if ($request->title) {
            $ads->title = $request->title;
        }
        if ($request->description) {
            $ads->description = $request->description;
        }

        if ($request->date_upto) {

            $source = $request->date_upto;
            $date = new DateTime($source);
            $ads->date_upto = $date->format('Y.m.d');

        }

        if ($request->status) {
            $ads->status = $request->status;
        }

        if ($request->url) {
            $ads->url = $request->url;
        }

        $ads->user_id = auth()->user()->id;
        $ads->save();

        return redirect()->route('ads.index')->with('success', 'Ads updated successfully');
    }

    public function destroy($id)
    {
        $ads = Ads::find($id);

        if (!$ads) {
            return redirect()->route('ads.index')->with('error','Id not found');
        }

        try {

            unlink('assets/adsFiles' . '/' . $ads->image);
            $ads->delete();
            return redirect()->route('ads.index')->with('message', 'Ada deleted Successfully');

        } catch (\Exception $e) {

            $ads->delete();

            return redirect()->route('ads.index')->with('message', 'Ads deleted Successfully');
        }
    }

}
