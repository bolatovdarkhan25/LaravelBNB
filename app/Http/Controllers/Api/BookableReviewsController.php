<?php

namespace App\Http\Controllers\Api;

use App\Bookable;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookableReviewIndexResource;
use App\Http\Resources\BookablesIndexResource;
use Illuminate\Http\Request;

class BookableReviewsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Bookable $bookable)
    {
        return BookableReviewIndexResource::collection(
            $bookable->reviews()->latest()->get()
        );
    }
}
