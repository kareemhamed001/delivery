<div>
    <section class="container-fluid py-3">

        <h3>
            Delivered orders
        </h3>
        @include('livewire.driver.inc.modals')

        <div class="table-responsive-sm  ">
            <table class="table font-size-card table-bordered table-sm table-hover mw-100">
                <caption>List of avilable orders {{$orders->count().'/'.$orders->total()}}</caption>

                <thead class="table-dark">
                <tr>
                    <th scope="col"wire:click="orderBy('id')">id <i class="fa-solid fa-caret-down"></i></th>
                    <th scope="col">name</th>

                    <th scope="col">from_address</th>
                    <th scope="col">to_address</th>
                    <th scope="col">phone</th>
                    <th scope="col" wire:click="orderBy('delivery_time')">Time <i class="fa-solid fa-caret-down"></i></th>

                </tr>
                </thead>
                <tbody>

                <?php $total=0?>
                @forelse($orders as $order)

                        <?php $total+=$order->price?>
                    <tr class="cursor-pointer">
                        <th wire:click="showOrder({{$order->id}})">{{$order->id}}</th>
                        <td wire:click="showOrder({{$order->id}})">{{$order->name}}</td>

                        <td wire:click="showOrder({{$order->id}})">{{$order->from_address}}</td>
                        <td wire:click="showOrder({{$order->id}})">{{$order->to_address}}</td>
                        <td wire:click="showOrder({{$order->id}})">{{$order->phone}}01021638451</td>
                        <td wire:click="showOrder({{$order->id}})">{{\Carbon\Carbon::parse($order->delivery_time)->diffForHumans(now())  }}</td>



                    </tr>
                @empty
                @endforelse
                </tbody>
                <caption>Totoal for this page :{{$total}}$ </caption>
            </table>


        </div>
        <div class="pagination">
            {{$orders->links()}}
        </div>
    </section>
</div>
@push('scripts')
    <script>
        window.addEventListener('close-modal', function () {
            $('#cancelOrderModal').modal('hide');
            $('#showOrderModal').modal('hide');
            $('#finishOrderModal').modal('hide');
        });

        window.addEventListener('openShowOrderModal', function () {
            $('#showOrderModal').modal('show');
        });
        window.addEventListener('openFinishOrderModal', function () {
            $('#finishOrderModal').modal('show');
        });
        window.addEventListener('openCancelOrderModal', function () {
            $('#cancelOrderModal').modal('show');
        });

    </script>
@endpush
