@extends('dashboard.layout')

@section('title', 'Edit Ticket Reservation')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg border-info rounded-3">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h2 class="page-title">Edit Ticket Reservation</h2>
                <a href="{{ route('quotations.show', $ticketReservation->quote_id) }}" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" title="View Quotation">
                    <i class="fa fa-eye"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('ticket-reservations.update', $ticketReservation->id) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Ticket Type Dropdown -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="ticket_type" class="form-label">Ticket Type</label>
                            <select class="form-control" id="ticket_type" name="ticket_type">
                                @foreach($ticketTypes as $ticketType)
                                    <option value="{{ $ticketType->id }}" {{ $ticketReservation->ticket_id == $ticketType->id ? 'selected' : '' }}>
                                        {{ $ticketType->ticket_type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Ticket Quantity -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="ticket_quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="ticket_quantity" name="ticket_quantity" value="{{ $ticketReservation->ticket_quantity }}">
                        </div>
                    </div>

                    <!-- Ticket Rate -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="ticket_rate" class="form-label">Rate ($)</label>
                            <input type="number" class="form-control" id="ticket_rate" name="ticket_rate" value="{{ $ticketReservation->ticket_rate }}" step="0.01">
                        </div>
                    </div>

                    <!-- Amount in LKR -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="ticket_amount_lkr" class="form-label">Amount (LKR)</label>
                            <input type="number" class="form-control" id="ticket_amount_lkr" name="ticket_amount_lkr" value="{{ $ticketReservation->ticket_amount_lkr }}" readonly>
                        </div>
                    </div>

                    <!-- Amount in USD (Readonly) -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="ticket_amount_usd" class="form-label">Amount (USD)</label>
                            <input type="number" class="form-control" id="ticket_amount_usd" name="ticket_amount_usd" value="{{ $ticketReservation->ticket_amount_usd }}" readonly>
                        </div>
                    </div>

                    <!-- Airline Details -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="airline_details" class="form-label">Airline Details</label>
                            <textarea class="form-control" id="airline_details" name="airline_details">{{ $ticketReservation->airline_details }}</textarea>
                        </div>
                    </div>

                    <!-- Booking Summary -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="booking_summary" class="form-label">Booking Summary</label>
                            <textarea class="form-control" id="booking_summary" name="booking_summary">{{ $ticketReservation->booking_summary }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-primary btn-sm">Update Reservation</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let usdToLkrRate = 400; // Default rate

    // Fetch the latest exchange rate
    function fetchExchangeRate() {
        fetch('https://api.exchangerate-api.com/v4/latest/USD')
            .then(response => response.json())
            .then(data => {
                usdToLkrRate = data.rates.LKR; // Update exchange rate
                console.log('Updated Exchange Rate (LKR):', usdToLkrRate);
                calculateAmounts(); // Recalculate amounts
            })
            .catch(error => console.error('Exchange rate fetch failed:', error));
    }

    // Recalculate amounts in USD and LKR
    function calculateAmounts() {
        const quantity = parseFloat(document.getElementById('ticket_quantity').value) || 0;
        const rate = parseFloat(document.getElementById('ticket_rate').value) || 0;
        const amountLkr = quantity * rate;
        const amountUsd = amountLkr / usdToLkrRate;

        document.getElementById('ticket_amount_lkr').value = amountLkr.toFixed(2);
        document.getElementById('ticket_amount_usd').value = amountUsd.toFixed(2);
    }

    // Initialize Select2 and input listeners
    $(document).ready(function () {
        $('.ticket_type').select2();

        $('#ticket_quantity, #ticket_rate').on('input', calculateAmounts);

        fetchExchangeRate(); // Fetch initial rate
    });
</script>
@endsection
