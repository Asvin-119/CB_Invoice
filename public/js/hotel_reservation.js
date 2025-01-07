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

    // Function to add a new row dynamically
    document.querySelector('.add-hotel-row').addEventListener('click', function () {
        let rowCount = document.querySelectorAll('.item-row').length / 2; // Get current row count (divided by 2 to account for two rows per hotel)

        // Create new row HTML
        let newRow = `
            <tr class="item-row">
                <td><strong>Type of Hotel</strong></td>
                <td colspan="5">
                    <select class="form-control" name="hotel_type[]" id="hotel_type_${rowCount}">
                        <option value="">Select Hotel</option>
                        <option value="1">Hotel 1</option>
                        <option value="2">Hotel 2</option>
                    </select>
                </td>
            </tr>
            <tr class="item-row">
                <td><strong>Hotel Location ${rowCount + 1}</strong></td>
                <td>
                    <select class="form-control" name="hotel_location[]" id="hotel_location_${rowCount}">
                        <option value="">Select Location</option>
                        <option value="1">Location 1</option>
                        <option value="2">Location 2</option>
                    </select>
                </td>
                <td><input type="number" name="hotel_quantity[]" class="form-control hotel_quantity" id="hotel_quantity_${rowCount}" value="1" min="1"></td>
                <td><input type="number" name="hotel_rate[]" class="form-control hotel_rate" id="hotel_rate_${rowCount}" value="0.00" min="0" step="0.01"></td>
                <td class="hotel_amount-rs" id="hotel_amount-rs_${rowCount}">0.00</td>
                <td class="hotel_amount-usd" id="hotel_amount-usd_${rowCount}">0.00</td>
            </tr>
        `;

        // Append the new row to the table body
        document.querySelector('.table tbody').insertAdjacentHTML('beforeend', newRow);

        // Add event listeners to calculate the amounts when the user inputs data
        document.querySelector(`#hotel_quantity_${rowCount}`).addEventListener('input', calculateAmounts);
        document.querySelector(`#hotel_rate_${rowCount}`).addEventListener('input', calculateAmounts);

        // Recalculate amounts for all rows (in case the exchange rate is already updated)
        calculateAmounts();
    });

    // Function to calculate amounts
    function calculateAmounts() {
        let rows = document.querySelectorAll('.item-row');
        rows.forEach((row, index) => {
            // Handle only the rows with quantity and rate inputs (every second row contains the inputs)
            if (index % 2 !== 0) {
                let quantity = document.querySelector(`#hotel_quantity_${Math.floor(index / 2)}`);
                let rate = document.querySelector(`#hotel_rate_${Math.floor(index / 2)}`);
                if (quantity && rate) {
                    let quantityValue = parseFloat(quantity.value) || 0;
                    let rateValue = parseFloat(rate.value) || 0;

                    // Calculate amounts in LKR and USD
                    let amountLkr = quantityValue * rateValue * usdToLkrRate;
                    let amountUsd = quantityValue * rateValue;

                    // Update the corresponding fields
                    document.querySelector(`#hotel_amount-rs_${Math.floor(index / 2)}`).textContent = amountLkr.toFixed(2);
                    document.querySelector(`#hotel_amount-usd_${Math.floor(index / 2)}`).textContent = amountUsd.toFixed(2);
                }
            }
        });
    }

    // Initialize the exchange rate on page load
    fetchExchangeRate();
