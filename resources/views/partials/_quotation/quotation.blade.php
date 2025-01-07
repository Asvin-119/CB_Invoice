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
                    <form action="{{ route('quotes.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label for="clientName" class="col-sm-3 col-form-label">Client Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="hidden" name="client_id" id="clientId" value="">
                                <div class="dropdown">
                                    <input id="selectedClient" type="text" class="form-control" placeholder="Search or select a client" data-bs-toggle="dropdown" aria-expanded="false" onkeyup="filterClients()">
                                    <ul class="dropdown-menu w-100" id="clientDropdown">
                                        @foreach($clients as $client)
                                            <li>
                                                <button type="button" class="dropdown-item d-flex align-items-center" onclick="selectClient('{{ $client->id }}', '{{ $client->display_name }}')">
                                                    <span class="me-2 rounded-circle text-white d-flex justify-content-center align-items-center" style="width: 30px; height: 30px;">
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
                                        <li>
                                            <button type="button" class="dropdown-item text-primary" data-bs-toggle="modal" data-bs-target="#addClientModal">+ New Client</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Quote Number (Auto-generated) -->
                        <div class="mb-3 row" style="display: none;">
                            <label for="quoteNumber" class="col-sm-3 col-form-label">Quote# <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="quote_number" id="quoteNumber" value="AHG/QUO - 0001" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Quote Date -->
                        <div class="mb-3 row">
                            <label for="quoteDate" class="col-sm-3 col-form-label">Quote Date <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="quoteDate" name="quote_date" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center pt-3">
                            <button type="submit" class="btn btn-primary btn-icon-text mx-2">
                                <i class="mdi mdi-content-save btn-icon-prepend"></i> Save
                            </button>
                            <a href="" class="btn btn-icon-text" style="background: #eeeeee;">
                                <i class="mdi mdi-cancel btn-icon-prepend"></i> Cancel
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Define a color mapping for each letter
    const colorMapping = {
        A: "#FF5733", B: "#FFBD33", C: "#DBFF33", D: "#75FF33", E: "#33FF57",
        F: "#33FFBD", G: "#33DBFF", H: "#3375FF", I: "#5733FF", J: "#BD33FF",
        K: "#FF33DB", L: "#FF3375", M: "#FF3333", N: "#FF5733", O: "#FF8C33",
        P: "#FFC433", Q: "#C4FF33", R: "#8CFF33", S: "#33FF8C", T: "#33FFC4",
        U: "#33C4FF", V: "#338CFF", W: "#5733FF", X: "#8C33FF", Y: "#C433FF",
        Z: "#FF33C4"
    };

    function selectClient(clientId, displayName) {
        const input = document.getElementById('selectedClient');
        const clientIdInput = document.getElementById('clientId');

        input.value = displayName;
        clientIdInput.value = clientId;  // Set the client_id here
    }

    function filterClients() {
        let input = document.getElementById('selectedClient').value.toLowerCase();
        let dropdown = document.getElementById('clientDropdown');
        let items = dropdown.getElementsByTagName('li');

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

    // Apply unique background colors to initials
    document.addEventListener('DOMContentLoaded', function () {
        const initialsElements = document.querySelectorAll('.dropdown-item span');

        initialsElements.forEach((span) => {
            const firstLetter = span.textContent.trim().charAt(0).toUpperCase();
            span.style.backgroundColor = colorMapping[firstLetter] || "#000"; // Default to black if letter is missing
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Function to handle mode switching
    document.getElementById('manualMode').addEventListener('change', function () {
        document.getElementById('quotePrefix').disabled = false;
        document.getElementById('nextNumber').disabled = false;
        document.getElementById('quotePrefix').readOnly = false;
        document.getElementById('nextNumber').readOnly = false;
    });

    document.getElementById('autoGenerateMode').addEventListener('change', function () {
        document.getElementById('quotePrefix').disabled = true;
        document.getElementById('nextNumber').disabled = true;
        document.getElementById('quotePrefix').readOnly = true;
        document.getElementById('nextNumber').readOnly = true;

        // Reset the inputs to their default values when switching to auto mode
        document.getElementById('quotePrefix').value = 'AHG/QUO-';
        document.getElementById('nextNumber').value = '0000';
    });
});

</script>

<script>
    // Get current date in yyyy-mm-dd format
    const currentDate = new Date().toISOString().split('T')[0];

    // Set the current date as the value for the quoteDate input
    document.getElementById('quoteDate').value = currentDate;
</script>

@endsection
