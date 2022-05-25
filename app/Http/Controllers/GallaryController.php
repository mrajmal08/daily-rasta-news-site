<?php

namespace App\Http\Controllers;

use App\Models\Gallary;
use App\Models\GallaryItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class GallaryController extends Controller
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
        $gallary = Gallary::orderBy('id', 'DESC')->get();
        return view('gallary.index', compact('gallary'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallary.create');
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
            'event_name' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $gallary = new Gallary();

        if ($request->hasfile('feature_image')) {

            $feature_image = Carbon::now()->timestamp . '.' . $request->feature_image->extension();
            $request->feature_image->move(public_path('assets/gallaryFiles'), $feature_image);
            $gallary->feature_image = $feature_image;
        }
        $gallary->event_name = $request->event_name;
        $gallary->save();

        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $file) {

                try {
                    $image = Carbon::now()->timestamp . '.' . $file->extension();
                    $file->move(public_path('assets/gallaryFiles'), $image);

                    GallaryItem::create([
                        'image' => $image,
                        'gallary_id' => $gallary->id,
                    ]);

                } catch (\Exception$e) {
                    return back()->with('error', 'Something went wrong');
                }
            }
        }

        return redirect()->route('gallary.index')->with('message', 'Gallary Successfully Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallary  $gallary
     * @return \Illuminate\Http\Response
     */
    public function gallaryItems(Request $request)
    {
        if($request->gallary_id){

            if ($request->hasfile('image')) {
                foreach ($request->file('image') as $file) {

                    try {
                        $image = Carbon::now()->timestamp . '.' . $file->extension();
                        $file->move(public_path('assets/gallaryFiles'), $image);

                        GallaryItem::create([
                            'image' => $image,
                            'gallary_id' => $request->gallary_id
                        ]);

                    } catch (\Exception$e) {
                        return back()->with('error', 'Something went wrong');
                    }
                }
            }

            return redirect()->route('gallary.index')->with('message', 'Gallary Successfully Saved');


        }else{
        return redirect()->route('gallary.index')->with('error', 'Id Cannot Be Null');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallary  $gallary
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallary = Gallary::find($id);
        return view('gallary.edit', compact('gallary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallary  $gallary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $gallary = Gallary::find($id);

        if ($request->hasfile('feature_image')) {

            try {
                unlink('assets/gallaryFiles' . '/' . $gallary->feature_image);

                $feature_image = Carbon::now()->timestamp . '.' . $request->feature_image->extension();
                $request->feature_image->move(public_path('assets/gallaryFiles'), $feature_image);
                $gallary->feature_image = $feature_image;

            }catch (\Exception$e) {

                $feature_image = Carbon::now()->timestamp . '.' . $request->feature_image->extension();
                $request->feature_image->move(public_path('assets/gallaryFiles'), $feature_image);
                $gallary->feature_image = $feature_image;

            }
        }
        $gallary->event_name = $request->event_name;
        $gallary->save();

        return redirect()->route('gallary.index')->with('message', 'Gallary Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallary  $gallary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallary = Gallary::find($id);
        $gallary_items = GallaryItem::where('gallary_id', $id)->get();

        foreach ($gallary_items as $gallary_item) {
            try {

                unlink('assets/gallaryFiles' . '/' . $gallary_item);
                $gallary_item->delete();

            } catch (\Exception$e) {
                $gallary_item->delete();
            }

        }

        try {
            unlink('assets/gallaryFiles' . '/' . $gallary->feature_image);
            $gallary->delete();
            return redirect()->route('gallary.index')->with('message', 'Your files has been successfully Deleted');

        } catch (\Exception$e) {
            $gallary->delete();
            return redirect()->route('gallary.index')->with('message', 'Your files has been successfully Deleted');

        }

    }
}
