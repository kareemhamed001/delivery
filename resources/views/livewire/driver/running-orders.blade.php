<div>
    <section class="container-fluid py-3">

<h3>
    Running orders
</h3>
        @include('livewire.driver.inc.modals')

        <div class="table-responsive-sm  ">
            <table class="table font-size-card table-bordered table-sm table-hover">
                <caption>List of avilable orders {{$orders->count().'/'.$orders->total()}}</caption>
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

                    <tr class="cursor-pointer">
                        <th data-bs-toggle="modal"
                            data-bs-target="#showOrderModal" wire:click="showOrder({{$order->id}})">{{$order->id}}</th>
                        <td data-bs-toggle="modal"
                            data-bs-target="#showOrderModal"
                            wire:click="showOrder({{$order->id}})">{{$order->name}}</td>

                        <td data-bs-toggle="modal"
                            data-bs-target="#showOrderModal"
                            wire:click="showOrder({{$order->id}})">{{$order->from_address}}</td>
                        <td data-bs-toggle="modal"
                            data-bs-target="#showOrderModal"
                            wire:click="showOrder({{$order->id}})">{{$order->to_address}}</td>
                        <td data-bs-toggle="modal"
                            data-bs-target="#showOrderModal" wire:click="showOrder({{$order->id}})">{{$order->phone}}
                            01021638451
                        </td>
                        <td data-bs-toggle="modal"
                            data-bs-target="#showOrderModal"
                            wire:click="showOrder({{$order->id}})">{{\Carbon\Carbon::parse($order->delivery_time)->diffForHumans(now())  }}</td>

                        <td>
                            <button data-bs-toggle="modal"
                                    data-bs-target="#showOrderModal"
                                    class="btn btn-sm btn-success" wire:click="accept({{$order->id}})">Finish</button>
                            <button data-bs-toggle="modal"
                                    data-bs-target="#cancelOrderModal"
                                    wire:click="setId({{$order->id}})"
                                    class="btn btn-sm btn-danger" >Cancel</button>
                        </td>

                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>


        </div>
        <div class="pagination">
            {{$orders->links()}}
        </div>
    </section>
</div>
@push('scripts')
    <script >
        window.addEventListener('close-modal',function (){
           $('#cancelOrderModal').modal('hide');
           $('#showOrderModal').modal('hide');
        });
    </script>
@endpush
