<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\News;
use Carbon\Carbon;
use Redirect;
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
        if (Auth::user()->role_id == 2) {
            return redirect()->route('news.index')->with('error', 'Sorry you are not admin');
        }

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
            'image' => 'required|dimensions:max_width=120,max_height=100',
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $result =  explode(" ", $request->title);
        $slug = implode('-', $result);

        if ($request->has('image')) {

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/categoryImages'), $imageName);
            $data = $request->all();

            $data['slug'] = $slug;
            $data['image'] = $imageName;
        } else {
            $data['slug'] = $slug;
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

            $validator = Validator::make($request->all(), [
                'image' => 'required|dimensions:max_width=120,max_height=100',
            ]);

            if($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }


            try {

                unlink('assets/categoryImages' . '/' . $category->image);

                $imageName = Carbon::now()->timestamp . '.' . $request->image->extension();
                $request->image->move(public_path('assets/categoryImages'), $imageName);

                $data['image'] = $imageName;

                $category->image = $data['image'];
                $category->save();

            } catch (\Exception$e) {

                $imageName = Carbon::now()->timestamp . '.' . $request->image->extension();
                $request->image->move(public_path('assets/categoryImages'), $imageName);

                $data['image'] = $imageName;

                $category->image = $data['image'];
                $category->save();

            }
        }

        if ($request->title) {
            $category->title = $request->title;

            $result =  explode(" ", $request->title);
            $slug = implode('-', $result);
            $category->slug = $slug;

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

            $posts = News::where('cat_id', $id)->get();
            unlink('assets/categoryImages' . '/' . $category->image);
            $category->delete();
            foreach ($posts as $post) {
                $post->delete();
            }
            return redirect()->route('categories.index')->with('message', 'Category deleted Successfully');

        } catch (\Exception$e) {

            $category->delete();
            foreach ($posts as $post) {
                $post->delete();
            }
            return redirect()->route('categories.index')->with('message', 'Category deleted Successfully');
        }
    }
}
