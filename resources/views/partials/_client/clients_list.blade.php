@extends('dashboard.layout')

@section('title', 'Client Management')

@section('content')

<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">All Users</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">All Users</li>
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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" id="clientSearch" class="form-control" placeholder="Search clients..." />
                            <div class="input-group-append">
                                <span class="input-group-text bg-info" style="height: 43px;">
                                    <i class="ti ti-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-info btn-icon-text" data-bs-toggle="modal" data-bs-target="#addClientModal">
                            <i class="mdi mdi-plus-circle"></i> Add
                        </button>

                        @include('popup.clients_add')
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <script>
                            // Trigger SweetAlert2 Toast on Form Submission Success
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer);
                                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                                }
                            });

                            Toast.fire({
                                icon: "success",
                                title: "{{ session('success') }}"
                            });
                        </script>
                    @endif

                    <div class="table-responsive pt-2">
                        <table class="table table-striped table-bordered" id="clients-table">
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
                            <tbody id="clients-tbody">
                                @forelse($clients as $client)
                                    <tr onclick="location.href='{{ url('clients/' . $client->id) }}'">
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
                                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="{{ route('clients.show', $client->id) }}" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" title="View">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <form action="{{ route('clients.delete', $client->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No clients found.</td>
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
    document.getElementById('clientSearch').addEventListener('input', function() {
        const query = this.value.toLowerCase(); // Make search query lowercase for case-insensitive comparison

        // AJAX request to search clients
        fetch(`{{ route('clients.search') }}?query=${query}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('clients-tbody');
            tbody.innerHTML = ''; // Clear existing results

            if (data.length > 0) {
                data.forEach((client, index) => {
                    // Highlight the part of the display_name that matches the search query
                    const displayName = client.display_name.replace(
                        new RegExp(`(${query})`, 'gi'),
                        '<span style="background-color: #c1ff1c;">$1</span>'
                    );

                    tbody.innerHTML += `
                        <tr>
                            <td class="text-center" style="width: 5%; padding-top: 30px;">${index + 1}</td>
                            <td style="width: 10%;">
                                ${client.client_image ?
                                    `<img src="${client.client_image}" alt="Client Image" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">` :
                                    `<img src="{{ asset('dist/images/default-avatar.png') }}" alt="No Image" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">`}
                            </td>
                            <td style="width: 25%; padding-top: 30px;">${displayName}</td>
                            <td style="width: 20%; padding-top: 30px;">${client.email}</td>
                            <td style="width: 20%; padding-top: 30px;">${client.mobile_phone}</td>
                            <td style="width: 15%; padding-top: 25px;">
                                <a href="" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" title="View">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="" class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    `;
                });

                // Initialize tooltips after the new content is added
                var tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                    new bootstrap.Tooltip(tooltipTriggerEl);
                });
            } else {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center">No results found</td></tr>';
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
@endsection


