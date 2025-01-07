<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\Ticket;
use App\Models\TicketReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TicketReservationController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'quote_id' => 'required|exists:quotations,id',
            'ticket_type' => 'required|exists:tickets,id',
            'ticket_quantity' => 'required|integer|min:1',
            'ticket_rate' => 'required|numeric|min:0',
            'airline_details' => 'nullable|string',
            'booking_summary' => 'nullable|string',
        ]);

        // Calculate the total amount in LKR and USD
        $ticketQuantity = $request->ticket_quantity;
        $ticketRate = $request->ticket_rate;
        $amountLKR = $ticketQuantity * $ticketRate;

        // Get current exchange rate from API
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');
        $data = $response->json();
        $exchangeRate = $data['rates']['LKR'];
        $amountUSD = $amountLKR / $exchangeRate;


        // use this api https://api.exchangerate-api.com/v4/latest/USD

        // Create a new TicketReservation record
        $ticketReservation = TicketReservation::create([
            'quote_id' => $request->quote_id,
            'ticket_id' => $request->ticket_type,
            'ticket_quantity' => $ticketQuantity,
            'ticket_rate' => $ticketRate,
            'ticket_amount_lkr' => $amountLKR,
            'ticket_amount_usd' => $amountUSD,
            'airline_details' => $request->airline_details,
            'booking_summary' => $request->booking_summary,
        ]);

        // Return a response
        if ($ticketReservation) {
            return response()->json(['success' => true, 'message' => 'Ticket reservation created successfully'], 201);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to create ticket reservation'], 500);
        }
    }

    public function edit($id)
    {
        // Fetch the ticket reservation using the provided ID
        $ticketReservation = TicketReservation::findOrFail($id);
        $ticketTypes = Ticket::all();

        // Pass the reservation to the view
        return view('partials._quotation.editTicketReservation', compact('ticketReservation', 'ticketTypes'));
    }

    public function update(Request $request, $id)
    {
       // Validate the incoming data
       $validatedData = $request->validate([
            'ticket_type' => 'required|exists:tickets,id',
            'ticket_quantity' => 'required|integer|min:1',
            'ticket_rate' => 'required|numeric|min:0',
            'airline_details' => 'nullable|string',
            'booking_summary' => 'nullable|string',
        ]);

        // Calculate the total amount in LKR and USD
        $ticketQuantity = $request->ticket_quantity;
        $ticketRate = $request->ticket_rate;
        $amountLKR = $ticketQuantity * $ticketRate;

        // Get current exchange rate from API
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');
        $data = $response->json();
        $exchangeRate = $data['rates']['LKR'];
        $amountUSD = $amountLKR / $exchangeRate;

        // Fetch the ticket reservation using the provided ID
        $ticketReservation = TicketReservation::findOrFail($id);

        // Update the ticket reservation
        $ticketReservation->ticket_id = $request->ticket_type;
        $ticketReservation->ticket_quantity = $ticketQuantity;
        $ticketReservation->ticket_rate = $ticketRate;
        $ticketReservation->ticket_amount_lkr = $amountLKR;
        $ticketReservation->ticket_amount_usd = $amountUSD;
        $ticketReservation->airline_details = $request->airline_details;
        $ticketReservation->booking_summary = $request->booking_summary;
        $ticketReservation->save();

        // Redirect with a success message

        return redirect()->route('quotations.show', $ticketReservation->quote_id)->with('success', 'Ticket reservation updated successfully');
    }


}
