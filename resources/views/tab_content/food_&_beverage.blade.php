<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-center" style="width: 100%">
            <input type="text" style="font-weight: bold" name="quote_id" id="quote_id" class="form-control" value="{{ $lastQuote->quote_number }}" readonly>
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-end pb-3">
            <button class="btn" style="color: white; background-image: linear-gradient(to right, #008000 , #003300); opacity: 0.7;" data-bs-toggle="modal" data-bs-target="#addTypeofFoodModal">
                <i class="fa-solid fa-circle-plus"></i><span class="ms-3">Add New Food Type</span>
            </button>
        </div>

        @include('popup.food_type')

        <table class="table table-bordered table-hover">
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
                    <td><strong>Food Type</strong></td>
                    <td>
                        <select name="food_type[]" class="form-control select2" multiple="multiple" style="width: 100%;">
                            <option value="">Select Food Type</option>
                            <option value="1">Asian Food</option>
                            <option value="2">Indian Food</option>
                            <option value="3">Mexican Food</option>
                            <option value="4">Thai Food</option>
                            <option value="5">American Food</option>
                        </select>
                    </td>
                    <td><input type="number" name="foodtype_rate" class="form-control" value="0.00" min="0" step="0.01"></td>
                    <td class="foodtype_amount-rs">0.00</td>
                    <td class="foodtype_amount-usd">0.00</td>
                </tr>
                <tr class="item-row">
                    <td><strong>Meals</strong></td>
                    <td>
                        <select name="meals[]" class="form-control select2" multiple="multiple"  style="width: 100%;">
                            <option value="">Select Meals</option>
                            <option value="1">Breakfast</option>
                            <option value="2">Lunch</option>
                            <option value="3">Dinner</option>
                        </select>
                    </td>
                    <td class="text-center"> ------ </td>
                    <td class="text-center"> ------ </td>
                    <td class="text-center"> ------ </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Select an option',
            allowClear: true
        });

        let usdToLkrRate = 0;
        fetchExchangeRate();

        function fetchExchangeRate() {
            fetch('https://api.exchangerate-api.com/v4/latest/USD')
                .then(response => response.json())
                .then(data => {
                    usdToLkrRate = data.rates.LKR;
                    calculateAmounts();
                })
                .catch(error => console.error('Error fetching exchange rate:', error));
        }

        $('input[name="foodtype_rate"]').on('input', function() {
            calculateAmounts();
        });

        function calculateAmounts() {
            $('.item-row').each(function() {
                const rateInput = $(this).find('input[name="foodtype_rate"]');
                const lkrAmountCell = $(this).find('.foodtype_amount-rs');
                const usdAmountCell = $(this).find('.foodtype_amount-usd');

                const rate = parseFloat(rateInput.val()) || 0;
                const lkrAmount = rate;
                const usdAmount = (lkrAmount / usdToLkrRate).toFixed(2);

                lkrAmountCell.text(lkrAmount.toFixed(2));
                usdAmountCell.text(usdAmount);
            });
        }
    });
</script>
