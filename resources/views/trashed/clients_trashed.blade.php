@extends('dashboard.layout')

@section('title', 'Trashed Clients')

@section('content')

<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Trashed Clients</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Trashed Clients</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3 text-center mb-n5">
                    <img src="{{ asset('dist/images/breadcrumb/TrashBc.png') }}" alt="" class="img-fluid mb-n4">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" id="searchTrashed" class="form-control" placeholder="Search trashed clients..." />
                            <div class="input-group-append">
                                <span class="input-group-text bg-info" style="height: 43px;">
                                    <i class="ti ti-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('dashboard') }}" class="btn btn-info btn-icon-text">
                            <i class="mdi mdi-arrow-left"></i> Back to Clients
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive pt-2">
                        <table class="table table-striped table-bordered" id="trashed-clients-table">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%;">#</th>
                                    <th style="width: 10%;">Client Pic</th>
                                    <th style="width: 25%;">Client Name</th>
                                    <th style="width: 20%;">Email</th>
                                    <th style="width: 20%;">Phone</th>
                                    <th style="width: 15%;">Action</th>  {{-- icon btn --}}
                                </tr>
                            </thead>
                            <tbody id="trashed-clients-tbody">
                                @forelse($clients as $client)
                                    <tr>
                                        <td class="text-center" style="width: 5%; padding-top: 30px;">{{ $loop->iteration }}</td>
                                        <td style="width: 10%;">
                                            <!-- Display client image -->
                                            @if($client->client_image)
                                                <img src="{{ asset('storage/' . $client->client_image) }}" alt="Client Image" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                                            @else
                                                <img src="{{ asset('dist/images/default-avatar.png') }}" alt="No Image" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                                            @endif
                                        </td>
                                        <td style="width: 25%; padding-top: 30px;">{{ $client->display_name }}</td>
                                        <td style="width: 20%; padding-top: 30px;">{{ $client->email }}</td>
                                        <td style="width: 20%; padding-top: 30px;">{{ $client->mobile_phone }}</td>
                                        <td style="width: 15%; padding-top: 25px;" class="justify-content-between">
                                            <form action="{{ route('clients.restore', $client->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" title="Restore">
                                                    <i class="fa fa-undo"></i> Restore
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No trashed clients found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.getElementById('searchTrashed').addEventListener('input', function() {
    const query = this.value.toLowerCase(); // Make search query lowercase for case-insensitive comparison

    // AJAX request to search trashed clients
    fetch(`{{ route('clients.trashed') }}?query=${query}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        const tbody = document.getElementById('trashed-clients-tbody');
        tbody.innerHTML = ''; // Clear existing results

        if (data.length > 0) {
            data.forEach((client, index) => {
                tbody.innerHTML += `
                    <tr>
                        <td class="text-center" style="width: 5%; padding-top: 30px;">${index + 1}</td>
                        <td style="width: 10%;">
                            ${client.client_image ?
                                `<img src="${client.client_image}" alt="Client Image" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">` :
                                `<img src="{{ asset('dist/images/default-avatar.png') }}" alt="No Image" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">`}
                        </td>
                        <td style="width: 25%; padding-top: 30px;">${client.display_name}</td>
                        <td style="width: 20%; padding-top: 30px;">${client.email}</td>
                        <td style="width: 20%; padding-top: 30px;">${client.mobile_phone}</td>
                        <td style="width: 15%; padding-top: 25px;">
                            <form action="{{ url('clients/restore') }}/${client.id}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" title="Restore">
                                    <i class="fa fa-undo"></i> Restore
                                </button>
                            </form>
                        </td>
                    </tr>
                `;
            });
        } else {
            tbody.innerHTML = '<tr><td colspan="6" class="text-center">No results found</td></tr>';
        }
    })
    .catch(error => console.error('Error:', error));
});

</script>
@endsection
