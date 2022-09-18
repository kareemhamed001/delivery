<div>
    <section class="container-fluid py-3">

        <h3>
            Running orders
        </h3>
        @include('livewire.driver.inc.modals')

        <div class="table-responsive-sm  ">
            <table class="table font-size-card table-bordered table-sm table-hover mw-100">
                <caption>List of avilable orders {{$orders->count().'/'.$orders->total()}}</caption>
                <thead class="table-dark">
                <tr>
                    <th scope="col" wire:click="orderBy('id')">id <i class="fa-solid fa-caret-down"></i></th>
                    <th scope="col">name</th>

                    <th scope="col">from_address</th>
                    <th scope="col">to_address</th>
                    <th scope="col">phone</th>
                    <th scope="col" wire:click="orderBy('delivery_time')">Time <i class="fa-solid fa-caret-down"></i>
                    </th>
                    <th scope="col">action</th>
                </tr>
                </thead>
                <tbody>

                @forelse($orders as $order)

                        <?php
                        $now = \Carbon\Carbon::now();

                        $created_at = $order->delivery_time;
                        $diffHuman = $created_at->diffForHumans($now);
                        $diffDays = $created_at->diffInDays($now);
                        $diffHour = $created_at->diffInHours($now);
                        $diffMinutes = $created_at->diffInMinutes($now);

                        $isCurrentHour = $created_at->isCurrentHour();
                        $isCurrentDay = $created_at->isCurrentDay();
                        $isLastHour = $created_at->isLastHour();
                        $isLastMinute = $created_at->isLastMinute();
                        $isPast = $created_at->isPast();
//                            if ($diffDays >1 && $isPast) {
//                                \App\Models\Order::find($order->id)->update([
//                                    'canceled' => '1',
//                                    'failure_reason' => 'Failure',
//                                ]);
//                            }

                        ?>

                    <tr class="cursor-pointer">
                        <th wire:click="showOrder('{{$order->hashed_id}}')">{{$order->id}}</th>
                        <td wire:click="showOrder('{{$order->hashed_id}}')">{{$order->name}}</td>
                        <td wire:click="showOrder('{{$order->hashed_id}}')">{{$order->from_address}}</td>
                        <td wire:click="showOrder('{{$order->hashed_id}}')">{{$order->to_address}}</td>
                        <td wire:click="showOrder('{{$order->hashed_id}}')">{{$order->phone}}01021638451</td>
                        <td wire:click="showOrder('{{$order->hashed_id}}')">{{\Carbon\Carbon::parse($order->delivery_time)->diffForHumans(now())  }}</td>

                        <td>
                            <button class="btn btn-sm btn-success" wire:click="setIdFinish('{{$order->hashed_id}}')">
                                Finish
                            </button>
                            @if($diffHour>=1 &&!$isPast )
                                <button wire:click="setIdCancel('{{$order->hashed_id}}')" class="btn btn-sm btn-danger">
                                    Cancel
                                </button>
                            @endif

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
