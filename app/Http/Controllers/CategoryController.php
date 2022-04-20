<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Validator;


class CategoryController extends Controller
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
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');

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
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        if ($request->has('image')) {

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/categoryImages'), $imageName);
            $data = $request->all();
            $data['image'] = $imageName;
        } else {
            $data = $request->all();
        }

        Category::create($data);

        return redirect()->route('categories.index')->with('message', 'Category added Successfully');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
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
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Id not found');
        }

        $data = $request->all();

        if ($request->file('image')) {

            try {

                unlink('assets/categoryImages' . '/' . $category->image);

            } catch (\Exception$e) {

                // return redirect()->route('categories.index')->with('error', 'Image not found');

                $imageName = Carbon::now()->timestamp . '.' . $request->image->extension();
                $request->image->move(public_path('assets/categoryImages'), $imageName);

                $data['image'] = $imageName;

                $category->image = $data['image'];
                $category->save();
            }
        }

        if ($request->name) {
            $category->name = $request->name;
        }

        if ($request->description) {
            $category->description = $request->description;
        }

        $category->save();

        return redirect()->route('categories.index')->with('message', 'Category updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Id not found');
        }

        try {

            unlink('assets/categoryImages' . '/' . $category->image);
            $category->delete();
            return redirect()->route('categories.index')->with('message', 'Category deleted Successfully');

        } catch (\Exception$e) {

            $category->delete();

            return redirect()->route('categories.index')->with('message', 'Category deleted Successfully');
        }
    }
}
