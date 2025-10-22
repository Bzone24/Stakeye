@extends('Layout.usergame')
@section('content')
    <div class="deposite-container">
        <div class="container">
            <div class="text-white mt-5 pt-5">
                <h1>Aviator Privacy Policy</h1>

                <p>Aviator is committed to protecting your privacy. This Privacy Policy explains how we collect, use, and
                    disclose your personal information.</p>

                <h2>What personal information do we collect?</h2>

                <p>We collect the following personal information from you:</p>

                <ul>
                    <li>Name</li>
                    <li>Email address</li>
                    <li>IP address</li>
                    <li>Device information</li>
                    <li>Transaction history</li>
                    <li>Gameplay data</li>
                </ul>

                <h2>How do we use your personal information?</h2>

                <p>We use your personal information to:</p>

                <ul>
                    <li>Provide you with access to the Aviator game</li>
                    <li>Process your bets and payouts</li>
                    <li>Communicate with you about your account and the game</li>
                    <li>Improve the Aviator game and our services</li>
                    <li>Detect and prevent fraud</li>
                </ul>

                <h2>How do we disclose your personal information?</h2>

                <p>We do not sell or rent your personal information to third parties. We may disclose your personal
                    information to third parties in the following limited circumstances:</p>

                <ul>
                    <li>To service providers who help us operate the Aviator game and provide our services</li>
                    <li>To comply with legal requirements</li>
                    <li>To protect the rights, property, or safety of Aviator, our users, or others</li>
                </ul>

                <h2>How do we protect your personal information?</h2>

                <p>We use a variety of security measures to protect your personal information from unauthorized access, use,
                    or disclosure. These measures include:</p>

                <ul>
                    <li>Encrypting your personal information</li>
                    <li>Using firewalls and intrusion detection systems</li>
                    <li>Limiting access to your personal information to authorized employees</li>
                </ul>

                <h2>How long do we retain your personal information?</h2>

                <p>We retain your personal information for as long as necessary to provide you with access to the Aviator
                    game and our services, and to comply with our legal obligations.</p>

                <h2>Your choices</h2>

                <p>You have the following choices regarding your personal information:</p>

                <ul>
                    <li>You can choose to not provide us with your personal information. However, this may limit your
                        ability to use the Aviator game and our services.</li>
                    <li>You can request access to your personal information.</li>
                    <li>You can request that we correct or delete your personal information.</li>
                    <li>You can withdraw your consent to us processing your personal information.</li>
                </ul>

                <p>To exercise any of these choices, please contact us at [email protected]</p>

                <h2>Changes to this Privacy Policy</h2>

                <p>We may update this Privacy Policy from time to time. If we make any material changes to this Privacy
                    Policy, we will notify you by email or by posting a notice on our website.</p>

                <h2>Contact us</h2>

                <p>If you have any questions about this Privacy Policy, please contact us at [email protected]</p>
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
        @endsection
