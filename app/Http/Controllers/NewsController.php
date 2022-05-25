<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\News;
use Carbon\Carbon;
use Validator;
use Redirect;



class NewsController extends Controller
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
        return view('news.index', [
            'news' => News::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $categories = Category::all();
        return view('news.create', compact('categories'));
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

            $imageName = time() . '.' . $request->feature_image->extension();
            $request->feature_image->move(public_path('assets/postImages'), $imageName);
            $data['feature_image'] = $imageName;
        }

        if ($request->has('top_image')) {

            $top_image = Carbon::now()->timestamp .'top'. '.' . $request->top_image->extension();
            $request->top_image->move(public_path('assets/postImages'), $top_image);
            $data['top_image'] = $top_image;
        }

            $result =  explode(" ", $request->title);
            $slug = implode('-', $result);
            $data['slug'] = $slug;


            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['type'] = $request->type;
            $data['breaking_news'] = $request->breaking_news;
            $data['cat_id'] = $request->cat_id;
            $data['user_id'] = auth()->user()->id;


         News::create($data);

        return redirect()->route('news.index')->with('message', 'News added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(News $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $news = News::find($id);
        return view('news.edit', compact('news', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $news = News::find($id);

        if (!$news) {
            return redirect()->route('news.index')->with('error','Id not found');
        }

        $data = $request->all();

        if ($request->file('feature_image')) {

            $validator = Validator::make($request->all(), [
                'feature_image' => 'required|max:500',
            ]);
            if ($validator->fails()) {
                return redirect()->route('blogs.index')->with('error', 'Image size can not be greter than 500kb');
            }

            try {
                unlink('assets/postImages' . '/' . $news->feature_image);

                $imageName = Carbon::now()->timestamp . '.' . $request->feature_image->extension();
                $request->feature_image->move(public_path('assets/postImages'), $imageName);

                $data['feature_image'] = $imageName;
                $news->feature_image = $data['feature_image'];

            } catch (\Exception $e) {

                $imageName = Carbon::now()->timestamp . '.' . $request->feature_image->extension();
                $request->feature_image->move(public_path('assets/postImages'), $imageName);

                $data['feature_image'] = $imageName;
                $news->feature_image = $data['feature_image'];
            }
        }


        if ($request->file('top_image')) {
            try {
                unlink('assets/postImages' . '/' . $news->top_image);

                $top_image = Carbon::now()->timestamp .'top'. '.' . $request->top_image->extension();
                $request->top_image->move(public_path('assets/postImages'), $top_image);

                $data['top_image'] = $top_image;
                $news->top_image = $data['top_image'];

            } catch (\Exception $e) {

                $top_image = Carbon::now()->timestamp . '.' . $request->top_image->extension();
                $request->top_image->move(public_path('assets/postImages'), $top_image);

                $data['top_image'] = $top_image;
                $news->top_image = $data['top_image'];
            }
        }

        if ($request->title) {
            $news->title = $request->title;

            $result =  explode(" ", $request->title);
            $slug = implode('-', $result);
            $news->slug = $slug;
        }

        if ($request->description) {
            $news->description = $request->description;
        }

        if ($request->type) {
            $news->type = $request->type;
        }
        if ($request->breaking_news) {
            $news->breaking_news = $request->breaking_news;
        }
        if ($request->breaking_news) {
            $news->breaking_news = $request->breaking_news;
        }

        if ($request->cat_id) {
            $news->cat_id = $request->cat_id;
        }

        $news->user_id = auth()->user()->id;
        $news->save();


        return redirect()->route('news.index')->with('message','News updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);

        if (!$news) {
            return redirect()->route('news.index')->with('error','Id not found');
        }

        try {

            unlink('assets/postImages' . '/' . $news->feature_image);
            $news->delete();
            return redirect()->route('users.index')->with('message', 'News deleted Successfully');

        } catch (\Exception $e) {

            $news->delete();
            return redirect()->route('users.index')->with('message', 'News deleted Successfully');
        }
    }
}
