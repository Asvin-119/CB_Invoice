@extends('dashboard.layout')

@section('title', 'Client Form')

@section('content')

<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Quotation</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Quotation</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3 text-center mb-n5">
                    <img src="{{asset('dist/images/breadcrumb/ChatBc.png')}}" alt="" class="img-fluid mb-n4">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf <!-- CSRF protection -->

                        <!-- Client Name -->
                        <div class="mb-3 row">
                            <label for="clientName" class="col-sm-3 col-form-label">Client Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="dropdown">
                                    <!-- Input field for selected client -->
                                    <input id="selectedClient" type="text" class="form-control" placeholder="Search or select a client" data-bs-toggle="dropdown" aria-expanded="false" onkeyup="filterClients()">
                                    <!-- Dropdown menu -->
                                    <ul class="dropdown-menu w-100" id="clientDropdown">
                                        @foreach($clients as $client)
                                            <li>
                                                <button type="button" class="dropdown-item d-flex align-items-center" onclick="selectClient('{{ $client->display_name }}', '{{ strtoupper(substr($client->first_name, 0, 1)) }}{{ strtoupper(substr($client->last_name, 0, 1)) }}')">
                                                    <span class="me-2 rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center" style="width: 30px; height: 30px;">
                                                        {{ strtoupper(substr($client->first_name, 0, 1)) }}{{ strtoupper(substr($client->last_name, 0, 1)) }}
                                                    </span>
                                                    <div>
                                                        <div>{{ $client->display_name }}</div>
                                                        <small class="text-muted">{{ $client->email }}</small>
                                                    </div>
                                                </button>
                                            </li>
                                        @endforeach
                                        <li><hr class="dropdown-divider"></li>
                                        <!-- Button to trigger modal -->
                                        <li>
                                            <button
                                                type="button"
                                                class="dropdown-item text-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#addClientModal">
                                                + New Client
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Quote Number -->
                        <div class="mb-3 row">
                            <label for="quoteNumber" class="col-sm-3 col-form-label">Quote# <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="quoteNumber" name="quote_number" value="INV-000001" readonly>
                                    <button class="btn btn-light" type="button">
                                        <i class="fa fa-cogs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Quote Date -->
                        <div class="mb-3 row">
                            <label for="quoteDate" class="col-sm-3 col-form-label">Quote Date <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="quoteDate" name="quote_date" value="2024-12-24" required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-3 row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary">Save Quotation</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Client Modal -->
@include('popup.clients_add_quotation')

@endsection

@section('scripts')
<script>
    function selectClient(displayName, initials) {
        const input = document.getElementById('selectedClient');
        input.value = displayName;

        // Display initials (if needed for further actions)
        console.log('Selected Initials:', initials);
    }

    // Function to filter client names based on user input
    function filterClients() {
        let input = document.getElementById('selectedClient').value.toLowerCase();
        let dropdown = document.getElementById('clientDropdown');
        let items = dropdown.getElementsByTagName('li');

        // Loop through all items and hide those that don't match
        for (let i = 0; i < items.length; i++) {
            let item = items[i];
            let clientName = item.getElementsByTagName('div')[0]?.textContent.toLowerCase();

            if (clientName && clientName.indexOf(input) > -1) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        }
    }
</script>
@endsection
