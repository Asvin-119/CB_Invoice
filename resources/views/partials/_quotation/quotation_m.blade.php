@extends('dashboard.layout')

@section('title', 'Ticket Reservation and Booking Details')

@section('content')

<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-3">Ticket Reservation</h4>
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
                     <a href="">
                        <button type="button" class="btn btn-info btn-icon-text mx-2" aria-label="Add Hotel Reservation">
                            <i class="ti ti-plus me-2" aria-hidden="true"></i> Add Hotel Reservation
                        </button>
                    </a>
                    <!-- Add Food & Beverage Button -->
                    <a href="">
                        <button type="button" class="btn btn-info btn-icon-text mx-2" aria-label="Add Food & Beverage">
                            <i class="ti ti-plus me-2" aria-hidden="true"></i> Add Food & Beverage
                        </button>
                    </a>
                    <!-- Add Tour Location Button -->
                    <a href="">
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

    <form id="newServiceForm" action="" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-center" style="width: 100%">
                    <input type="text" style="font-weight: bold" name="quote_id" id="quote_id" class="form-control" value="{{ $lastQuote->quote_number }}" readonly>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 20%;">Details</th>
                            <th style="width: 20%;">Description</th>
                            <th style="width: 10%;">Quantity</th>
                            <th style="width: 20%;">Rate</th>
                            <th style="width: 15%;">Amount (Rs.)</th>
                            <th style="width: 15%;">Amount ($)</th>
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
                    <a href="" class="btn btn-icon-text" style="background: #eeeeee;">
                        <i class="mdi mdi-cancel btn-icon-prepend"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
