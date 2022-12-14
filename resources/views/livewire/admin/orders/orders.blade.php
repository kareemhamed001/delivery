<div>
    @include('livewire.driver.inc.modals')
   <div>
       <h4 class="h4 font-weight-bold text-gray-800">Orders </h4>

       <div class="row mt-3">

           <div class="my-2">
               <div class="d-flex flex-column ">
                   <div class="col-12 col-md-4">
                       <input type="text" class="form-control" placeholder="search"  wire:model="term">
                   </div>
               </div>
           </div>

           <div class="table-responsive ">

               <table class="table font-size-card  table-sm table-hover mw-100">


                   <caption>List of avilable orders  {{$orders->count().'/'.$orders->total()}}</caption>
                   <thead class="table-primary">
                   <tr >
                       <th class="col-1 col-md-1 cursor-pointer py-2" wire:click="orderBy('id')">id <i class="fa-solid fa-caret-down"></i></th>
                       <th class="col-1 col-md-1 d-none d-sm-table-cell py-2"  >name</th>

                       <th class="col-4 col-md-4 py-2" >from_address</th>
                       <th class="col-4 col-md-4 d-none d-sm-table-cell py-2 " >to_address</th>

                       <th class="col-1 col-md-1 cursor-pointer py-2" wire:click="orderBy('delivery_time')">Time <i class="fa-solid fa-caret-down"></i></th>

                   </tr>
                   </thead>
{{--                   <div wire:loading class="p-2">--}}
{{--                       <div class="spinner-border text-primary" role="status">--}}
{{--                           <span class="sr-only"></span>--}}
{{--                       </div>--}}
{{--                   </div>--}}
                   <tbody >

                   @forelse($orders as $order)

                       <tr class="cursor-pointer">
                           <a class="text-decoration-none text-dark " href="{{url('admin/order/'.$order->id.'/show')}}">
                               <th ><a class="text-decoration-none text-dark " href="{{url('admin/order/'.$order->id.'/show')}}">{{ $order->id }}</a></th>
                               <td class="d-none d-sm-table-cell" ><a class="text-decoration-none text-dark" href="{{url('admin/order/'.$order->id.'/show')}}">{{$order->name}}</a> </td>

                               <td ><a class="text-decoration-none text-dark" href="{{url('admin/order/'.$order->id.'/show')}}">{{$order->from_address}}</a></td>
                               <td class="d-none d-sm-table-cell"><a class="text-decoration-none text-dark" href="{{url('admin/order/'.$order->id.'/show')}}">{{$order->to_address}}</a></td>

                               <td ><a class="text-decoration-none text-dark" href="{{url('admin/order/'.$order->id.'/show')}}">{{\Carbon\Carbon::parse($order->delivery_time)->diffForHumans(now())  }}</a></td>

                           </a>

                       </tr>
                   @empty
                   @endforelse
                   </tbody>
               </table>


           </div>
           <div class="overflow-auto">
               {{$orders->links()}}
           </div>
       </div>

   </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('close-modals', function () {
            $('#showOrderModal').modal('hide');
            $('#acceptOrderModal').modal('hide');
        });

        window.addEventListener('openShowOrderModal', function () {
            $('#showOrderModal').modal('show');

        });
        window.addEventListener('openAcceptOrderModal', function () {

            $('#acceptOrderModal').modal('show');
        });
    </script>
@endpush
