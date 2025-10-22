@extends('Layout.usergame')
@section('content')
    <div class="deposite-container">
        <div class="container">
            <div class="text-white mt-5 pt-5">
                <h1>Aviator Contact Us</h1>

                <p>Please feel free to contact us if you have any questions, concerns, or feedback. We will do our best to
                    respond to you as soon as possible.</p>

                <form action="mailto:support@source-code.co.in" method="post">

                    <input type="name" name="name" placeholder="Your name">
                    <input type="email" name="email" placeholder="Your email address">
                    <input type="subject" name="subject" placeholder="Subject">
                    <textarea name="message" placeholder="Your message"></textarea>

                    <input type="submit" value="Send">

                </form>
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
