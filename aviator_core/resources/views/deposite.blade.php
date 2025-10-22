@extends('Layout.usergame')
@section('content')
<?php
$adminSetting = App\Models\AdminSetting::latest()->first();
// echo $adminSetting->upi_id;
?>
    <div class="deposite-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="pay-tabs">
                        <a href="#" class="custom-tabs-link active">DEPOSIT</a>
                        <a href="{{ url('withdraw') }}" class="custom-tabs-link">WITHDRAW</a>
                    </div>

                    <input type="hidden" name="username" id="username" value="">
                    <input type="hidden" name="password" id="password" value="">

                    <div class="pay-options">
                        <div class="payment-cols">
                            <div class="mb-3">
                                <div class="grid-list" onclick="paymentGatewayDetails('3')">
                                    <button class="btn payment-btn" data-tab="upi">
                                        <img src="images/app-logo/upiMt.svg" />
                                        <div class="PaymentCard_limit">Min {{ $adminSettings->min_deposite }}</div>
                                    </button>
                                </div>
                            </div>
                            <div class="deposite-box" id="netbanking">
                                <div class="d-box">
                                    <div class="limit-txt">LIMITS:<span>{{ $adminSettings->min_deposite }}</span></div>

                                    <div class="amount-tooltips">
                                        <button class="btn amount-tooltips-btn">50</button>
                                        <button class="btn amount-tooltips-btn">100</button>
                                        <button class="btn amount-tooltips-btn active">250</button>
                                        <button class="btn amount-tooltips-btn">500</button>
                                        <button class="btn amount-tooltips-btn">1000</button>
                                        <button class="btn amount-tooltips-btn">2500</button>
                                        <button class="btn amount-tooltips-btn">5000</button>
                                    </div>
                                    <label for="net_bank_amount" class="error" id="net_bank_amount-error"></label>
                                </div>
                            </div>
                            <div class="deposite-box" id="Phonepay">
                                <div class="d-box">
                                    <div class="limit-txt">LIMITS:<span>{{ $adminSettings->min_deposite }} - </span></div>
                                    <div class="limit-txt">BONUS POINTS:<span>{{ $adminSettings->wallet_bonus }} - </span></div>
                                    
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="login-controls mt-3 rounded-pill h42">
                                                <label for="Username" class="rounded-pill">
                                                    <input type="text" class="form-control text-i10 amount"
                                                        id="phonepe_amount"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');">
                                                    <input type="hidden" id="phonepe_min_amount"
                                                        value="{{ $adminSettings->min_deposite }}">
                                                    <input type="hidden" id="phonepe_max_amount" value="">
                                                    <i class="Input_currency">
                                                        INR
                                                    </i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <button
                                                class="register-btn rounded-pill d-flex align-items-center w-100 mt-3 orange-shadow"
                                                onclick="deposit('2')">
                                                DEPOSIT
                                            </button>
                                        </div>
                                    </div>
                                    <div class="amount-tooltips">
                                        <button class="btn amount-tooltips-btn">50</button>
                                        <button class="btn amount-tooltips-btn">100</button>
                                        <button class="btn amount-tooltips-btn active">250</button>
                                        <button class="btn amount-tooltips-btn">500</button>
                                        <button class="btn amount-tooltips-btn">1000</button>
                                        <button class="btn amount-tooltips-btn">2500</button>
                                        <button class="btn amount-tooltips-btn">5000</button>
                                    </div>
                                    <label for="phonepe_amount" class="error" id="phonepe_amount-error"></label>
                                </div>
                            </div>

                            {{-- DEPOSITE --}}
                            <div class="deposite-box" id="upi">
                                <div class="d-box">
                                    <div class="limit-txt">LIMITS:<span>₹ {{ $adminSettings->min_deposite }}</span></div>
                                    <div id="walletbonus" class="limit-txt">BONUS POINTS:<span>{{ $adminSettings->wallet_bonus }}  </span></div>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="login-controls mt-3 rounded-pill h42">
                                                <label for="Username" class="rounded-pill">
                                                    <input type="number" class="form-control text-i10" id="upi_amount" value="{{ $adminSettings->min_deposite }}">
                                                    <input type="hidden" id="upi_min_amount"
                                                        value="{{ $adminSettings->min_deposite }}" >
                                                    <input type="hidden" id="upi_max_amount" value="{{ $adminSettings->min_deposite }}">
                                                    <i class="Input_currency">
                                                        INR
                                                    </i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <button
                                                class="register-btn rounded-pill d-flex align-items-center w-100 mt-3 orange-shadow"
                                                id="deposite1">
                                                DEPOSIT
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
<font style='color:white;'>
If above payment option is not working, please copy and pay on UPI ID manually.
</font>
<br>
<button id="copyBtn" data-text="{{ $adminSetting->upi_id }}" class="register-btn rounded-pill d-flex align-items-center w-100 mt-3 orange-shadow">Copy UPI ID</button>
<br>
<script>
    const copyBtn = document.querySelector('#copyBtn');
    copyBtn.addEventListener('click', e => {
        const input = document.createElement('input');
        input.value = copyBtn.dataset.text;
        document.body.appendChild(input);
        input.select();
        if(document.execCommand('copy')) {
            alert('UPI ID Copied');
            document.body.removeChild(input);
        }
    });
