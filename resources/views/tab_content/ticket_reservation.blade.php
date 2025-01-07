<form id="newServiceForm" action="{{ route('ticket.store') }}" method="POST">
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
                        <th style="width: 15%;">Details</th>
                        <th style="width: 20%;">Description</th>
                        <th style="width: 15%;">Quantity</th>
                        <th style="width: 20%;">Rate</th>
                        <th style="width: 15%;">Amount (Rs.)</th>
                        <th style="width: 15%;">Amount ($)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="item-row">
                        <td><strong>Ticket</strong></td>
                        <td>
                            <select name="ticket_type" id="ticket_type" class="form-control ticket_type select2" style="width: 100%;">
                                <option value="">Select Ticket Type</option>
                                @foreach ($ticketTypes as $ticketType)
                                    <option value="{{ $ticketType->id }}">{{ $ticketType->ticket_type }}</option>
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

            <!-- Hidden Inputs for Amounts -->
            <input type="hidden" name="ticket_amount_rs" id="ticket_amount_rs" value="0.00">
            <input type="hidden" name="ticket_amount_usd" id="ticket_amount_usd" value="0.00">

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

<script>
    let usdToLkrRate = 400; // Default exchange rate

// Fetch exchange rate from the API
function fetchExchangeRate() {
    fetch('https://api.exchangerate-api.com/v4/latest/USD')
        .then(response => response.json())
        .then(data => {
            usdToLkrRate = data.rates.LKR; // Update exchange rate
            calculateAmounts(); // Recalculate amounts after exchange rate is updated
        })
        .catch(error => console.error('Error fetching exchange rate:', error));
}

// Function to calculate ticket amounts
function calculateAmounts() {
    const ticketQuantity = document.getElementById('ticket_quantity').value;
    const ticketRate = parseFloat(document.getElementById('ticket_rate').value);

    if (ticketQuantity && ticketRate) {
        const ticketAmountRs = (ticketQuantity * ticketRate).toFixed(2);
        const ticketAmountUsd = (ticketQuantity * ticketRate / usdToLkrRate).toFixed(2);

        document.getElementById('ticket_amount-rs').textContent = ticketAmountRs;
        document.getElementById('ticket_amount-usd').textContent = ticketAmountUsd;

        // Set hidden inputs to submit values
        document.getElementById('ticket_amount_rs').value = ticketAmountRs;
        document.getElementById('ticket_amount_usd').value = ticketAmountUsd;
    }
}

// Event listeners for quantity and rate changes
document.getElementById('ticket_quantity').addEventListener('input', calculateAmounts);
document.getElementById('ticket_rate').addEventListener('input', calculateAmounts);

// Fetch exchange rate when the page loads
fetchExchangeRate();

</script>
