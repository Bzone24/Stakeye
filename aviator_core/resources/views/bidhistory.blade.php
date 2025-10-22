@extends('Layout.usergame')
@section('css')
    <style>
    </style>
@endsection
@section('content')
    <div class="deposite-container">
        <div class="sub-header">
            <h2 class="head_title">Bid History</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-md-4 mb-4">
                    <div class="custom-accordian">
                        {{-- <div class="accordian-header">
                            <ul class="nav nav-tabs">
                                <li class="nav-item active" role="presentation" id="deposit">
                                    <button class="nav-link active" id="pills-allbets-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-allbets" type="button" role="tab"
                                        aria-controls="pills-allbets" aria-selected="true">Deposit Request</button>
                                </li>
                                <li class="nav-item" role="presentation" id="withdraw">
                                    <button class="nav-link" id="pills-allbets-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-allbets" type="button" role="tab"
                                        aria-controls="pills-allbets" aria-selected="false">Withdraw Request</button>
                                </li>
                            </ul>
                        </div> --}}

                        <div class="tab-content">
                            <div id="deposit_list" class="tab-pane fade in active">
                                <div class="accordian-body">
                                    <div class="profile-row">
                                        <div class="Profile_column">
                                            <div class="acc-row">
                                                {{-- <div class="m-3">
                                                    <label for="Username" class="rounded-pill">
                                                        Requested Date
                                                        <input type="date" class="text-i10 amount" id="from_date">
                                                        <input type="date" class="text-i10 amount" id="to_date">
                                                        <input type="submit" class="text-i10 amount" id="searchDeposit">
                                                    </label>
                                                </div> --}}
                                                <div class="table-responsive">
                                                    <table id="deposit_report" class="table display nowrap w-100 "
                                                        cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Amount</th>
                                                                <th>Game Id </th>
                                                                <th>Cashout Multiplier </th>
                                                                <th>Status</th>
                                                                <th>Requested Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (count($bidHistory) > 0)
                                                                @foreach ($bidHistory as $item)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>₹{{ number_format($item->amount,2) }}</td>
                                                                        <td>{{ ($item->gameid) }}</td>
                                                                        <td>{{ ($item->cashout_multiplier) }}</td>
                                                                        <td>
                                                                            <div class="btn btn-{{$item->status ? 'success' : 'danger'}}">{{$item->status ? 'success' : 'fail'}}</div>
                                                                        </td>
                                                                        <td>{{ dformat($item->created_at,'d-m-Y h:i:s') }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="5" style="text-align: center;">No data
                                                                        found!!</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#withdraw_report').DataTable({});
    </script>
    {{-- <script src="{{asset('user/deposit_withdraw_list.js')}}"></script> --}}
@endsection
