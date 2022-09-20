<div>
    <div class="table-responsive">

        <table class="table table-bordered" id="dataTable">
            <caption>All drivers</caption>
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Created At</th>
                <th>Orders count</th>
                <th>Revenue</th>

            </tr>
            </thead>

            <tbody>

            @foreach($driversRevenue as $mydriver)
                <tr>
                    <td>{{$mydriver->driver()->first()->id}}</td>
                    <td>{{$mydriver->driver()->first()->name}}</td>
                    <td>{{$mydriver->driver()->first()->phone_number}}</td>
                    <td>{{$mydriver->driver()->first()->created_at}}</td>
                    <td>{{$mydriver->count}}</td>
                    <td>$ {{$mydriver->revenue}}</td>

                </tr>

            @endforeach


            </tbody>

        </table>

            {!!$driversRevenue->links()!!}

    </div>
</div>
