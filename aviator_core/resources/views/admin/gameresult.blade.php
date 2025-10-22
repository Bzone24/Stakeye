@extends('Layout.admindashboard')
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Game Result
            </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Withdrawal List</h4>
                        </p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Game Id</th>
                                    <th>Result</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gameResult as $result)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$result->game}}</td>
                                        <td>{{$result->result}}</td>
                                        <td>{{$result->created_at->format('d-M-Y h:i:s A ')}}</td>
                                    </tr>
                                @endforeach
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
        <script>
        function refreshPage() {
            let now = new Date();
            let nextRefreshTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), now.getHours(), now.getMinutes() + 1, 10);
            let delay = nextRefreshTime - now;
        
            setTimeout(() => {
                location.reload();
            }, delay);
        }
        refreshPage();
    </script>
@endsection
