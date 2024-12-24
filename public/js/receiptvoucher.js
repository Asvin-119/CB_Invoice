let usdToLkrRate = 400; // Default exchange rate

// Fetch exchange rate from the API
function fetchExchangeRate() {
    fetch('https://api.exchangerate-api.com/v4/latest/USD')
        .then(response => response.json())
        .then(data => {
            usdToLkrRate = data.rates.LKR || 400;
            console.log('Exchange rate fetched:', usdToLkrRate);
        })
        .catch(error => console.error('Error fetching exchange rate:', error));
}

// Convert numbers to words including decimals with specific format
function numberToWords(num, isRupees = true) {
    if (num === 0) return "Zero";

    const a = [
        "", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine",
        "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"
    ];
    const b = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
    const c = ["", "Thousand", "Million", "Billion"];

    let integerPart = Math.floor(num);
    let decimalPart = Math.round((num - integerPart) * 100); // Extract decimals as two digits

    // Convert integer part
    let words = convertNumberToWords(integerPart);
    words += isRupees ? " Rupees" : " Dollars";

    // Convert decimal part
    if (decimalPart > 0) {
        let decimalWords = convertNumberToWords(decimalPart);
        words += ` and ${decimalWords} ${isRupees ? "Paise" : "Cents"}`;
    }

    return words;

    function convertNumberToWords(num) {
        if (num === 0) return "";
        if (num < 20) return a[num];
        if (num < 100) return b[Math.floor(num / 10)] + (num % 10 !== 0 ? " " + a[num % 10] : "");
        if (num < 1000) return a[Math.floor(num / 100)] + " Hundred" + (num % 100 !== 0 ? " and " + convertNumberToWords(num % 100) : "");

        let value = num, word = "";
        for (let i = 0; value > 0 && i < c.length; i++) {
            if (value % 1000 !== 0) {
                word = convertNumberToWords(value % 1000) + " " + c[i] + " " + word;
            }
            value = Math.floor(value / 1000);
        }
        return word.trim();
    }
}

// Update totals and words
function updateTotals() {
    let totalRs = 0, totalUsd = 0;

    // Calculate totals
    document.querySelectorAll('input[name="amount_rs[]"]').forEach(input => {
        totalRs += parseFloat(input.value) || 0;
    });

    document.querySelectorAll('input[name="amount_usd[]"]').forEach(input => {
        totalUsd += parseFloat(input.value) || 0;
    });

    // Update "Amount in Words" fields
    document.getElementById('amount-in-words-rs').textContent = totalRs
        ? numberToWords(totalRs, true)
        : "Rupees";
    document.getElementById('amount-in-words-usd').textContent = totalUsd
        ? numberToWords(totalUsd, false)
        : "Dollar";
}


// Auto calculate USD amounts
function calculateUsdAmount(row) {
    const amountRsInput = row.querySelector('input[name="amount_rs[]"]');
    const amountUsdInput = row.querySelector('input[name="amount_usd[]"]');
    const amountRs = parseFloat(amountRsInput.value) || 0;
    const amountUsd = (amountRs / usdToLkrRate).toFixed(2);
    amountUsdInput.value = amountUsd;

    updateTotals();
}

document.addEventListener('DOMContentLoaded', function () {
    fetchExchangeRate();

    let rowCount = 0;

    document.getElementById('add-row').addEventListener('click', function () {
        rowCount++;
        const tableBody = document.getElementById('table-body');

        const newRow = document.createElement('tr');
        newRow.id = `row-${rowCount}`;
        newRow.innerHTML = `
            <td class="text-center">${rowCount}</td>
            <td><input type="text" name="code[]" class="form-control" placeholder="Code"></td>
            <td><input type="text" name="description[]" class="form-control" placeholder="Description"></td>
            <td>
                <input type="number" name="amount_rs[]" class="form-control" placeholder="Amount Rs." value="0.00" min="0" step="0.01">
            </td>
            <td>
                <input type="number" name="amount_usd[]" class="form-control" placeholder="Amount $" value="0.00" readonly>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm delete-row" data-id="${rowCount}">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </td>
        `;
        tableBody.insertBefore(newRow, tableBody.lastElementChild.previousElementSibling);

        newRow.querySelector('input[name="amount_rs[]"]').addEventListener('input', function () {
            calculateUsdAmount(newRow);
        });
    });

    document.getElementById('table-body').addEventListener('click', function (e) {
        if (e.target.closest('.delete-row')) {
            const button = e.target.closest('.delete-row');
            const rowId = button.getAttribute('data-id');
            document.getElementById(`row-${rowId}`).remove();
            updateTotals();
        }
    });
});
