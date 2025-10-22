@extends('Layout.admindashboard')
@section('css')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 25px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 34px;
            /* This will create the rounded design */
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 10px;
            bottom: 5px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 50%;
            /* This makes the toggle handle rounded */
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> User Edit
            </h3>
        </div>
        <div class="row row_col">
            <div class="col-xl-4">
                <div class="card overflow-hidden h100p">
                    <div class="bg-soft-primary">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <div class="text-primary p-3 alert alert-success text-dark shadow">
                                    <h5 class="text-primary ">{{ Str::title($user->name) }}</h5>
                                    <p>{{ $user->mobile }} <a href="tel:91{{ $user->mobile }}"><i
                                                class="mdi mdi-cellphone-iphone"></i></a>
                                        <a href="https://wa.me/91{{ $user->mobile }}" target="blank"><i
                                                class="mdi mdi-whatsapp"></i></a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-5 custom-control custom-switch">
                                <p>User Banned Status</p>
                                <label class="switch">
                                    <input type="checkbox" class="user-status-toggle" data-id="{{ $user->id }}"
                                        {{ $user->status ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <img src="adminassets/images/user.png" alt=""
                                        class="img-thumbnail rounded-circle">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body border-top">

                        <div class="row">
                            <div class="col-sm-12">
                                <div>
                                    <p class="text-muted mb-2">Available Balance</p>
                                    <h5>₹ {{ $walletBalance->amount }}</h5>
                                </div>

                            </div>

                            <div class="col-sm-6">
                                <div class="mt-3">
                                    <button class="btn btn-success btn-sm w-md btn-block" id="adFund" data-toggle="modal"
                                        data-target="#addFundModal">Add Fund</button>
                                </div>
                            </div>
                            {{-- ADD FUND MODAL --}}
                            <div class="modal fade" id="addFundModal" tabindex="-1" role="dialog"
                                aria-labelledby="addFundModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addFundModalLabel">Add Amount</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('addusermoney') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <div class="form-group">
                                                    <label for="amount">Amount:</label>
                                                    <input type="number" class="form-control" id="amount" name="amount"
                                                        placeholder="Enter amount">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add Amount</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Add Fund Modal -->
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-xl-8">
                <div class="card h100p">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Personal Information</h4>
                        <div class="table-responsive">
                            <table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Full Name :</th>
                                        <td>{{ $user->name }}</td>
                                        <th scope="row">Password</th>
                                        <td>{{ $user->confirm_password }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mobile :</th>
                                        <td>{{ $user->mobile }} <a href="tel:91{{ $user->mobile }}"><i
                                                    class="mdi mdi-cellphone-iphone"></i></a>
                                            <a href="https://wa.me/91{{ $user->mobile }}" target="blank"><i
                                                    class="mdi mdi-whatsapp"></i></a>
                                        </td>
                                        <th scope="row">Email:</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h4 class="card-title mb-4">Payment Information</h4>
                        <div class="table-responsive">
                            <table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Bank Name :</th>
                                        <td>{{ isset($bankDetails->bankname) ? '' : 'N/A' }}</td>
                                        <th scope="row"></th>
                                        <td></td>

                                    </tr>
                                    <tr>
                                        <th scope="row">A/c Number :</th>
                                        <td>{{ isset($bankDetails->accountno) ? '' : 'N/A' }}</td>
                                        <th scope="row">IFSC Code :</th>
                                        <td>{{ isset($bankDetails->ifsccode) ? '' : 'N/A' }}</td>
                                        <th scope="row"></th>
                                        <td></td>

                                    </tr>
                                    <tr>
                                        <th scope="row">UPI Id :</th>
                                        <td>{{ isset($bankDetails->upi_id) ? '' : 'N/A' }}</td>
                                        <th scope="row">Mobile Number :</th>
                                        <td>{{ isset($bankDetails->mobile_no) ? '' : 'N/A' }}</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- TRANSACATION --}}
        <div class="row mt-3">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Transactions</h4>
                        </p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>platform</th>
                                    <th>transactionno</th>
                                    <th>type</th>
                                    <th>Amount</th>
                                    <th>category</th>
                                    <th>Remark</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($transactions) > 0)
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transaction->platform }}</td>
                                            <td>{{ $transaction->transactionno }}</td>
                                            <td>{{ $transaction->type }}</td>
                                            <td><strong class="text-success">₹ {{ $transaction->amount }}</strong></td>
                                            <td>{{ $transaction->category }}</td>
                                            <td>
                                                <p class="badge badge-success">{{ $transaction->remark }}</p>
                                            </td>
                                            <td> {{ $transaction->status }}</td>
                                            <td>{{ Carbon\Carbon::parse($transaction->created_at)->format('d-M-Y h:i A') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="13" class="text-center"> No User found!!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bids --}}
        <div class="row mt-1">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Bid History</h4>
                        </p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Gameid</th>
                                    <th>Section_no</th>
                                    <th>cashout_multiplier</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($userBid) > 0)
                                    @foreach ($userBid as $userBid)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><strong class="text-success">₹ {{ $userBid->amount }}</strong></td>
                                            <td>{{ $userBid->type }}</td>
                                            <td>{{ $userBid->gameid }}</td>
                                            <td>{{ $userBid->section_no }}</td>
                                            <td>{{ $userBid->cashout_multiplier }}</td>
                                            <td>
                                                <p class="badge badge-success">{{ $userBid->status ? 'Success' : 'Fail' }}
                                                </p>
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($userBid->created_at)->format('d-M-Y h:i A') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="13" class="text-center"> No User found!!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $("#changepassword").on('submit', function(e) {
            e.preventDefault();
        });
        $("#changepassword").validate({
            submitHandler: function(form) {
                apex("POST", "{{ url('admin/api/changepassword') }}", new FormData(form), form,
                    "/admin/dashboard", "#");
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.user-status-toggle').on('change', function() {
                // Get user ID and current status from the checkbox
                let userId = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0; // 1 for Active, 0 for Inactive/Banned

                // Make the AJAX request
                $.ajax({
                    url: "{{ route('changeuserstatus') }}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        userId: userId,
                        status: status
                    },
                    success: function(response) {

                        alert(response.message)
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Handle error
                        console.error(textStatus, errorThrown);
                    }
                });
            });
        });
    </script>
@endsection
