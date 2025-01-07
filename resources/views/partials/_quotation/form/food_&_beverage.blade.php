@extends('dashboard.layout')

@section('title', 'Food & Beverage')

@section('content')
<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-3">Add Food & Beverage</h4>
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
                     <a href="{{ route('add.hotel') }}">
                        <button type="button" class="btn btn-info btn-icon-text mx-2" aria-label="Add Hotel Reservation">
                            <i class="ti ti-plus me-2" aria-hidden="true"></i> Add Hotel Reservation
                        </button>
                    </a>
                    <!-- Add Tour Location Button -->
                    <a href="{{ route('add.tour') }}">
                        <button type="button" class="btn btn-info btn-icon-text mx-2" aria-label="Add Tour Location">
                            <i class="ti ti-plus me-2" aria-hidden="true"></i> Add Tour Location
                        </button>
                    </a>
                    <!-- Add Other Service Button -->
                    <a href="">
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
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addTypeofFoodModal" style="width: 100%;">
                <i class="fa-solid fa-circle-plus me-2"></i> Add Type of Food
            </button>
        </div>
    </div>
    @include('popup.food_type')

    <form id="newServiceForm" action="{{route('food.beverage.store')}}" method="POST">
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
                            <th style="width: 40%;">Description</th>
                            <th style="width: 18%;">Rate</th>
                            <th style="width: 13%;">Amount (Rs.)</th>
                            <th style="width: 13%;">Amount ($)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="item-row">
                            <td><strong>Food Type</strong></td>
                            <td>
                                <select name="food_type[]" class="form-control select2" multiple="multiple" style="width: 100%;">
                                    <option value="">Select Food Type</option>
                                    @foreach($foodTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->food_type }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="foodtype_rate" class="form-control" value="0.00" min="0" step="0.01"></td>
                            <td class="foodtype_amount-rs">0.00</td>
                            <td class="foodtype_amount-usd">0.00</td>
                        </tr>
                        <tr class="item-row">
                            <td><strong>Meals</strong></td>
                            <td>
                                <select name="meals[]" class="form-control select2" multiple="multiple" style="width: 100%;">
                                    <option value="">Select Meals</option>
                                    @foreach($meals as $meal)
                                        <option value="{{ $meal->id }}">{{ $meal->meals_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center"> ------ </td>
                            <td class="text-center"> ------ </td>
                            <td class="text-center"> ------ </td>
                        </tr>
                    </tbody>
                </table>

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
        $('.select2').select2({
            placeholder: 'Select an option',
            allowClear: true
        });

        let usdToLkrRate = 0;
        fetchExchangeRate();

        function fetchExchangeRate() {
            fetch('https://api.exchangerate-api.com/v4/latest/USD')
                .then(response => response.json())
                .then(data => {
                    usdToLkrRate = data.rates.LKR;
                    calculateAmounts();
                })
                .catch(error => console.error('Error fetching exchange rate:', error));
        }

        $('input[name="foodtype_rate"]').on('input', function() {
            calculateAmounts();
        });

        function calculateAmounts() {
            $('.item-row').each(function() {
                const rateInput = $(this).find('input[name="foodtype_rate"]');
                const lkrAmountCell = $(this).find('.foodtype_amount-rs');
                const usdAmountCell = $(this).find('.foodtype_amount-usd');

                const rate = parseFloat(rateInput.val()) || 0;
                const lkrAmount = rate;
                const usdAmount = (lkrAmount / usdToLkrRate).toFixed(2);

                lkrAmountCell.text(lkrAmount.toFixed(2));
                usdAmountCell.text(usdAmount);
            });
        }

        $('#newServiceForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });

                    $('#newServiceForm')[0].reset();
                    $('.select2').val(null).trigger('change');

                    $('.foodtype_amount-rs').text('0.00');
                    $('.foodtype_amount-usd').text('0.00');
                },
                error: function(xhr) {
                    let errorMsg = "An error occurred. Please try again.";
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMsg = Object.values(xhr.responseJSON.errors).map(errorArr => errorArr[0]).join('<br>');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: errorMsg,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            });
        });
    });
</script>
@endsection
