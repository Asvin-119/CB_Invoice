@extends('dashboard.layout')

@section('title', 'Client Form')

@section('content')

<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">All Quotation</h4>
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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" id="quotationSearch" class="form-control" placeholder="Search Quotation..." />
                            <div class="input-group-append">
                                <span class="input-group-text bg-info" style="height: 43px;">
                                    <i class="ti ti-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <a href="{{ route('add.ticket')}}"><button class="btn btn-info btn-icon-text"><i class="mdi mdi-plus-circle"></i> Add Quotation</button></a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive pt-2">
                        <table class="table table-striped table-bordered" id="clients-table">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 25%;">Quotation ID</th>
                                    <th style="width: 25%;">Client Name</th>
                                    <th style="width: 25%;">Quotation Date</th>
                                    <th style="width: 15%;">Action</th>  {{-- icon btn --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quotations as $quotation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="quote-id">{{ $quotation->quote_number }}</td>
                                        <td class="client-name">{{ $quotation->clients->display_name }}</td>
                                        <td>{{ $quotation->quote_date }}</td>
                                        <td style="width: 15%; padding-top: 25px;" class="justify-content-between">
                                            <a href="" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="Print">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            <a href="{{ route('quotations.show', $quotation->id) }}" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" title="View">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <form action="" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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
    // Function to highlight text without CSS
    function highlightText(text, term) {
        const regex = new RegExp(`(${term})`, 'gi');
        return text.replace(regex, `<span style="background-color: yellow; font-weight: bold;">$1</span>`);
    }

    document.getElementById('quotationSearch').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#clients-table tbody tr');

        rows.forEach(row => {
            const quoteCell = row.querySelector('.quote-id');
            const clientCell = row.querySelector('.client-name');

            const quoteText = quoteCell.textContent.toLowerCase();
            const clientText = clientCell.textContent.toLowerCase();

            if (quoteText.includes(searchTerm) || clientText.includes(searchTerm)) {
                row.style.display = '';

                // Highlight matching text
                quoteCell.innerHTML = highlightText(quoteCell.textContent, searchTerm);
                clientCell.innerHTML = highlightText(clientCell.textContent, searchTerm);
            } else {
                row.style.display = 'none';
                // Reset content for non-matching rows
                quoteCell.innerHTML = quoteCell.textContent;
                clientCell.innerHTML = clientCell.textContent;
            }
        });
    });
</script>
@endsection