</script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ url('user/deposit.js') }}"></script>
    @isset($_GET['msg'])
        @if ($_GET['msg'] == 'Success')
            <script>
                toastr.success("Request send successfully!")
            </script>
        @endif
    @endisset

    <script>
        $(document).ready(function() {
            
            $("#deposite1").click(function() {
                var amount = $("#upi_amount").val();
                
                if(amount >= {{$adminSettings->min_deposite}}){
                    var transactionId = new Date().getTime(); // Simplified unique ID generation
                    var upiid = "{{$adminSetting->upi_id}}";
                    var upiURL = createUPIURL(amount, transactionId, upiid, " Your id ");
    
                    // Trigger UPI App
                    window.location.href = upiURL;
    
                    // Simulate a delay for UPI App, then send data to backend
                    setTimeout(function() {
                        // This is just a simulation. In a real scenario, you'd want to have a more robust mechanism to check the payment status.
                        $.post("{{ route('verifytransaction') }}", {
                            "_token": "{{ csrf_token() }}",
                            transactionId: transactionId,
                            amount: amount
                        }, function(data) {
                            if (data.success) {
                                alert("Payment successful!");
                                // Redirect to the given route
                                if (data.redirect) {
                                    window.location.href = data.redirect;
                                }
                            } else {
                                alert("Payment failed. Please try again.");
                            }
                        });
                    }, 8000); // 8-second delay for demo
                }
                else{
                    toastr.error("Minimum Deposite Amount " + {{$adminSettings->min_deposite}})
                }
            });
        });

        function createUPIURL(amount, transactionId, merchantVPA, merchantName) {
            return `upi://pay?pa=${merchantVPA}&pn=${merchantName}&tn=Payment&am=${amount}&cu=INR`;
        }
    </script>
    <!-- Include jQuery library -->

    <script>
        $(document).ready(function () {
            // Function to calculate and update wallet bonus
            function calculateWalletBonus() {
                // Get the entered amount
                var enteredAmount = parseFloat($('#upi_amount').val());
    
                // Get the wallet bonus percentage from the server-side (assuming it's in percentage, e.g., 10 for 10%)
                var walletBonusPercentage = parseFloat("{{ $adminSettings->wallet_bonus }}");
    
                // Calculate the wallet bonus
                var walletBonus = (enteredAmount * walletBonusPercentage) / 100;
    
                // Calculate the total amount including the wallet bonus
                var totalAmount = enteredAmount + walletBonus;
    
                // Display the total amount in the corresponding HTML element
                $('#walletbonus span').text(totalAmount.toFixed(2)); // Assuming you want to display it with two decimal places
            }
    
            // Trigger the calculation on page load
            calculateWalletBonus();
    
            // Event handler for input change
            $('#upi_amount').on('input', function () {
                // Trigger the calculation when the user enters a new amount
                calculateWalletBonus();
            });
        });
</script>

@endsection
