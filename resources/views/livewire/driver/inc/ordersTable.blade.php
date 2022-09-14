@include('livewire.driver.inc.modals')
<div class="card-body table-responsive-sm  ">

    <table class="table font-size-card table-bordered table-sm table-hover">

        <caption>List of avilable orders  {{$orders->count().'/'.$orders->total()}}</caption>
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
                    data-bs-target="#showOrderModal" wire:click="showOrder({{$order->id}})">{{$order->name}}</td>

                <td data-bs-toggle="modal"
                    data-bs-target="#showOrderModal" wire:click="showOrder({{$order->id}})">{{$order->from_address}}</td>
                <td data-bs-toggle="modal"
                    data-bs-target="#showOrderModal" wire:click="showOrder({{$order->id}})">{{$order->to_address}}</td>
                <td data-bs-toggle="modal"
                    data-bs-target="#showOrderModal" wire:click="showOrder({{$order->id}})">{{$order->phone}}01021638451</td>
                <td data-bs-toggle="modal"
                    data-bs-target="#showOrderModal" wire:click="showOrder({{$order->id}})">{{\Carbon\Carbon::parse($order->delivery_time)->diffForHumans(now())  }}</td>

                <td>
                    <button class="btn btn-sm btn-success" wire:click="accept({{$order->id}})">Accept</button>
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
