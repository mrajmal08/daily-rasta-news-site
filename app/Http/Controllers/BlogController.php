<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Blog;
use Carbon\Carbon;
use Validator;
use Redirect;


class BlogController extends Controller
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
            $blogs = Blog::all();
            return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');

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
            'title' => 'required|max:255',
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }


        if ($request->has('feature_image')) {
            $validator = Validator::make($request->all(), [
                'feature_image' => 'required|max:500',
            ]);
            if ($validator->fails()) {
                return redirect()->route('blogs.index')->with('error', 'Image size can not be greter than 500kb');
            }

            $imageName = time() . '.' . $request->feature_image->extension();
            $request->feature_image->move(public_path('assets/blogFiles'), $imageName);
            $data['feature_image'] = $imageName;
        }

        $result =  explode(" ", $request->title);
        $slug = implode('-', $result);
        $data['slug'] = $slug;

        $data['title'] = $request->title;
        $data['type'] = $request->type;
        $data['description'] = $request->description;
        $data['user_id'] = Auth::user()->id;
        Blog::create($data);

        return redirect()->route('blogs.index')->with('message','Blog created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $blog = Blog::find($id);

        if (!$blog) {
            return redirect()->route('blogs.index')->with('error','Id not found');
        }

        if ($request->file('feature_image')) {

            try {

                unlink('assets/blogFiles' . '/' . $blog->feature_image);
                $imageName = Carbon::now()->timestamp . '.' . $request->feature_image->extension();
                $request->feature_image->move(public_path('assets/blogFiles'), $imageName);

                $data['feature_image'] = $imageName;
                $blog->feature_image = $data['feature_image'];

            } catch (\Exception $e) {

                $imageName = Carbon::now()->timestamp . '.' . $request->feature_image->extension();
                $request->feature_image->move(public_path('assets/blogFiles'), $imageName);

                $data['feature_image'] = $imageName;
                $blog->feature_image = $data['feature_image'];
            }
        }

        if ($request->title) {
            $blog->title = $request->title;

            $result =  explode(" ", $request->title);
            $slug = implode('-', $result);
            $blog->slug = $slug;

        }

        if ($request->type) {
            $blog->type = $request->type;
        }


        if ($request->description) {
            $blog->description = $request->description;
        }

        $blog->user_id = auth()->user()->id;
        $blog->save();


        return redirect()->route('blogs.index')->with('message','Blog updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return redirect()->route('news.index')->with('error','Id not found');
        }

        try {

            unlink('assets/blogFiles' . '/' . $blog->feature_image);
            $blog->delete();
            return redirect()->route('blogs.index')->with('message', 'Blog deleted Successfully');

        } catch (\Exception $e) {

            $blog->delete();

            return redirect()->route('blogs.index')->with('message', 'Blog deleted Successfully');
        }
    }
}
