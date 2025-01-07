<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-center" style="width: 100%">
            <input type="text" style="font-weight: bold" name="quote_id" id="quote_id" class="form-control" value="{{ $lastQuote->quote_number }}" readonly>
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-end pb-3">
            <button class="btn" style="color: white; background-image: linear-gradient(to right, #008000 , #003300); opacity: 0.7;" data-bs-toggle="modal" data-bs-target="#addHotelLocationModal">
                <i class="fa-solid fa-circle-plus"></i><span class="ps-3">Add Hotel Location</span>
            </button>
        </div>

        @include('popup.hotel_location')

        <table class="table table-bordered table-hover" id="hotelLocationTable">
            <thead class="table-light">
                <tr>
                    <th style="width: 15%;">Details</th>
                    <th style="width: 40%;">Description</th>
                    <th style="width: 18%;">Rate</th>
                    <th style="width: 13%;">Amount (Rs.)</th>
                    <th style="width: 13%;">Amount ($)</th>
                </tr>
            </thead>
            <tbody>
                <tr class="item-row">
                    <td><strong>Hotel Type</strong></td>
                    <td>
                        <select name="hotel_type" class="form-control select2" style="width: 100%;">
                            <option value="">Select Hotel Type</option>
                            @foreach ($hotelTypes as $hotelType)
                                <option value="{{ $hotelType->id }}">{{ $hotelType->hotel_type }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="text-center"> ------ </td>
                    <td class="text-center"> ------ </td>
                    <td class="text-center"> ------ </td>
                </tr>
                <tr class="item-row" id="row_0">
                    <td><strong>Hotel Location 1</strong></td>
                    <td>
                        <select name="hotel_locations[0][id]" class="form-control select2" style="width: 100%;">
                            <option value="">Select Hotel Location</option>
                            @foreach ($hotelLocations as $hotelLocation)
                                <option value="{{ $hotelLocation->id }}">{{ $hotelLocation->hotel_location }} - {{ $hotelLocation->hotel_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="hotel_locations[0][rate]" class="form-control rate-input" value="0.00" min="0" step="0.01"></td>
                    <td class="hotel_amount-rs">0.00</td>
                    <td class="hotel_amount-usd">0.00</td>
                </tr>
            </tbody>
        </table>

        <div class="row pb-4">
            <div class="col-md-6 pt-2">
                <button type="button" class="btn btn-secondary" id="addNewHotelLocationRow">
                    <i class="fa-solid fa-circle-plus me-2"></i> Add New Row
                </button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    let hotelLocationRowIndex = 1; // Start index for hotel location rows
    let usdToLkrRate = 0; // Initial fallback value
    fetchExchangeRate();

    function fetchExchangeRate() {
        fetch('https://api.exchangerate-api.com/v4/latest/USD')
            .then(response => response.json())
            .then(data => {
                usdToLkrRate = data.rates.LKR;
                calculateAmounts(); // Recalculate after fetching exchange rate
            })
            .catch(error => console.error('Error fetching exchange rate:', error));
    }

    $('#addNewHotelLocationRow').on('click', function(e) {
        e.preventDefault();
        addNewHotelLocationRow();
    });

    function addNewHotelLocationRow() {
        const newRow = `
            <tr class="item-row" id="row_${hotelLocationRowIndex}">
                <td><strong>Hotel Location ${hotelLocationRowIndex + 1}</strong></td>
                <td>
                    <select name="hotel_locations[${hotelLocationRowIndex}][id]" class="form-control select2" style="width: 100%;">
                        <option value="">Select Hotel Location</option>
                            @foreach ($hotelLocations as $hotelLocation)
                                <option value="{{ $hotelLocation->id }}">{{ $hotelLocation->hotel_location }} - {{ $hotelLocation->hotel_name }}</option>
                            @endforeach
                    </select>
                </td>
                <td><input type="number" name="hotel_locations[${hotelLocationRowIndex}][rate]" class="form-control rate-input" value="0.00" min="0" step="0.01"></td>
                <td class="hotel_amount-rs">0.00</td>
                <td class="hotel_amount-usd">0.00</td>
            </tr>
        `;
        $('#hotelLocationTable tbody').append(newRow);
        $('.select2').select2(); // Re-initialize Select2 for all select elements
        hotelLocationRowIndex++; // Increment index for the next row
    }

    // Delegated event to handle input changes in rate fields
    $('#hotelLocationTable').on('input', '.rate-input', function() {
        calculateAmounts();
    });

    function calculateAmounts() {
        if (usdToLkrRate === 0) {
            // Exchange rate not yet fetched, return
            return;
        }

        $('#hotelLocationTable .item-row').each(function() {
            const rateInput = $(this).find('.rate-input');
            const lkrAmountCell = $(this).find('.hotel_amount-rs');
            const usdAmountCell = $(this).find('.hotel_amount-usd');

            const rate = parseFloat(rateInput.val()) || 0;
            const lkrAmount = rate;
            const usdAmount = (lkrAmount / usdToLkrRate).toFixed(2);

            lkrAmountCell.text(lkrAmount.toFixed(2));
            usdAmountCell.text(usdAmount);
        });
    }
});
</script>
