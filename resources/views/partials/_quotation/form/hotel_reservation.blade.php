@extends('dashboard.layout')

@section('title', 'Hotel Reservation and Booking Details')

@section('content')
<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-3">Add Hotel Reservation</h4>
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
                    <a href="{{ route('add.ticket')}}">
                        <button type="button" class="btn btn-info btn-icon-text mx-2" aria-label="Add Ticket Reservation">
                            <i class="ti ti-plus me-2" aria-hidden="true"></i> Add Ticket Reservation
                        </button>
                    </a>
                    <!-- Add Food & Beverage Button -->
                    <a href="{{ route('add.food')}}">
                        <button type="button" class="btn btn-info btn-icon-text mx-2" aria-label="Add Food & Beverage">
                            <i class="ti ti-plus me-2" aria-hidden="true"></i> Add Food & Beverage
                        </button>
                    </a>
                    <!-- Add Tour Location Button -->
                    <a href="{{ route('add.tour')}}">
                        <button type="button" class="btn btn-info btn-icon-text mx-2" aria-label="Add Tour Location">
                            <i class="ti ti-plus me-2" aria-hidden="true"></i> Add Tour Location
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
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addHotelLocationModal" style="width: 100%;">
                <i class="fa-solid fa-circle-plus me-2"></i> Add Hotel Location
            </button>
        </div>
    </div>
    @include('popup.hotel_location')

    <form id="newHotelReservationForm" action="{{ route('hotel.reservations.store')}}" method="POST">
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
                            <th style="width: 31%;">Description</th>
                            <th style="width: 10%; display: none;">hlQuantity</th>
                            <th style="width: 18%;">Rate</th>
                            <th style="width: 13%;">Amount (Rs.)</th>
                            <th style="width: 13%;">Amount ($)</th>
                            <th style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="item-row">
                            <td><strong>Hotel Type</strong></td>
                            <td>
                                <select name="hotel_type" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Hotel Type</option>
                                    @foreach($hotelTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->hotel_type }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center" style="display: none"> ------ </td>
                            <td class="text-center"> ------ </td>
                            <td class="text-center"> ------ </td>
                            <td class="text-center"> ------ </td>
                            <td class="text-center"></td>
                        </tr>
                        <tr class="item-row">
                            <td><strong>Hotel Location 1</strong></td>
                            <td>
                                <select name="hotel_locations[0][id]" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Hotel Location</option>
                                    @foreach($hotelLocations as $location)
                                        <option value="{{ $location->id }}">{{ $location->hotel_location }} - {{ $location->hotel_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td style="display: none"><input type="number" name="hotel_locations[0][hlquantity]" class="form-control" value="1" min="1"></td>
                            <td><input type="number" name="hotel_locations[0][rate]" class="form-control" value="0.00" min="0" step="0.01"></td>
                            <td class="location_amount-rs">0.00</td>
                            <td class="location_amount-usd">0.00</td>
                            <td></td>
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
    let usdToLkrRate = 400; // Default exchange rate
    let locationIndex = 1; // Keeps track of number of rows

    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select",
            allowClear: true
        });

        // Fetch exchange rate
        fetchExchangeRate();

        // Add new row for hotel location
        $('#add-row').on('click', function(e) {
            e.preventDefault();
            addNewRow();
        });

        // Handle dynamic input changes
        $(document).on('input', 'input[name^="hotel_locations"]', function() {
            calculateAmounts();
        });

        // Initial calculation
        calculateAmounts();

        // AJAX form submission
        $('#newHotelReservationForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Send the AJAX request
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                success: function(response) {
                    // Show success toast on successful submission
                    showSuccessToast('Hotel reservation saved successfully');
                    // Remove all rows except the first two
                    $('tr.item-row').slice(2).remove();
                    // Reset input values for the first two rows
                    resetFormRows();
                    // Redirect to the hotel reservation page
                    // window.location.href = "{{ route('add.hotel') }}"; // Adjust the route as needed
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: xhr.responseJSON.message || 'Something went wrong!'
                    });
                }
            });
        });
    });

    // Fetch exchange rate from API
    function fetchExchangeRate() {
        fetch('https://api.exchangerate-api.com/v4/latest/USD')
            .then(response => response.json())
            .then(data => {
                usdToLkrRate = data.rates.LKR;
                calculateAmounts();
            })
            .catch(error => console.error('Error fetching exchange rate:', error));
    }

    // Add new row dynamically
    function addNewRow() {
        locationIndex++;
        let newRow = `
            <tr class="item-row">
                <td><strong>Hotel Location ${locationIndex}</strong></td>
                <td>
                    <select name="hotel_locations[${locationIndex}][id]" class="form-control select2" style="width: 100%;">
                        <option value="">Select Hotel Location</option>
                        @foreach($hotelLocations as $location)
                            <option value="{{ $location->id }}">{{ $location->hotel_location }} - {{ $location->hotel_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td style="display: none"><input type="number" name="hotel_locations[${locationIndex}][hlquantity]" class="form-control" value="1" min="1"></td>
                <td><input type="number" name="hotel_locations[${locationIndex}][rate]" class="form-control" value="0.00" min="0" step="0.01"></td>
                <td class="location_amount-rs">0.00</td>
                <td class="location_amount-usd">0.00</td>
                <td><button type="button" class="btn btn-danger btn-sm delete-row"><i class="fa-solid fa-trash"></i></button></td>
            </tr>
        `;
        $('table tbody').append(newRow);
        $('.select2').select2({ placeholder: "Select", allowClear: true });
    }

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

    // Calculate amounts in Rs. and USD
    function calculateAmounts() {
        $('tr.item-row').each(function() {
            let locationhlQuantity = parseFloat($(this).find('input[name*="[hlquantity]"]').val()) || 0;
            let locationRate = parseFloat($(this).find('input[name*="[rate]"]').val()) || 0;
            let locationAmountRs = locationhlQuantity * locationRate;
            let locationAmountUsd = locationAmountRs / usdToLkrRate;

            $(this).find('.location_amount-rs').text(locationAmountRs.toFixed(2));
            $(this).find('.location_amount-usd').text(locationAmountUsd.toFixed(2));
        });
    }

    // Reset input values for the first two rows
    function resetFormRows() {
        $('tr.item-row').each(function(index) {
            if (index < 2) { // Reset first two rows only
                $(this).find('select').val(null).trigger('change');
                $(this).find('input[name*="[hlquantity]"]').val(1);
                $(this).find('input[name*="[rate]"]').val(0.00);
                $(this).find('.location_amount-rs').text('0.00');
                $(this).find('.location_amount-usd').text('0.00');
            }
        });
    }

    // SweetAlert function for success notification
    function showSuccessToast(message) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: message
        });
    }
</script>

@endsection
