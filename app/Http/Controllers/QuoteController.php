<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\FoodType;
use App\Models\HotelLocation;
use App\Models\HotelReservation;
use App\Models\HotelType;
use App\Models\Meals;
use App\Models\Quotation;
use App\Models\Service;
use App\Models\Ticket;
use App\Models\TicketReservation;
use App\Models\TourLocation;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotations = Quotation::all();

        return view('partials._quotation.all_quotation', compact('quotations'));
    }

    public function ticket()
    {
        $lastQuote = Quotation::latest()->first();
        $ticketTypes = Ticket::all();

        return view('partials._quotation.form.ticket_reservation', compact('lastQuote', 'ticketTypes'));
    }

    public function hotel()
    {
        $lastQuote = Quotation::latest()->first();
        $hotelTypes = HotelType::all();
        $hotelLocations = HotelLocation::all();

        return view('partials._quotation.form.hotel_reservation', compact('lastQuote', 'hotelTypes', 'hotelLocations'));
    }

    public function food()
    {
        $lastQuote = Quotation::latest()->first();
        $foodTypes = FoodType::all();
        $meals = Meals::all();

        return view('partials._quotation.form.food_&_beverage', compact('lastQuote', 'foodTypes', 'meals'));
    }

    public function tour()
    {
        $lastQuote = Quotation::latest()->first();
        $tourLocations = TourLocation::all();

        return view('partials._quotation.form.tour_location', compact('lastQuote', 'tourLocations'));
    }

    public function service()
    {
        $lastQuote = Quotation::latest()->first();
        $services = Service::all();

        return view('partials._quotation.form.other_services', compact('lastQuote', 'services'));
    }

    public function create()
    {
        $clients = Client::all();

        return view('partials._quotation.quotation', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quote_date' => 'required|date',
            'client_id' => 'required|exists:clients,id',
        ]);

        // Debugging the request data


        // Create the quotation
        $quotation = Quotation::create([
            'quote_date' => $request->quote_date,
            'client_id' => $request->input('client_id'),
        ]);

        return redirect()->route('add.ticket')->with('success', 'Quotation created successfully');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Fetch quotations based on search term
        $quotations = Quotation::with('clients')
            ->where('quote_number', 'LIKE', "%{$searchTerm}%")
            ->orWhereHas('clients', function ($query) use ($searchTerm) {
                $query->where('display_name', 'LIKE', "%{$searchTerm}%");
            })
            ->orWhere('quote_date', 'LIKE', "%{$searchTerm}%")
            ->get();

        // Return JSON response (for Ajax search)
        return response()->json($quotations);
    }


    public function show(Quotation $quotation)
    {
        // Retrieve the ticket reservations for the given quotation
        $ticketReservations = TicketReservation::where('quote_id', $quotation->id)->get();
        // Retrieve the hotel reservations for the given quotation
        $hotelReservations = HotelReservation::where('quote_id', $quotation->id)->get();

        // Pass the quotation and ticketReservations to the view
        return view('partials._quotation.quotation_overview', compact('quotation', 'ticketReservations', 'hotelReservations'));
    }

}
