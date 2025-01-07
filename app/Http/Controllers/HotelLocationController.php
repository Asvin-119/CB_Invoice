<?php

namespace App\Http\Controllers;

use App\Models\HotelLocation;
use Illuminate\Http\Request;

class HotelLocationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'hotel_location' => 'required|string|max:255',
            'hotel_name' => 'required|string|max:255',
        ]);

        $hotelLocation = HotelLocation::create($request->all());

        // Return JSON response with success message and the created data
        return response()->json([
            'success' => true,
            'message' => 'Hotel Location added successfully.',
            'data' => $hotelLocation
        ]);
    }
}
