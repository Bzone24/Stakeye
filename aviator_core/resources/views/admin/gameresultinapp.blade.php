<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Game Results</h4>
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
                                <td>{{ $result->game }}</td>
                                <td>{{ $result->result }}</td>
                                <td>{{ Carbon\Carbon::parse($result->created_at)->format(' d-M-Y h:i:s A ')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                        {{$gameResult->links()}}
        </div>
    </div>
</div>
