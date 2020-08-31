<?php

namespace App\Http\Controllers\Api;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function show(Request $request, Review $review)
    {
        return new ReviewResource($review);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|size:36|unique:reviews',
            'content' => 'required|string',
            'rating' => 'required|in:1,2,3,4,5',
        ]);

        $booking = Booking::findByReviewKey($request->id);

        if ($booking === null) {
            return abort(404);
        }

        $booking->review_key = '';
        $booking->save();

        $review = Review::make($request->all());
        $review->booking_id = $booking->id;
        $review->bookable_id = $booking->bookable_id;
        $review->save();

        return new ReviewResource($review);
    }
}
