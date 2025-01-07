@extends('dashboard.layout')

@section('title', 'Ticket Reservation and Booking Details')

@section('content')
<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-3">Add Ticket Reservation</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Quotation</li>
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
                    <!-- Add Hotel Reservation Button -->
                     <a href="{{ route('add.hotel')}}">
                        <button type="button" class="btn btn-info btn-icon-text mx-2" aria-label="Add Hotel Reservation">
                            <i class="ti ti-plus me-2" aria-hidden="true"></i> Add Hotel Reservation
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

    <form id="newServiceForm" action="{{ route('ticket.reservations.store')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-center" style="width: 100%">
                        <input type="hidden" name="quote_id" id="quote_id" value="{{ $lastQuote->id }}">
                        <input type="text" style="font-weight: bold" class="form-control" value="{{ $lastQuote->quote_number }}" readonly>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 23%;">Details</th>
                            <th style="width: 22%;">Description</th>
                            <th style="width: 10%;">Quantity</th>
                            <th style="width: 20%;">Rate</th>
                            <th style="width: 15%;">Amount (Rs.)</th>
                            <th style="width: 15%;">Amount ($)</th>
                            {{-- <th style="width: 5%;"></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="item-row">
                            <td><strong>Ticket</strong></td>
                            <td>
                                <select name="ticket_type" class="form-control ticket_type select2" style="width: 100%;">
                                    <option value="">Select Ticket Type</option>
                                    @foreach($ticketTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->ticket_type }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="ticket_quantity" class="form-control ticket_quantity" id="ticket_quantity" value="1" min="1"></td>
                            <td><input type="number" name="ticket_rate" class="form-control ticket_rate" id="ticket_rate" value="0.00" min="0" step="0.01"></td>
                            <td class="ticket_amount-rs" id="ticket_amount-rs">0.00</td>
                            <td class="ticket_amount-usd" id="ticket_amount-usd">0.00</td>
                            {{-- <td>
                                <button type="button" class="btn btn-outline-danger btn-sm delete-row" aria-label="Delete Row">
                                    <i class="ti ti-trash" aria-hidden="true"></i>
                                </button>
                            </td> --}}
                        </tr>
                    </tbody>
                </table>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <div class="col-3 pt-4 ms-3"><strong>Airline Details</strong></div>
                            <div class="col-8">
                                <textarea name="airline_details" id="airline_details" class="form-control" style="resize: none; height: 80px;"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-3 ps-3 pt-4 ms-3"><strong>Booking Summary</strong></div>
                            <div class="col-8">
                                <textarea name="booking_summary" id="booking_summary" class="form-control" style="resize: none; height: 80px;"></textarea>
                            </div>
                        </div>
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
    let usdToLkrRate = 400; // Default value if API call fails

    // Function to fetch the latest exchange rate from the API
    function fetchExchangeRate() {
        fetch('https://api.exchangerate-api.com/v4/latest/USD')
            .then(response => response.json())
            .then(data => {
                usdToLkrRate = data.rates.LKR; // Update the rate dynamically
                calculateAmounts(); // Recalculate amounts with the updated rate
            })
            .catch(error => console.error('Error fetching exchange rate:', error));
    }

    // Function to calculate the LKR and USD amounts
    function calculateAmounts() {
        const quantity = parseFloat(document.querySelector('.ticket_quantity').value) || 0;
        const rate = parseFloat(document.querySelector('.ticket_rate').value) || 0;
        const amountLKR = quantity * rate;
        const amountUSD = amountLKR / usdToLkrRate;

        document.querySelector('.ticket_amount-rs').textContent = amountLKR.toFixed(2);
        document.querySelector('.ticket_amount-usd').textContent = amountUSD.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', function () {
        fetchExchangeRate(); // Fetch exchange rate on page load

        $('.select2').select2();

        const quantityInput = document.querySelector('.ticket_quantity');
        const rateInput = document.querySelector('.ticket_rate');

        quantityInput.addEventListener('input', calculateAmounts);
        rateInput.addEventListener('input', calculateAmounts);

        // Form submission logic
        document.getElementById('newServiceForm').addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(this);
            const csrfToken = document.querySelector('input[name="_token"]').value;

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(errorMessage => {
                        throw new Error(`Server responded with error: ${errorMessage}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Show SweetAlert toast for success
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
                        title: "Ticket reservation saved successfully."
                    });

                    // Reset specific fields after successful submission
                    this.reset(); // Reset the form
                    document.querySelector('.ticket_quantity').value = 1; // Reset quantity to 1
                    document.querySelector('.ticket_rate').value = 0.00; // Reset rate to 0.00
                    document.querySelector('.ticket_amount-rs').textContent = '0.00'; // Reset amount Rs.
                    document.querySelector('.ticket_amount-usd').textContent = '0.00'; // Reset amount $
                    calculateAmounts(); // Recalculate amounts based on default values
                } else {
                    throw new Error('Failed to save data');
                }
            })
            .catch(error => {
                console.error('Error:', error.message);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'An unexpected error occurred.'
                });
            });
        });
    });
</script>
@endsection
