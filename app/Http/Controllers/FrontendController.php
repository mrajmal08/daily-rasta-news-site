<?php

namespace App\Http\Controllers;

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
        $recent_news = News::take(5)->orderBy('id', 'DESC')->get();
        $latest_news = News::take(1)->orderBy('id', 'DESC')->first();
        $trending_news = News::take(10)->where('type', 'trending')->get();

        //categoreis
        $latest_categories = Category::take(3)->orderBy('id', 'DESC')->get();

        return view('welcome', compact('breaking_news', 'recent_news', 'latest_news', 'latest_categories', 'trending_news'));
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

        return view('frontend.categories');
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
        $reviews = Review::where('news_id', '=', $id)->get();

        return view('frontend.news_detail', compact('recent_news', 'news', 'category', 'categories', 'reviews'));

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
        $review['name'] = $request->name;
        $review['email'] = $request->email;
        $review['comment'] = $request->comment;
        $review['type'] = 'news';
        $review['news_id'] = $request->news_id;

        $review['user_id'] = $user_id;

        $review->save();

        return redirect()->back()->with('message', 'Review submited Successfully');

    }

}
