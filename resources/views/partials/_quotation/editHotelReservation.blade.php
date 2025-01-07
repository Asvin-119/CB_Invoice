@extends('dashboard.layout')

@section('title', 'Edit Ticket Reservation')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg border-info rounded-3">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h2 class="page-title">Edit Hotel Reservation</h2>
                <a href="{{ route('quotations.show', $hotelReservations->quote_id) }}" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" title="View Quotation">
                    <i class="fa fa-eye"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('hotel_reservations.update', $hotelReservations->id) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Hotel Type Dropdown -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="hotel_type" class="form-label">Type of Hotel</label>
                            <select class="form-control select2" id="hotel_type" name="hotel_type">
                                @foreach($hotelTypes as $hotelType)
                                <option value="{{ $hotelType->id }}" {{ $hotelReservations->hotel_type_id ==  $hotelType->id ? 'selected' : '' }}>
                                    {{ $hotelType->hotel_type }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Hotel Location Dropdown -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="hotel_locations" class="form-label">Hotel Locations</label>
                            <select class="form-control select2" id="hotel_locations" name="hotel_locations">
                                @foreach($hotelLocations as $hotelLocation)
                                <option value="{{ $hotelLocation->id }}" {{ $hotelReservations->hotel_location_id ==  $hotelLocation->id ? 'selected' : '' }}>
                                    {{ $hotelLocation->hotel_location }} - {{ $hotelLocation->hotel_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Ticket Rate -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="rate" class="form-label">Rate (per unit in LKR)</label>
                            <input type="number" class="form-control" id="rate" name="rate" value="{{ $hotelReservations->rate }}" min="0" step="any">
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="col-md-4" style="display: none">
                        <div class="mb-3">
                            <label for="hlquantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="hlquantity" name="hlquantity" value="{{ old('hlquantity', $hotelReservations->hlquantity ?? '') }}" min="1">
                        </div>
                    </div>

                    <!-- Amount in LKR -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="location_amount_rs" class="form-label">Amount (LKR)</label>
                            <input type="number" class="form-control" id="location_amount_rs" name="location_amount_rs"
                            value="{{ $hotelReservations->hlamount_rs }}" readonly>
                        </div>
                    </div>

                    <!-- Amount in USD -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="location_amount_usd" class="form-label">Amount (USD)</label>
                            <input type="number" class="form-control" id="location_amount_usd" name="location_amount_usd"
                                value="{{ $hotelReservations->hlamount_usd }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-primary btn-sm">Update</button>
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

    // Calculate amounts dynamically
    function calculateAmounts() {
        const quantity = parseFloat(document.getElementById('hlquantity').value) || 0;
        const rate = parseFloat(document.getElementById('rate').value) || 0;

        const amountLKR = quantity * rate;
        const amountUSD = amountLKR / usdToLkrRate;

        document.getElementById('location_amount_rs').value = amountLKR.toFixed(2);
        document.getElementById('location_amount_usd').value = amountUSD.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Initialize Select2 for dropdowns
        $('.select2').select2();

        // Fetch the latest exchange rate on page load
        fetchExchangeRate();

        // Add event listeners to recalculate amounts on input
        document.getElementById('hlquantity').addEventListener('input', calculateAmounts);
        document.getElementById('rate').addEventListener('input', calculateAmounts);
    });
</script>
@endsection
