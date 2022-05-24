<?php

namespace App\Http\Controllers;

use App\Models\Newspaper;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class NewspaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newspaper = Newspaper::all();
        return view('newspaper.index', compact('newspaper'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newspaper.create');
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
            'image' => 'required|max:500',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'Image size can not be greter than 500kb');
        }

        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $file) {
                try {

                    $image = Carbon::now()->timestamp . '.' . $file->extension();
                    $file->move(public_path('assets/newspaperFiles'), $image);
                    $newspaper['news_date'] = $request->news_date ? $request->news_date : date('Y-m-d');
                    Newspaper::create([
                        'image' => $image,
                        'news_date' => $newspaper['news_date'],
                    ]);

                } catch (\Exception$e) {
                    return back()->with('error', 'Something went wrong');
                }
            }
        }

        return redirect()->route('newspaper.index')->with('message', 'Data Your files has been successfully added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Newspaper  $newspaper
     * @return \Illuminate\Http\Response
     */
    public function show(Newspaper $newspaper)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Newspaper  $newspaper
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newspaper = Newspaper::find($id);
        return view('newspaper.edit', compact('newspaper'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Newspaper  $newspaper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $newspaper = Newspaper::find($id);
        if ($request->hasfile('image')) {
            try {

                unlink('assets/postImages' . '/' . $newspaper->image);

                $image = Carbon::now()->timestamp . '.' . $request->image->extension();
                $request->image->move(public_path('assets/newspaperFiles'), $image);
                $newspaper['image'] = $image;

            } catch (\Exception$e) {

                $image = Carbon::now()->timestamp . '.' . $request->image->extension();
                $request->image->move(public_path('assets/newspaperFiles'), $image);
                $newspaper['image'] = $image;
            }
        }

        if($request->news_date){
            $newspaper['news_date'] = $request->news_date ? $request->news_date : date('Y-m-d');
        }

        $newspaper->save();

        return redirect()->route('newspaper.index')->with('message', 'Your files has been successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Newspaper  $newspaper
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newspaper = Newspaper::find($id);

        try {
            unlink('assets/newspaperFiles' . '/' . $newspaper->image);
            $newspaper->delete();
            return redirect()->route('newspaper.index')->with('message', 'Your files has been successfully Deleted');

        } catch (\Exception$e) {
            $newspaper->delete();
            return redirect()->route('newspaper.index')->with('message', 'Your files has been successfully Deleted');

        }

    }
}
