<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Review;
use App\Models\Video;
use App\Models\Blog;
use App\Models\News;
use Validator;
use Redirect;

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

        $videos = Video::take(10)->get();
        //categoreis
        $latest_categories = Category::take(3)->orderBy('id', 'DESC')->get();

        return view('welcome', compact('breaking_news', 'recent_news', 'latest_news', 'popular_news', 'latest_categories', 'trending_news', 'blogs' ,'videos'));
    }

    public function about()
    {
        return view('frontend.aboutus');
    }

    public function contact()
    {
        return view('frontend.contactus');
    }

    public function contactStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $contact = new Contact();
        $contact['name'] = $request->name;
        $contact['email'] = $request->email;
        $contact['comment'] = $request->comment;
        $contact['subject'] = $request->subject;
        $contact['user_id'] = auth()->user()->id;
        $contact->save();
        return redirect()->back()->with('message', 'پیغام کامیابی کے ساتھ جمع ہو گیا۔');

    }

    public function categories()
    {
        $categories = Category::paginate(4);
        $recent_categories = Category::take(8)->orderBy('id', 'DESC')->get();

        return view('frontend.categories', compact('categories', 'recent_categories'));
    }

    public function categoryDetail($slug)
    {

        $category = Category::where('slug', $slug)->first();
        $news = News::where('cat_id', $category->id)->paginate(6);

        return view('frontend.category_detail', compact('news', 'category'));
    }

    public function newsDetail($slug)
    {

        $news = News::where('slug', $slug)->first();

        $previous_clicks = News::where('id', '=', $news->id)->pluck('clicks')->first();
        $new_clicks = $previous_clicks + 1;
        News::where('id', '=', $news->id)->update(['clicks' => $new_clicks]);

        $recent_news = News::take(5)->orderBy('id', 'DESC')->get();
        $news = News::find($news->id);

        $category = Category::find($news->cat_id);
        $categories = Category::take(8)->orderBy('id', 'DESC')->get();

        //get reviews
        $reviews = Review::where('post_id', '=', $news->id)->where('type', 'news')->get();

        return view('frontend.news_detail', compact('recent_news', 'news', 'category', 'categories', 'reviews'));

    }

    public function blog()
    {

        $blog = Blog::paginate(5);
        $recent_categories = Category::take(8)->orderBy('id', 'DESC')->get();
        $recent_blog = Blog::take(5)->orderBy('id', 'DESC')->get();
        return view('frontend.blog', compact('blog', 'recent_categories', 'recent_blog'));
    }

    public function blogDetail($slug)
    {

        $blog_detail = Blog::where('slug', $slug)->first();

        $previous_clicks = Blog::where('id', '=', $blog_detail->id)->pluck('total_clicks')->first();
        $new_clicks = $previous_clicks + 1;
        Blog::where('id', '=', $blog_detail->id)->update(['total_clicks' => $new_clicks]);

        $blog = Blog::find($blog_detail->id);
        $categories = Category::take(8)->orderBy('id', 'DESC')->get();
        $recent_blog = Blog::take(5)->orderBy('id', 'DESC')->get();
        $reviews = Review::where('post_id', '=', $blog_detail->id)->where('type', 'blog')->get();

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

        if ($request->type == 'news') {
            $review['post_id'] = $request->news_id;
            $review['type'] = 'news';
        } else {
            $review['post_id'] = $request->blog_id;
            $review['type'] = 'blog';
        }

        $review['name'] = $request->name;
        $review['email'] = $request->email;
        $review['comment'] = $request->comment;
        $review['user_id'] = $user_id;
        $review->save();

        return redirect()->back()->with('message', 'ریویو کامیابی کے ساتھ جمع کر دیا گیا۔');

    }

    public function terms()
    {
        $recent_news = News::take(5)->orderBy('id', 'DESC')->get();
        return view('frontend.terms', compact('recent_news'));
    }

    public function privacyPolicy()
    {
        $recent_news = News::take(5)->orderBy('id', 'DESC')->get();
        return view('frontend.privacy_policy', compact('recent_news'));

    }

    public function staff()
    {

        return view('frontend.staff');
    }

}
