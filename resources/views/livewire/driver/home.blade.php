<div>
    <section class="container-fluid d-flex flex-column my-2 py-3 position-relative">

{{--        @include('livewire.driver.inc.modals')--}}

        <div class="text-start">
            <div class="d-flex ">
                <h3 class="font-roboto font-size-3-rem col-6">Waiting list</h3>
                <div class="col-6">
                    <input type="text" class="form-control" placeholder="search" wire:model="term">
                </div>
            </div>


            <div class="card">
                <div class="card-body table-responsive-sm  ">

                    <table class="table font-size-card table-bordered table-sm table-hover">

                        <caption>List of avilable orders</caption>
                        <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">description</th>
                            <th scope="col">from_address</th>
                            <th scope="col">to_address</th>
                            <th scope="col">phone</th>
                            <th scope="col">notes</th>
                            <th scope="col">action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($orders as $order)
                            <tr class="cursor-pointer">
                                <th>{{$order->id}}</th>
                                <td>{{$order->name}}</td>
                                <td>{{$order->description}}</td>
                                <td>{{$order->from_address}}</td>
                                <td>{{$order->to_address}}</td>
                                <td>{{$order->phone}}01021638451</td>
                                <td>{{$order->notes}}</td>
                                <td>
                                    <button class="btn btn-sm btn-success" wire:click="accept({{$order->id}})">Accept</button>
                                </td>

                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>


                </div>
                {{$orders->links()}}
            </div>

        </div>
    </section>
</div>
