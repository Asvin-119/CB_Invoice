@extends('dashboard.layout')

@section('title', 'Client Form')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg border-info rounded-3 pt-3">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h2 class="page-title">Hotel Reservations</h2>
                @foreach ($hotelReservations as $hotelReservation)
                <a href="{{ route('hotel_reservations.edit', $hotelReservation->id) }}" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" title="Edit">
                    <i class="fa fa-pencil"></i>
                </a>
                @endforeach
            </div>

        </div>
        <div class="card-body">
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center" style="width: 55%">Description</th>
                            <th style="width: 20%">Amount ($)</th>
                            <th style="width: 20%">Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hotelReservations as $hotelReservation)
                        <tr>
                            <th style="width: 15%">Type of Hotel</th>
                            <td style="width: 40%">{{ $hotelReservation->hotelType->hotel_type}}</td>
                            <td style=""></td>
                            <td style=""></td>
                        </tr>
                        <tr>
                            <th style="width: 15%">Hotel Location 1</th>
                            <td style="width: 40%">{{ $hotelReservation->hotelLocation->hotel_location}} - {{ $hotelReservation->hotelLocation->hotel_name}}</td>
                            <td style="">{{ $hotelReservation->hlamount_rs}}</td>
                            <td style="">{{ $hotelReservation->hlamount_usd}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
