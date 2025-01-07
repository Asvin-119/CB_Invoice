<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-center" style="width: 100%">
            <input type="text" style="font-weight: bold" name="quote_id" id="quote_id" class="form-control" value="{{ $lastQuote->quote_number }}" readonly>
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-end pb-3">
            <button class="btn" style="color: white; background-image: linear-gradient(to right, #008000 , #003300); opacity: 0.7;" data-bs-toggle="modal" data-bs-target="#addTourLocationModal">
                <i class="fa-solid fa-circle-plus"></i><span class="ms-3">Add Tour Location</span>
            </button>
        </div>

        @include('popup.tour_location')

        <table class="table table-bordered table-hover" id="tourLocationTable">
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
                <tr class="item-row" id="row_0">
                    <td><strong>Tour Location 1</strong></td>
                    <td>
                        <select name="tour_locations[0][id]" class="form-control select2" style="width: 100%;">
                            <option value="">Select Tour Location</option>
                            <option value="1">Colombo</option>
                            <option value="2">Kandy</option>
                            <option value="3">Galle</option>
                            <option value="4">Matara</option>
                            <option value="5">Jaffna</option>
                            <option value="6">Anuradhapura</option>
                        </select>
                    </td>
                    <td><input type="number" name="tour_locations[0][rate]" class="form-control rate-input" value="0.00" min="0" step="0.01"></td>
                    <td class="tour_amount-rs">0.00</td>
                    <td class="tour_amount-usd">0.00</td>
                </tr>
            </tbody>
        </table>

        <div class="row pb-4">
            <div class="col-md-6 pt-2">
                <button type="button" class="btn btn-secondary" id="addNewTourLocationRow">
                    <i class="fa-solid fa-circle-plus me-2"></i> Add New Row
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let tourRowIndex = 1; // Start index for tour location rows
        let usdToLkrRate = 0;
        fetchExchangeRate();

        function fetchExchangeRate() {
            fetch('https://api.exchangerate-api.com/v4/latest/USD')
                .then(response => response.json())
                .then(data => {
                    usdToLkrRate = data.rates.LKR;
                })
                .catch(error => console.error('Error fetching exchange rate:', error));
        }

        $('#addNewTourLocationRow').on('click', function(e) {
            e.preventDefault();
            addNewTourLocationRow();
        });

        function addNewTourLocationRow() {
            const newRow = `
                <tr class="item-row" id="row_${tourRowIndex}">
                    <td><strong>Tour Location ${tourRowIndex + 1}</strong></td>
                    <td>
                        <select name="tour_locations[${tourRowIndex}][id]" class="form-control select2" style="width: 100%;">
                            <option value="">Select Tour Location</option>
                                <option value="1">Colombo</option>
                                <option value="2">Kandy</option>
                                <option value="3">Galle</option>
                                <option value="4">Matara</option>
                                <option value="5">Jaffna</option>
                                <option value="6">Anuradhapura</option>
                        </select>
                    </td>
                    <td><input type="number" name="tour_locations[${tourRowIndex}][rate]" class="form-control rate-input" value="0.00" min="0" step="0.01"></td>
                    <td class="tour_amount-rs">0.00</td>
                    <td class="tour_amount-usd">0.00</td>
                </tr>
            `;
            $('#tourLocationTable tbody').append(newRow);
            $('.select2').select2(); // Re-initialize Select2 for all select elements
            tourRowIndex++; // Increment index for the next row
        }

        $('#tourLocationTable').on('input', '.rate-input', function() {
            calculateAmounts();
        });

        function calculateAmounts() {
            $('#tourLocationTable .item-row').each(function() {
                const rateInput = $(this).find('.rate-input');
                const lkrAmountCell = $(this).find('.tour_amount-rs');
                const usdAmountCell = $(this).find('.tour_amount-usd');

                const rate = parseFloat(rateInput.val()) || 0;
                const lkrAmount = rate;
                const usdAmount = (lkrAmount / usdToLkrRate).toFixed(2);

                lkrAmountCell.text(lkrAmount.toFixed(2));
                usdAmountCell.text(usdAmount);
            });
        }
    });
</script>
