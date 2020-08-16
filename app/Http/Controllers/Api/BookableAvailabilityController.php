<?php

namespace App\Http\Controllers\Api;

use App\Bookable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookableAvailabilityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Bookable $bookable)
    {
        $data = $request->validate([
            'from' => 'required|date|after_or_equal:now',
            'to' => 'required|date|after_or_equal:from'
        ]);

        dd($bookable->bookings()->betweenDates($data['from'], $data['to'])->count());
    }
}
