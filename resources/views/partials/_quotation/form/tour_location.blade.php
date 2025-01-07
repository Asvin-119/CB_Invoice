@extends('dashboard.layout')

@section('title', 'Tour Location Transport Details')

@section('content')
<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-3">Add Tour Location</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Quotation</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3 text-center mb-n5">
                    <img src="{{ asset('dist/images/breadcrumb/ChatBc.png') }}" alt="" class="img-fluid mb-n4">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-flex justify-content-between">
                    <!-- Add Ticket Reservation Button -->
                    <a href="{{ route('add.ticket') }}">
                        <button type="button" class="btn btn-info btn-icon-text mx-2" aria-label="Add Ticket Reservation">
                            <i class="ti ti-plus me-2" aria-hidden="true"></i> Add Ticket Reservation
                        </button>
                    </a>
                    <!-- Add Hotel Reservation Button -->
                     <a href="{{ route('add.hotel') }}">
                        <button type="button" class="btn btn-info btn-icon-text mx-2" aria-label="Add Hotel Reservation">
                            <i class="ti ti-plus me-2" aria-hidden="true"></i> Add Hotel Reservation
                        </button>
                    </a>
                    <!-- Add Food & Beverage Button -->
                    <a href="{{ route('add.food') }}">
                        <button type="button" class="btn btn-info btn-icon-text mx-2" aria-label="Add Food & Beverage">
                            <i class="ti ti-plus me-2" aria-hidden="true"></i> Add Food & Beverage
                        </button>
                    </a>
                    <!-- Add Other Service Button -->
                    <a href="{{ route('add.service') }}">
                        <button type="button" class="btn btn-info btn-icon-text mx-2" aria-label="Add Other Service">
                            <i class="ti ti-plus me-2" aria-hidden="true"></i> Add Other Service
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row pb-4">
        <div class="col-md-9"></div>
        <div class="col-md-3 pt-2">
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addTourLocationModal" style="width: 100%;">
                <i class="fa-solid fa-circle-plus me-2"></i> Add Tour Location
            </button>
        </div>
    </div>

    @include('popup.tour_location')

    <form id="newServiceForm" action="{{ route('tour.transports.store')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-center" style="width: 100%">
                    <input type="hidden" name="quote_id" id="quote_id" value="{{ $lastQuote->id }}">
                    <input type="text" style="font-weight: bold" class="form-control" value="{{ $lastQuote->quote_number }}" readonly>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 15%;">Details</th>
                            <th style="width: 35%;">Description</th>
                            <th style="width: 18%;">Rate</th>
                            <th style="width: 13%;">Amount (Rs.)</th>
                            <th style="width: 13%;">Amount ($)</th>
                            <th style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="item-row">
                            <td><strong>Tour Location 1</strong></td>
                            <td>
                                <select name="Tour_locations[0][id]" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Tour Location</option>
                                    @foreach($tourLocations as $location)
                                        <option value="{{ $location->id }}">{{ $location->tour_location }} - {{ $location->tour_places_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="Tour_locations[0][rate]" class="form-control" value="0.00" min="0" step="0.01"></td>
                            <td class="location_amount-rs">0.00</td>
                            <td class="location_amount-usd">0.00</td>
                        </tr>
                    </tbody>
                </table>

                <div class="row pb-4">
                    <div class="col-md-6 pt-2">
                        <button class="btn btn-secondary" id="add-row" data-bs-toggle="tooltip" data-bs-placement="top" title="Add New Row">
                            <i class="fa-solid fa-circle-plus me-2"></i> Add New Row
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary btn-icon-text mx-2">
                        <i class="mdi mdi-content-save btn-icon-prepend"></i> Save
                    </button>
                    <a href="{{ route('quotes.index') }}" class="btn btn-icon-text" style="background: #eeeeee;">
                        <i class="mdi mdi-cancel btn-icon-prepend"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')

<script>
    let usdToLkrRate = 400; // Initial rate
    const tableBody = document.querySelector('table tbody');

    function fetchExchangeRate() {
        fetch('https://api.exchangerate-api.com/v4/latest/USD')
            .then(response => response.json())
            .then(data => {
                usdToLkrRate = data.rates.LKR;
                console.log('Current USD to LKR Rate:', usdToLkrRate);
                calculateAmounts(); // Call calculate after fetching the latest rate
            })
            .catch(error => console.error('Error fetching exchange rate:', error));
    }

    function calculateAmounts() {
        const rows = document.querySelectorAll('.item-row');
        rows.forEach((row, index) => {
            const rateInput = row.querySelector(`input[name="Tour_locations[${index}][rate]"]`);
            const locationAmountRs = row.querySelector('.location_amount-rs');
            const locationAmountUsd = row.querySelector('.location_amount-usd');

            // Calculate Amounts
            const rate = parseFloat(rateInput.value) || 0; // Get the rate, default to 0 if invalid
            const amountRs = rate; // Amount in Rs.
            const amountUsd = rate / usdToLkrRate; // Amount in USD

            // Update amounts in the table
            locationAmountRs.textContent = amountRs.toFixed(2); // Amount in Rs.
            locationAmountUsd.textContent = amountUsd.toFixed(2); // Amount in USD
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        fetchExchangeRate(); // Fetch the initial exchange rate

        // Initialize Select2 for existing select elements
        $('.select2').select2();

        let rowIndex = 1; // Start indexing for new rows
        const addRowButton = document.getElementById('add-row');

        addRowButton.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default form submission

            // Create a new row
            const newRow = document.createElement('tr');
            newRow.classList.add('item-row');

            newRow.innerHTML = `
                <td><strong>Tour Location ${rowIndex + 1}</strong></td>
                <td>
                    <select name="Tour_locations[${rowIndex}][id]" class="form-control select2" style="width: 100%;">
                        <option value="">Select Tour Location</option>
                        @foreach($tourLocations as $location)
                            <option value="{{ $location->id }}">{{ $location->tour_location }} - {{ $location->tour_places_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="Tour_locations[${rowIndex}][rate]" class="form-control" value="0.00" min="0" step="0.01"></td>
                <td class="location_amount-rs">0.00</td>
                <td class="location_amount-usd">0.00</td>
                <td><button type="button" class="btn btn-danger btn-sm delete-row"><i class="fa-solid fa-trash"></i></button></td>
            `;

            tableBody.appendChild(newRow);
            rowIndex++;

            // Initialize Select2 for the new row's select element
            $(newRow).find('.select2').select2();

            calculateAmounts(); // Recalculate amounts for new row
        });

        // Event delegation for delete-row functionality
        document.querySelector('table tbody').addEventListener('click', function (e) {
            if (e.target.classList.contains('delete-row') || e.target.closest('.delete-row')) {
                e.target.closest('tr').remove();
                calculateAmounts(); // Recalculate amounts after removing a row
            }
        });

        // Recalculate amounts on rate input change
        document.querySelector('table tbody').addEventListener('input', function (e) {
            if (e.target.name === "hotel_rates[]") {
                calculateAmounts(); // Recalculate amounts when the rate field is changed
            }
        });

        // Event delegation for rate input changes
        tableBody.addEventListener('input', function (event) {
            if (event.target.matches('input[name*="[rate]"]')) {
                calculateAmounts(); // Recalculate amounts on rate input change
            }
        });

        // Handle form submission
        const newServiceForm = document.getElementById('newServiceForm');
        newServiceForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            const formData = new FormData(newServiceForm); // Get the form data

            // Send the form data using fetch API
            fetch(newServiceForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-Token': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                // Show success notification
                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Tour Location Transport saved successfully",
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });

                    // Reset the form
                    newServiceForm.reset(); // Reset the form fields

                    // Clear added rows from the table if necessary
                    const rows = document.querySelectorAll('.item-row');
                    rows.forEach((row, index) => {
                        if (index > 0) { // Keep the first row
                            row.remove();
                        }
                    });

                    // Recalculate amounts in case the first row's rate is still set
                    calculateAmounts();
                } else {
                    // Handle validation errors or any other error messages
                    Swal.fire({
                        icon: "error",
                        title: "Oops!",
                        text: data.message || "Something went wrong!",
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: "error",
                    title: "Oops!",
                    text: "Network error or server issue!",
                });
            });
        });
    });
</script>
@endsection
