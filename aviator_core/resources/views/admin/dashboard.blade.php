@extends('Layout.admindashboard')
@section('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-dark text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Dashboard
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white img-opacity">
                    <div class="card-body">
                        <span class="mdi mdi-account icons"></span>
                        <h4 class="font-weight-normal mb-3">Total User
                        </h4>
                        <h2 class="mb-5">{{ $user }}</h2>
                        <a class="btn btn-dark btn-sm" href="{{route('userlist')}}">View All User</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <span class="mdi mdi-account-clock icons"></span>
                        <h4 class="font-weight-normal mb-3">Today User
                        </h4>
                        <h2 class="mb-5">{{ $todayUsersCount }}</h2>
                        <a class="btn btn-dark btn-sm" href="{{route('todayuserlist')}}">View Today Users</a>

                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <span class="mdi mdi-account-off icons"></span>
                        <h4 class="font-weight-normal mb-3">Total Blocked User
                        </h4>
                        <h2 class="mb-5">{{ $blockUser }}</h2>
                        <a class="btn btn-dark btn-sm" href="{{route('blockeduser')}}">View Blocked User</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{url('/aviatoradmin/assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Deposite
                        </h4>
                        <h2 class="mb-5">₹ {{ $recharge }}</h2>
                        <a class="btn btn-dark btn-sm" href="{{route('rechargehistory')}}">View Deposite User</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{url('/aviatoradmin/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Today Deposite
                        </h4>
                        <h2 class="mb-5">₹ {{ ($rechargeToday) }}</h2>
                        <a class="btn btn-dark btn-sm" href="{{route('todayrechargehistory')}}">View Today Deposite User</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{url('/aviatoradmin/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Profit/Loss
                        </h4>
                        <h2 class="mb-5">₹ {{ ($profitAndLoss) }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{url('/aviatoradmin/assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Game
                        </h4>
                        <h2 class="mb-5">{{ $totalGames }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- content-wrapper ends -->
    
    <!-- WITHDRAW AND RECHARGE HISTORY -->
    <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Recharge List</h4>
                            </p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>User id</th>
                                        <th>Name</th>
                                        <th>Transaction No.</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($rechargeHistory) > 0)
                                        @foreach ($rechargeHistory as $rechargeHistory)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ appvalidate($rechargeHistory->userid) }}</td>
                                                <td><a href="{{ url('admin/user/view/'.$rechargeHistory->userid) }}">{{ appvalidate(userdetail($rechargeHistory->userid, 'name')) }} </a> </td>
                                                <td>{{ appvalidate($rechargeHistory->transactionno) }}</td>
                                                <td>₹{{ appvalidate(number_format($rechargeHistory->amount, 2)) }}</td>
                                                <td>
                                                    <label class="badge badge-{{ status($rechargeHistory->status, 'recharge')['color'] }}">
                                                        {{ status($rechargeHistory->status, 'recharge')['name'] }}
                                                    </label>
                                                </td>
                                                <td>{{ dformat($rechargeHistory->created_at, 'd-m-Y') }}</td>
                                                <td>
                                                    @if ($rechargeHistory->status == 0)
                                                        <button class="btn btn-sm btn-success"
                                                            onclick="rechargeapprove('{{$rechargeHistory->userid}}','{{ $rechargeHistory->id }}','{{ $rechargeHistory->amount }}',this)">Approve</button>
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="rechargecancel('{{$rechargeHistory->userid}}','{{ $rechargeHistory->id }}','{{ $rechargeHistory->amount }}',this)">Cancel</button>
                                                    @else
                                                        <button
                                                            class="btn btn-sm btn-{{ status($rechargeHistory->status, 'recharge')['color'] }}">{{ status($rechargeHistory->status, 'recharge')['name'] }}</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="13" class="text-center"> No Data found!!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

    <!-- WITHDRAW AND RECHARGE HISTORY END -->
    
@endsection

@section('js')
    <script>
        function rechargeapprove(userid,id,amount,thisc) {
            let form = new FormData();
            form.append('id', id);
            form.append('userid', userid);
            form.append('amount', amount);
            form.append('_token', '{{ csrf_token() }}');
            apex("POST", "{{ url('admin/api/recharge/success') }}", form, '', "", "#");
            location.reload();
        }

        function rechargecancel(userid,id,amount,thisc) {
            let form = new FormData();
            form.append('id', id);
            form.append('userid', userid);
            form.append('amount', amount);
            form.append('_token', '{{ csrf_token() }}');
            apex("POST", "{{ url('admin/api/recharge/cancel') }}", form, '', "", "#");
            location.reload();
        }
    </script>
@endsection