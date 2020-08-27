<?php

namespace App\Http\Controllers\Api;

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
}
