<?php

namespace App\Http\Controllers;

use App\Models\TourLocation;
use App\Models\TourLocationTransport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TourLocationTransportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'quote_id' => 'required|exists:quotations,id',
            'Tour_locations.*.id' => 'required|exists:tour_locations,id',
            'Tour_locations.*.rate' => 'required|numeric|min:0',
        ]);

        // Fetch the latest exchange rate for USD to LKR
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');

        if ($response->successful()) {
            $exchangeRateData = $response->json();
            $usdToLkrRate = $exchangeRateData['rates']['LKR'] ?? 400; // Fallback to 400 if not available

            // Loop through the tour locations and save them
            foreach ($request->Tour_locations as $location) {
                $rate = $location['rate'];
                $amountRs = $rate; // Assuming rate is in LKR
                $amountUsd = $rate / $usdToLkrRate; // Convert to USD

                TourLocationTransport::create([
                    'quote_id' => $request->quote_id,
                    'tour_location_id' => $location['id'],
                    'rate' => $rate,
                    'touramount_rs' => $amountRs,
                    'touramount_usd' => $amountUsd,
                ]);
            }

            // Redirect back with a success message
            return response()->json(['success' => true, 'message' => 'Tour location saved successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to fetch exchange rate.'], 500);
        }
    }

    public function tour_store(Request $request)
    {
        $request->validate([
            'tour_location' => 'required|string|max:255',
            'tour_places_name' => 'required|string|max:255',
        ]);

        TourLocation::create($request->all());

        // Redirect back with success message
        return redirect()->back()->with('success', 'Tour Location added successfully.');
    }
}
