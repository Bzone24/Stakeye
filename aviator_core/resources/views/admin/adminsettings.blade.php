@extends('Layout.admindashboard')
@section('css')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Admin Settings
            </h3>
            {{-- <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
      </ul>
    </nav> --}}
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Admin Settings</h4>
                        <form class="forms-sample" id="changepassword" action="{{route('adminsettings')}}" method="post">
                            @csrf
                            <input type="hidden" name="userid" value="{{ admin('id') }}">
                            <div class="form-group">
                                <label for="exampleInputName1">Instagram</label>
                                <input type="text" class="form-control" id="instagram" name="instagram" value="{{($adminSettings->insatgram)?? ''}}"
                                    placeholder="Instagram">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Facebook</label>
                                <input type="text" class="form-control" id="facebook" name="facebook" value="{{($adminSettings->facebook)}}"
                                    placeholder="Facebook">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Telegram</label>
                                <input type="text" class="form-control" id="telegram" name="telegram" value="{{($adminSettings->telegram)}}"
                                    placeholder="Telegram">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Youtube</label>
                                <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{($adminSettings->linkedin)}}"
                                    placeholder="Linkedin">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Twitter</label>
                                <input type="text" class="form-control" id="twitter" name="twitter" value="{{($adminSettings->twitter)}}"
                                    placeholder="Twitter">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">What's App No</label>
                                <input type="text" class="form-control" id="whatasapp_no" name="whatasapp_no" value="{{($adminSettings->whatasapp_no)}}"
                                    placeholder="Twitter">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">UPI ID</label>
                                <input type="text" class="form-control" id="upi_id" name="upi_id" value="{{($adminSettings->upi_id)}}"
                                    placeholder="Twitter">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="exampleInputName1">RANDOM RESULT</label>
                                <input type="checkbox"  id="random_result" name="random_result" {{$adminSettings->random_result? 'checked' : '' }} />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">MINIMUM RESULT</label>
                                <input type="number" class="form-control" id="min_result" name="min_result" value="{{($adminSettings->min_result)}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">MAXIMUM RESULT</label>
                                <input type="max_result" class="form-control" id="max_result" name="max_result" value="{{($adminSettings->max_result)}}" >
                            </div>
                            
                            
                            
                             <div class="form-group">
                                <label for="exampleInputName1">MINIMUM RESULT (Without Bet)</label>
                                <input type="number" class="form-control" id="without_min_result" name="without_min_result" value="{{($adminSettings->without_min_result)}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">MAXIMUM RESULT (Without Bet)</label>
                                <input type="number" class="form-control" id="without_max_result" name="without_max_result" value="{{($adminSettings->without_max_result)}}" >
                            </div>


                            <hr>
                            <h5><strong>Withdrawl Settings</strong></h5>
                            <div class="form-group">
                                <label for="exampleInputName1">Min Withdraw</label>
                                <input type="number" class="form-control" id="min_withdraw" name="min_withdraw" value="{{ $adminSettings->min_withdraw }}" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">MINIMUM Withdrawal Time</label>
                                <input type="time" class="form-control" id="min_withdraw_time" name="min_withdraw_time" value="{{($adminSettings->min_withdraw_time)}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">MAXIMUM Withdrawal Time</label>
                                <input type="time" class="form-control" id="max_withdraw_time" name="max_withdraw_time" value="{{($adminSettings->max_withdraw_time)}}" >
                            </div>
                            <hr>
                            <h5><strong>Deposite Settings</strong></h5>
                            <div class="form-group">
                                <label for="exampleInputName1">MINIMUM Deposite Amount</label>
                                <input type="number" class="form-control" id="min_deposite" name="min_deposite" value="{{($adminSettings->min_deposite)}}" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Wallet Bonus</label>
                                <input type="number" class="form-control" id="wallet_bonus" name="wallet_bonus" value="{{($adminSettings->wallet_bonus)}}" >
                            </div>
                            
                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
