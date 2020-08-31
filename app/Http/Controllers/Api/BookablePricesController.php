<?php

namespace App\Http\Controllers\Api;

use App\Bookable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookablePricesController extends Controller
{
    public function __invoke(Request $request, Bookable $bookable)
    {
        $request->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        $days = Carbon::make($request->from)->diffInDays(Carbon::make($request->to)) + 1;

        $totalPrice = $days * $bookable->price;

        return response()->json([
            'total' => $totalPrice,
            'breakdown' => [
                $bookable->price => $days
            ]
        ]);
    }
}
