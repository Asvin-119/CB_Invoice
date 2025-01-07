@extends('dashboard.layout')

@section('title', 'Other Service Details')

@section('content')
<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-3">Add Other Service</h4>
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
                    <a href="{{route('add.ticket')}}">
                        <button type="button" class="btn btn-info btn-icon-text mx-2" aria-label="Add Ticket Reservation">
                            <i class="ti ti-plus me-2" aria-hidden="true"></i> Add Ticket Reservation
                        </button>
                    </a>
                    <!-- Add Hotel Reservation Button -->
                     <a href="{{route('add.hotel')}}">
                        <button type="button" class="btn btn-info btn-icon-text mx-2" aria-label="Add Hotel Reservation">
                            <i class="ti ti-plus me-2" aria-hidden="true"></i> Add Hotel Reservation
                        </button>
                    </a>
                    <!-- Add Food & Beverage Button -->
                    <a href="{{route('add.food')}}">
                        <button type="button" class="btn btn-info btn-icon-text mx-2" aria-label="Add Food & Beverage">
                            <i class="ti ti-plus me-2" aria-hidden="true"></i> Add Food & Beverage
                        </button>
                    </a>
                    <!-- Add Tour Location Button -->
                    <a href="{{route('add.tour')}}">
                        <button type="button" class="btn btn-info btn-icon-text mx-2" aria-label="Add Tour Location">
                            <i class="ti ti-plus me-2" aria-hidden="true"></i> Add Tour Location
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row pb-4">
        <div class="col-md-9"></div>
        <div class="col-md-3 pt-2">
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addOtherServiceModal" style="width: 100%;">
                <i class="fa-solid fa-circle-plus me-2"></i> Add Service
            </button>
        </div>
    </div>

    @include('popup.service')

    <form id="newServiceForm" action="{{route('other.service.store')}}" method="POST">
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
                            <td><strong>Service 1</strong></td>
                            <td>
                                <select name="Tour_locations[0][id]" class="form-control select2" style="width: 100%;">
                                    <option value="">Select Service</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="service[0][rate]" class="form-control" value="0.00" min="0" step="0.01"></td>
                            <td class="service_amount-rs">0.00</td>
                            <td class="service_amount-usd">0.00</td>
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
    $(document).ready(function() {
        let usdToLkrRate = 400; // Default exchange rate if API call fails

        // Function to fetch the latest exchange rate from the API
        function fetchExchangeRate() {
            fetch('https://api.exchangerate-api.com/v4/latest/USD')
                .then(response => response.json())
                .then(data => {
                    usdToLkrRate = data.rates.LKR; // Update the conversion rate
                    calculateAmounts(); // Recalculate amounts using the updated rate
                })
                .catch(error => console.error('Error fetching exchange rate:', error));
        }

        // Function to calculate the amounts in LKR and USD for each row
        function calculateAmounts() {
            $('.item-row').each(function() {
                // Get the rate value from the input
                let rate = parseFloat($(this).find('input[name^="service["][name$="[rate]"]').val()) || 0;

                // Calculate amounts
                let amountLKR = rate; // Assuming the rate is in LKR
                let amountUSD = (rate / usdToLkrRate).toFixed(2); // Convert to USD using the current exchange rate

                // Update the table cells with the calculated amounts
                $(this).find('.service_amount-rs').text(amountLKR.toFixed(2));
                $(this).find('.service_amount-usd').text(amountUSD);
            });
        }

        // Fetch the latest exchange rate when the page loads
        fetchExchangeRate();

        // Event listener to calculate amounts whenever the rate input changes
        $(document).on('input', 'input[name^="service["][name$="[rate]"]', function() {
            calculateAmounts();
        });

        // Initialize Select2 with search functionality
        $('.select2').select2({
            width: 'resolve',
            dropdownParent: $('.container-fluid'), // Ensures dropdown opens within a specific parent element
            placeholder: "Select an option", // Placeholder text
            allowClear: true // Option to clear selection
        });

        // Add a new row and reinitialize the select2 plugin
        $('#add-row').on('click', function(event) {
            event.preventDefault();

            let rowCount = $('.item-row').length;
            let newRow = `
                <tr class="item-row">
                    <td><strong>Service ${rowCount + 1}</strong></td>
                    <td>
                        <select name="Tour_locations[${rowCount}][id]" class="form-control select2" style="width: 100%;">
                            <option value="">Select Service</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="service[${rowCount}][rate]" class="form-control" value="0.00" min="0" step="0.01"></td>
                    <td class="service_amount-rs">0.00</td>
                    <td class="service_amount-usd">0.00</td>
                    <td><button type="button" class="btn btn-danger btn-sm delete-row"><i class="fa-solid fa-trash"></i></button></td>
                </tr>
            `;

            $('table tbody').append(newRow);
            $('.select2').select2({ width: 'resolve' }); // Reinitialize Select2 on the new row
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

        // Handle form submission with AJAX
        $('#newServiceForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Display SweetAlert2 notification on success
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });

                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    });

                    // Reset the form after successful submission
                    $('#newServiceForm')[0].reset();

                    // Clear any dynamic rows (except the first one)
                    $('table tbody').find('.item-row:gt(0)').remove(); // Keep the first row

                    // Reset the "Amount (Rs.)" and "Amount ($)" fields to "0.00"
                    $('table tbody').find('.service_amount-rs').text('0.00');
                    $('table tbody').find('.service_amount-usd').text('0.00');

                    // Reinitialize Select2
                    $('.select2').select2({ width: 'resolve' });

                    // Optionally, you can redirect if needed
                    // window.location.href = "{{ route('add.service') }}";
                },
                error: function(xhr) {
                    // Handle errors (optional)
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: xhr.responseJSON.message,
                        });
                    }
                }
            });
        });
    });
</script>
@endsection
