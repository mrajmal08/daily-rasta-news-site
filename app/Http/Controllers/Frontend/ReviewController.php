<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Validator;
use Redirect;

class ReviewController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $review = new Review();
        $review->name = $request->name;
        $review->email = $request->email;
        $review->review = $request->review;
        $review->save();

        return redirect()->back()->with('success', 'Review Submitted Successfully');
    }

    public  function guest()
    {

        $guest = Auth::guest();

        // dd($guest);

        return view('frontend.guest');
    }
}
