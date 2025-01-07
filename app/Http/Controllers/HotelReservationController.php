<?php

namespace App\Http\Controllers;

use App\Models\HotelLocation;
use App\Models\HotelReservation;
use App\Models\HotelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HotelReservationController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'quote_id' => 'required|exists:quotations,id',
            'hotel_type' => 'required|exists:hotel_types,id',
            'hotel_locations.*.id' => 'required|exists:hotel_locations,id',
            'hotel_locations.*.hlquantity' => 'required|integer|min:1',
            'hotel_locations.*.rate' => 'required|numeric|min:0',
        ]);

        // Fetch the latest exchange rate for USD to LKR
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');

        if ($response->successful()) {
            $data = $response->json();
            $usdToLkrRate = $data['rates']['LKR'] ?? 400; // Fallback to 400 if the rate is not found
        } else {
            return redirect()->back()->withErrors(['error' => 'Unable to fetch exchange rate.']);
        }

        // Loop through the hotel_locations array and insert each row
        foreach ($request->hotel_locations as $location) {
            HotelReservation::create([
                'quote_id' => $request->quote_id,
                'hotel_type_id' => $request->hotel_type,
                'hotel_location_id' => $location['id'],
                'hlquantity' => $location['hlquantity'],
                'rate' => $location['rate'],
                'hlamount_rs' => $location['hlquantity'] * $location['rate'],
                'hlamount_usd' => ($location['hlquantity'] * $location['rate']) / $usdToLkrRate,
            ]);
        }

        // Redirect to a page with a success message
        return redirect()->route('add.hotel')->with('success', 'Hotel reservations added successfully.');
    }

    public function hotel_store(Request $request)
    {
        $request->validate([
            'hotel_location' => 'required|string|max:255',
            'hotel_name' => 'required|string|max:255',
        ]);

        $hotelLocation = HotelLocation::create($request->all());

        return redirect()->back()->with('success', 'Quote saved successfully!');
    }

    public function edit($id)
    {
        // Find the hotel reservation by ID
        $hotelReservations = HotelReservation::findOrFail($id);

        // Fetch the associated hotel locations and types for the edit form
        $hotelLocations = HotelLocation::all(); // You can filter or paginate as needed
        $hotelTypes = HotelType::all(); // Assuming you have a HotelType model

        // Check if hotelTypes or hotelLocations are empty
        if ($hotelLocations->isEmpty() || $hotelTypes->isEmpty()) {
            // Handle the case where data is not available, e.g., return an error or redirect
            return redirect()->back()->withErrors('Hotel types or locations are unavailable.');
        }

        // Return the edit view with the reservation data and options for hotel locations and types
        return view('partials._quotation.editHotelReservation', compact('hotelReservations', 'hotelLocations', 'hotelTypes'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'hotel_type' => 'required|exists:hotel_types,id',
            'hotel_location_id' => 'required|exists:hotel_locations,id',
            'hlquantity' => 'required|integer|min:1',
            'rate' => 'required|numeric|min:0',
        ]);

        // Fetch the latest exchange rate for USD to LKR
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');

        if ($response->successful()) {
            $data = $response->json();
            $usdToLkrRate = $data['rates']['LKR'] ?? 400; // Fallback to 400 if the rate is not found
        } else {
         Log::error('Exchange rate API failed: ' . $response->body());
            return redirect()->back()->withErrors(['error' => 'Unable to fetch exchange rate.']);
        }

        // Calculate the updated amounts
        $hlAmountRs = $request->hlquantity * $request->rate;
        $hlAmountUsd = $hlAmountRs / $usdToLkrRate;

        // Find the reservation and update its fields
        $reservation = HotelReservation::findOrFail($id);
        $reservation->update([
            'hotel_type_id' => $request->hotel_type,
            'hotel_location_id' => $request->hotel_location_id,
            'hlquantity' => $request->hlquantity,
            'rate' => $request->rate,
            'hlamount_rs' => $hlAmountRs,
            'hlamount_usd' => $hlAmountUsd,
        ]);

        // Redirect back with a success message
        return redirect()->route('add.hotel')->with('success', 'Hotel reservation updated successfully.');
    }
}
