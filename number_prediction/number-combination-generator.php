<style>
    .container {
        width: 100%;
        margin: 0 auto;
        padding: 20px;
    }

    .number-box {
        width: 40px;
        height: 40px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        margin: 5px;
        background-color: #eee;
        cursor: pointer;
        border-radius: 4px;
        font-size: 18px;
    }

    .number-box.selected {
        background-color: #099118;
        color: white;
    }

    .number-box.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .combination-box {
        width: 60px;
        height: 30px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        margin: 5px;
        background-color: #ddd;
        border-radius: 4px;
    }

    .combination-box.same-digit {
        background-color: #b8e6bf; /* Light green background for same-digit combinations */
    }

    .message {
        color: #ffffff;
        margin: 10px 0;
        font-weight: bold;
    }

    .status {
        color: #099118;
        margin: 10px 0;
        font-weight: bold;
    }

    .combinations-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px 0 10px 0;
    }

    .total-combinations {
        font-size: 16px;
        color: #28a745;
        font-weight: bold;
    }

    .input-section {
        margin: 20px 0;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 4px;
    }

    .input-field {
        padding: 8px;
        font-size: 16px;
        width: 120px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        margin-left: 10px;
    }

    .result-section {
        margin-top: 10px;
        font-weight: bold;
        color: #0056b3;
    }

    .legend {
        margin-top: 10px;
        font-size: 14px;
        color: #666;
    }

    .legend-item {
        display: inline-block;
        margin-right: 20px;
    }

    .legend-box {
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-right: 5px;
        vertical-align: middle;
        border-radius: 4px;
    }


</style>
<div class="container">

    <p>Select 2 to 6 numbers to see all possible two-digit combinations</p>

    <div class="input-section">
        <label for="Amount">Enter Amount:</label>
        <input type="number" id="Amount" class="input-field" value="1" min="1">
        <div id="result" class="result-section"></div>
    </div>

    <div id="status" class="status">Selected: 0 numbers</div>
    <div id="message" class="message"></div>
    <div id="number-boxes"></div>

    <div class="combinations-header">

        <div id="total-combinations" class="total-combinations"></div>
    </div>

    <div id="combination-boxes"></div>
    <input type="hidden" id="numbers" name="numbers">
</div>

<script>
    const numberBoxes = document.getElementById('number-boxes');
    const combinationBoxes = document.getElementById('combination-boxes');
    const messageElement = document.getElementById('message');
    const statusElement = document.getElementById('status');
    const totalCombinationsElement = document.getElementById('total-combinations');
    const AmountInput = document.getElementById('Amount');
    const resultElement = document.getElementById('result');
    const MIN_SELECTION = 2;
    const MAX_SELECTION = 6;

    // Create the number boxes
    for (let i = 0; i < 10; i++) {
        const numberBox = document.createElement('div');
        numberBox.classList.add('number-box');
        numberBox.textContent = i;
        numberBox.addEventListener('click', toggleNumberBox);
        numberBoxes.appendChild(numberBox);
    }

    AmountInput.addEventListener('input', updateResult);

    function getSelectedCount() {
        return document.querySelectorAll('.number-box.selected').length;
    }

    function updateStatus() {
        const count = getSelectedCount();
        statusElement.textContent = `Selected: ${count} number${count !== 1 ? 's' : ''}`;

        if (count < MIN_SELECTION) {
            messageElement.textContent = `Please select at least ${MIN_SELECTION} numbers`;
        } else if (count > MAX_SELECTION) {
            messageElement.textContent = `Maximum ${MAX_SELECTION} numbers allowed`;
        } else {
            messageElement.textContent = '';
        }

        // Disable/enable number boxes based on selection count
        const boxes = document.querySelectorAll('.number-box');
        boxes.forEach(box => {
            if (!box.classList.contains('selected') && count >= MAX_SELECTION) {
                box.classList.add('disabled');
            } else {
                box.classList.remove('disabled');
            }
        });
    }

    function toggleNumberBox(event) {
        const currentCount = getSelectedCount();
        const isSelected = event.target.classList.contains('selected');

        // Prevent selection if max limit reached
        if (!isSelected && currentCount >= MAX_SELECTION) {
            return;
        }

        // Always allow deselection
        event.target.classList.toggle('selected');
        updateStatus();
        updateCombinations();
    }

    function generateTwoDigitCombinations(numbers) {
        const combinations = [];
        for (let i = 0; i < numbers.length; i++) {
            for (let j = 0; j < numbers.length; j++) {
                // Include all combinations including same digits
                combinations.push([numbers[i], numbers[j]]);
            }
        }
        return combinations;
    }

    function updateResult() {
        const combinations = generateTwoDigitCombinations(
            Array.from(document.querySelectorAll('.number-box.selected'))
                .map(box => parseInt(box.textContent))
        );

        const Amount = parseFloat(AmountInput.value) || 0;
        const total = combinations.length * Amount;

        if (combinations.length > 0) {
            resultElement.textContent = `Total × Amount = ${combinations.length} × ${Amount} = ${total}`;
            document.getElementById("total_bet").textContent = total
            document.getElementById("cross_quantity").value = total
            document.getElementById("combinations").value = combinations.length
            document.getElementById("numbers").value = combinations.map(combo => combo.join('')).join(',')
            console.dir(combinations)
        } else {
            resultElement.textContent = '';
        }
    }

    function updateCombinations() {
        combinationBoxes.innerHTML = '';
        totalCombinationsElement.textContent = '';

        const selectedNumbers = Array.from(document.querySelectorAll('.number-box.selected'))
            .map(box => parseInt(box.textContent));

        if (selectedNumbers.length >= MIN_SELECTION && selectedNumbers.length <= MAX_SELECTION) {
            const combinations = generateTwoDigitCombinations(selectedNumbers);

            combinations.forEach(combination => {
                const combinationBox = document.createElement('div');
                combinationBox.classList.add('combination-box');

                // // Add special class for same-digit combinations
                // if (combination[0] === combination[1]) {
                //     combinationBox.classList.add('same-digit');
                // }

                combinationBox.textContent = combination.join('');
                combinationBoxes.appendChild(combinationBox);
            });

            // Calculate and display total combinations
            const totalCombinations = combinations.length;
            totalCombinationsElement.textContent = `Total combinations: ${totalCombinations}`;
            updateResult();
        }
    }

    // Initialize status
    updateStatus();
</script>
