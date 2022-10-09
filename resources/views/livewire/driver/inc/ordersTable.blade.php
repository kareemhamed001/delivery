@include('livewire.driver.inc.modals')
<div class="table-responsive ">

    <div  class="d-flex justify-content-center">
        <div wire:loading class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <table class="table font-size-card  table-sm table-hover mw-100">

        <caption>List of avilable orders  {{$orders->count().'/'.$orders->total()}}</caption>
        <thead class="table-dark">
        <tr >
            <th class="col-1 col-md-1 cursor-pointer py-2" wire:click="orderBy('id')">id <i class="fa-solid fa-caret-down"></i></th>
            <th class="col-1 col-md-1 d-none d-sm-table-cell py-2"  >name</th>

            <th class="col-4 col-md-4 py-2" >from_address</th>
            <th class="col-4 col-md-4 d-none d-sm-table-cell py-2 " >to_address</th>

            <th class="col-1 col-md-1 cursor-pointer py-2" wire:click="orderBy('delivery_time')">Time <i class="fa-solid fa-caret-down"></i></th>
            <th class="col-1 col-md-1 cursor-pointer py-2">Price <i class="fa-solid fa-caret-down"></i></th>
            <th class="col-1 col-md-1 py-2" >action</th>
        </tr>
        </thead>
        <tbody>


        @forelse($orders as $order)

            <tr class="cursor-pointer">
                <th  wire:click="showOrder('{{ $order->hashed_id }}')">{{ $order->id }}</th>
                <td class="d-none d-sm-table-cell" wire:click="showOrder('{{ $order->hashed_id }}')">{{$order->name}}</td>

                <td  wire:click="showOrder('{{ $order->hashed_id }}')">{{$order->from_address}}</td>
                <td class="d-none d-sm-table-cell" wire:click="showOrder('{{$order->hashed_id}}')">{{$order->to_address}}</td>

                <td  wire:click="showOrder('{{$order->hashed_id}}')">{{\Carbon\Carbon::parse($order->delivery_time)->diffForHumans(now())  }}</td>

                <td class="d-none d-sm-table-cell" wire:click="showOrder('{{$order->hashed_id}}')">$ {{$order->price}}</td>
                <td>
                    <button class="btn btn-sm btn-success"  wire:click="setAddress('{{ $order->hashed_id }}')">Accept</button>
                </td>

            </tr>
        @empty
        @endforelse
        </tbody>
    </table>


</div>
<div class="overflow-auto">
    {{$orders->links()}}
</div>
