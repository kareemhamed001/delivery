<div>
    <div class="table-responsive">

        <table class="table table-bordered" id="dataTable">
            <caption>All drivers</caption>
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Joined At</th>
                <th>Orders count</th>
                <th>Revenue</th>

            </tr>
            </thead>

            <tbody>

            @foreach($driversRevenue as $mydriver)
                <tr>
                    <td>{{$mydriver->driver->id}}</td>
                    <td>{{$mydriver->driver->name}}</td>
                    <td>{{$mydriver->driver->phone_number}}</td>
                    <td>{{\Carbon\Carbon::parse($mydriver->driver->created_at)->toDateString() }}</td>
                    <td>{{$mydriver->count}}</td>
                    <td>$ {{$mydriver->revenue}}</td>

                </tr>

            @endforeach


            </tbody>

        </table>

            {!!$driversRevenue->links()!!}

    </div>
</div>
