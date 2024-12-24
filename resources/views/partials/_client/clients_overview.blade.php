@extends('dashboard.layout')

@section('title', 'Client Overview')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg border-info rounded-3" style="max-width: 850px; margin: 0 auto;">
        <div class="card-header bg-light text-white">
            <h4 class="fw-semibold mb-0 text-center fs-8">{{ $client->display_name }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <table class="table table-borderless">
                        {{-- Client Image --}}
                        <tr>
                            <td class="text-center"><h5><strong class="text-dark"><i class="fas fa-user-circle me-2"></i>Client Image:</strong></h5></td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                @if($client->client_image)
                                    <img src="{{ asset('storage/' . $client->client_image) }}" alt="Client Image" class="img-fluid rounded-circle border border-dark shadow-sm" style="width: 150px; height: 150px;">
                                @else
                                    <img src="{{ asset('dist/images/default-avatar.png') }}" alt="No Image" class="img-fluid rounded-circle border border-info shadow-sm" style="width: 150px; height: 150px;">
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6 mb-4">
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-left"><h5><strong class="text-dark"><i class="fas fa-user me-2"></i>Client Details:</strong></h5></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user me-2 text-muted"></i><strong>Client Name:</strong></td>
                            <td>{{ $client->display_name }}</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-envelope me-2 text-muted"></i><strong>Email:</strong></td>
                            <td>{{ $client->email }}</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-phone-alt me-2 text-muted"></i><strong>Phone:</strong></td>
                            <td>{{ $client->mobile_phone }}</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user-tie me-2 text-muted"></i><strong>Tour Consultant:</strong></td>
                            <td>{{ $client->tour_consultant ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-users me-2 text-muted"></i><strong>Source / Agent:</strong></td>
                            <td>{{ $client->source ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-outline-success btn-lg me-3 shadow-sm hover-shadow"><i class="fas fa-edit me-2"></i>Edit Client</a>
                <a href="{{ route('clients.create') }}" class="btn btn-outline-primary btn-lg shadow-sm hover-shadow"><i class="fas fa-arrow-left me-2"></i>Back to Clients List</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    /* Custom shadow effect on hover */
    .hover-shadow:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection
