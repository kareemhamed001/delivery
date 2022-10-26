<div>
    <div class="row ">
        <h4  class="text-black">Order Information</h4>
        <div class="col-12 col-xl-9  row shadow">

            <div class="  ">

                <div class="row d-flex justify-content-center">


                <div class="card col-md-6 mb-2 ">
                    <div class="card-body p-2">
                        <label class="text-black" for="">Order Id : {{$order->id}}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">Order Name : {{$order->name}}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">Order Description : {{$order->description}}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">Order Notes : {{$order->notes ??'No Notes'}}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">Order From Address : {{$order->from_address}}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">Order To Address : {{$order->to_address}}</label>
                    </div>
                </div>

                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">Delivery Price : ${{$order->price ??'not defined'}}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2 {{$order->accepted ?'bg-success text-white':'bg-white'}}">
                    <div class="card-body p-2 ">
                        <label class=" {{$order->accepted ?'text-white':' text-black'}} " for="">Order Accepted ? : {{$order->accepted ?'Accepted' : 'Not Accepted'}}</label>
                    </div>
                </div>
                <div class="card col-md-12 mb-2 {{$order->finished ?'bg-success text-white':'bg-white'}}">
                    <div class="card-body p-2">
                        <label class="" for="">Order Finished ?
                            : {{$order->finished ?'Finished' : 'Not Finished'}}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2 {{$order->canceled ?'bg-danger text-white':'bg-white text-black'}}">
                    <div class="card-body p-2">
                        <label class="" for="">Order Canceled ?
                            : {{$order->canceled ?'Canceled' : 'Not Canceled'}}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">Canceling Reason
                            : {{__('myordersPage.'.$order->failure_reason) }}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">Order Delivery Date
                            : {{\Carbon\Carbon::create($order->delivery_time)->toDateString() }}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">Order Delivery Time
                            : {{date('h:i: a ', strtotime($order->delivery_time)) }}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">Order Created At
                            : {{\Carbon\Carbon::create($order->created_at)->toDateString()}}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">Order Last Update At
                            : {{\Carbon\Carbon::create($order->updated_at)->toDateString()}}</label>
                    </div>
                </div>

                <h4 class="text-dark">User information</h4>
                <hr class="bg-black">
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">User Name : {{$order->user->name}}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">User Email : {{$order->user->email}}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">User Phone : {{$order->user->phone_number}}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">User Role :@if($order->user->role_as==0)
                                {{'User'}}
                            @elseif($order->user->role_as==1)
                                {{'Driver'}}
                            @elseif($order->user->role_as==2)
                                {{'Admin'}}
                            @endif </label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">User Created at : {{\Carbon\Carbon::create($order->user->created_at)->toDateString()}}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">User Updated At : {{\Carbon\Carbon::create($order->user->created_at)->toDateString()}}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">User Orders Count : {{$order->user->orders->count()}}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">User Orders Value : ${{$order->user->orders->sum('price')}}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">User Orders Value : ${{round($order->user->orders->average('price'),2) }}</label>
                    </div>
                </div>
                <div class="card col-md-6 mb-2">
                    <div class="card-body p-2">
                        <label class="text-black" for="">User Name : {{$order->user->name}}</label>
                    </div>
                </div>

                @if($order->accepted &&$order->accepted_by &&$order->driver)
                    <h4 class="text-dark">Driver information</h4>
                    <hr class="bg-black">
                    <div class="card col-md-6 mb-2">
                        <div class="card-body p-2">
                            <label class="text-black" for="">Driver Name : {{$order->driver->name}}</label>
                        </div>
                    </div>
                    <div class="card col-md-6 mb-2">
                        <div class="card-body p-2">
                            <label class="text-black" for="">Driver Email : {{$order->driver->email}}</label>
                        </div>
                    </div>
                    <div class="card col-md-6 mb-2">
                        <div class="card-body p-2">
                            <label class="text-black" for="">Driver Phone : {{$order->driver->phone_number}}</label>
                        </div>
                    </div>
                    <div class="card col-md-6 mb-2">
                        <div class="card-body p-2">
                            <label class="text-black" for="">Driver Role :@if($order->driver->role_as==0)
                                    {{'Driver'}}
                                @elseif($order->driver->role_as==1)
                                    {{'Driver'}}
                                @elseif($order->driver->role_as==2)
                                    {{'Admin'}}
                                @endif </label>
                        </div>
                    </div>
                    <div class="card col-md-6 mb-2">
                        <div class="card-body p-2">
                            <label class="text-black" for="">Driver Created at : {{\Carbon\Carbon::create($order->driver->created_at)->toDateString()}}</label>
                        </div>
                    </div>
                    <div class="card col-md-6 mb-2">
                        <div class="card-body p-2">
                            <label class="text-black" for="">Driver Updated At : {{\Carbon\Carbon::create($order->driver->created_at)->toDateString()}}</label>
                        </div>
                    </div>
                    <div class="card col-md-6 mb-2">
                        <div class="card-body p-2">
                            <label class="text-black" for="">Driver Orders Count : {{$order->driver->orders->count()}}</label>
                        </div>
                    </div>
                    <div class="card col-md-6 mb-2">
                        <div class="card-body p-2">
                            <label class="text-black" for="">Driver Orders Value : ${{$order->driver->orders->sum('price')}}</label>
                        </div>
                    </div>
                    <div class="card col-md-6 mb-2">
                        <div class="card-body p-2">
                            <label class="text-black" for="">Driver Orders Value : ${{round($order->driver->orders->average('price'),2) }}</label>
                        </div>
                    </div>
                    <div class="card col-md-6 mb-2">
                        <div class="card-body p-2">
                            <label class="text-black" for="">Driver Name : {{$order->driver->name}}</label>
                        </div>
                    </div>
                @endif

                </div>
            </div>


        </div>
        <div class="col-xl-3  ">

            <table class="table table-sm table-bordered table-hover shadow">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Time</td>
                </tr>
                </thead>
                @forelse($moreOrders as $other)
                    <tr>
                        <td class="cursor-pointer" wire:click="displayOrder({{$other->id}})">{{$other->id}}</td>
                        <td class="cursor-pointer" wire:click="displayOrder({{$other->id}})">{{$other->name}}</td>
                        <td class="cursor-pointer" wire:click="displayOrder({{$other->id}})">{{\Carbon\Carbon::create($other->delivery_time)->diffForHumans(now())}}</td>
                    </tr>
                @empty
                @endforelse
            </table>
            <div class="overflow-auto">
                {{$moreOrders->links()}}
            </div>

            {{--<div    wire:click="displayOrder({{$other->hashed_id}})">{{$other->name}}</div>--}}


        </div>
    </div>

</div>
