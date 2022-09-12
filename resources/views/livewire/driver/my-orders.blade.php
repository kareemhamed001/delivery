<div>
    <section class="container-fluid d-flex flex-column my-2 py-3 position-relative">

        @include('livewire.driver.inc.modals')

        <div class="text-start">
            <div class="d-flex flex-column ">
                <div class="col-12">
                    <h3 class="font-roboto font-size-3-rem col-12 text-center">بليبل</h3>
                </div>

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

                            <th scope="col">from_address</th>
                            <th scope="col">to_address</th>
                            <th scope="col">phone</th>
                            <th scope="col">Time</th>
                            <th scope="col">action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($orders as $order)
                                <?php
                                $now = \Carbon\Carbon::now();
                                $created_at = \Carbon\Carbon::parse($order->delivery_time);
                                $isPast = $created_at->isPast();
                                if ($isPast) {
                                    \App\Models\Order::find($order->id)->update([
                                        'canceled' => '1',
                                        'failure_reason' => 'Failure',
                                    ]);
                                }
                                ?>
                            <tr class="cursor-pointer">
                                <th data-bs-toggle="modal"
                                    data-bs-target="#showOrderModal" wire:click="showOrder({{$order->id}})">{{$order->id}}</th>
                                <td data-bs-toggle="modal"
                                    data-bs-target="#showOrderModal" wire:click="showOrder({{$order->id}})">{{$order->name}}</td>

                                <td data-bs-toggle="modal"
                                    data-bs-target="#showOrderModal" wire:click="showOrder({{$order->id}})">{{$order->from_address}}</td>
                                <td data-bs-toggle="modal"
                                    data-bs-target="#showOrderModal" wire:click="showOrder({{$order->id}})">{{$order->to_address}}</td>
                                <td data-bs-toggle="modal"
                                    data-bs-target="#showOrderModal" wire:click="showOrder({{$order->id}})">{{$order->phone}}01021638451</td>
                                <td data-bs-toggle="modal"
                                    data-bs-target="#showOrderModal" wire:click="showOrder({{$order->id}})">{{date('H:i a' ,strtotime($order->delivery_time)) }}</td>


                                <td>
                                    <button class="btn btn-sm btn-danger" wire:click="accept({{$order->id}})">Cancel</button>
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
