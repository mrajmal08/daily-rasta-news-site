<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\News;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Validator;

class FrontendController extends Controller
{
    public function index()
    {
        $breaking_news = News::where('breaking_news', 1)->take(5)->get();
        $recent_news = News::take(4)->orderBy('id', 'DESC')->get();
        $latest_news = News::take(1)->orderBy('id', 'DESC')->first();
        $trending_news = News::take(10)->where('type', 'trending')->get();
        $popular_news = News::take(10)->where('type', 'popular')->get();

        $blogs = Blog::take(10)->get();

        //categoreis
        $latest_categories = Category::take(3)->orderBy('id', 'DESC')->get();

        return view('welcome', compact('breaking_news', 'recent_news', 'latest_news', 'popular_news', 'latest_categories', 'trending_news', 'blogs'));
    }

    public function about()
    {
        return view('frontend.aboutus');
    }

    public function contact()
    {
        return view('frontend.contactus');
    }

    public function categories()
    {
        $categories = Category::paginate(4);

        return view('frontend.categories', compact('categories'));
    }

    public function blog(){
        return view('frontend.blog');
    }

    public function newsDetail($id)
    {

        $previous_clicks = News::where('id', '=', $id)->pluck('clicks')->first();
        $new_clicks = $previous_clicks + 1;
        News::where('id', '=', $id)->update(['clicks' => $new_clicks]);

        $recent_news = News::take(5)->orderBy('id', 'DESC')->get();
        $news = News::find($id);

        $category = Category::find($news->cat_id);
        $categories = Category::all();

        //get reviews
        $reviews = Review::where('post_id', '=', $id)->where('type', 'news')->get();

        return view('frontend.news_detail', compact('recent_news', 'news', 'category', 'categories', 'reviews'));

    }

    public function blogDetail($id){

        $previous_clicks = Blog::where('id', '=', $id)->pluck('total_clicks')->first();
        $new_clicks = $previous_clicks + 1;
        Blog::where('id', '=', $id)->update(['total_clicks' => $new_clicks]);

        $blog = Blog::find($id);
        $categories = Category::all();
        $recent_blog = Blog::take(5)->orderBy('id', 'DESC')->get();
        $reviews = Review::where('post_id', '=', $id)->where('type', 'blog')->get();



        return view('frontend.blog_detail', compact('blog', 'categories', 'recent_blog', 'reviews'));
    }

    public function postReview(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $user_id = auth()->user();
        if ($user_id) {
            $user_id = auth()->user()->id;
        } else {
            $user_id = '0';
        }


        $review = new Review();

        if($request->type == 'news'){
            $review['post_id'] = $request->news_id;
            $review['type'] = 'news';
        }else{
            $review['post_id'] = $request->blog_id;
            $review['type'] = 'blog';
        }

        $review['name'] = $request->name;
        $review['email'] = $request->email;
        $review['comment'] = $request->comment;



        $review['user_id'] = $user_id;

        $review->save();

        return redirect()->back()->with('message', 'Review submited Successfully');

    }

}
