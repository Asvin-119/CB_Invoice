<?php

namespace App\Http\Controllers;

use App\Models\OtherService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OtherServiceController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'quote_id' => 'required|exists:quotations,id',
            'Tour_locations' => 'required|array',
            'Tour_locations.*.id' => 'required|exists:services,id',
            'service' => 'required|array',
            'service.*.rate' => 'required|numeric|min:0',
        ]);

        // Fetch the latest exchange rate for USD to LKR
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');

        // Check if the response is successful
        if ($response->successful()) {
            $exchangeRateData = $response->json();
            $usdToLkrRate = $exchangeRateData['rates']['LKR'] ?? 400; // Fallback to 400 if not available
        } else {
            return response()->json(['message' => 'Failed to fetch exchange rate.'], 500);
        }

        $quoteId = $request->input('quote_id');
        $services = $request->input('service');
        $tourLocations = $request->input('Tour_locations');

        foreach ($services as $index => $service) {
            $serviceId = $tourLocations[$index]['id'];
            $rate = $service['rate'];
            $amountLKR = $rate; // Calculate amount in LKR
            $amountUSD = $rate / $usdToLkrRate; // Assuming the rate is in USD

            OtherService::create([
                'quote_id' => $quoteId,
                'service_id' => $serviceId,
                'rate' => $rate,
                'serviceamount_lkr' => $amountLKR,
                'serviceamount_usd' => $amountUSD,
            ]);
        }

        return response()->json(['message' => 'Other Service details added successfully.']);
    }

    public function service_store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
        ]);

        Service::create($request->all());

        // Redirect back with success message
        return redirect()->back()->with('success', 'Service added successfully.');
    }

}
