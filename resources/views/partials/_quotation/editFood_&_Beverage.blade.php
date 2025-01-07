@extends('dashboard.layout')

@section('title', 'Edit Food & Beverage') {{-- editFood_&_Beverage.blade.php --}}

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg border-info rounded-3">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h2 class="page-title">Edit Food & Beverage</h2>
                <a href="{{ route('quotations.show', $foodAndBeverage->quote_id) }}" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" title="View Quotation">
                    <i class="fa fa-eye"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('hotel_reservations.update', $hotelReservations->id) }}">
                @csrf
                @method('PUT')
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
