<div wire:ignore.self class="modal fade p-1" id="showOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div wire:loading class="p-2">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>

            <div wire:loading.remove>

                    <div class="modal-body">

                        <div class="mb-3">

                            <label for="">{{__('makeOrderPage.Order Name')}} </label>
                            <input class="form-control text-break" type="text" name="orderName" value="{{$orderName}}"
                                   placeholder="ما الذي تريد توصيله" title="ما الذي تريد توصيله" wire:model.defer="orderName">
                            <span class="text-danger">
                                @error('orderName'){{$message}}@enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="">{{__('makeOrderPage.Order description')}} </label>
                            <input class="form-control text-break" type="text" name="orderDescription"
                                   value="{{$orderDescription}}" placeholder="تفاصيل الطلب (الوزن,الابعاد)"
                                   title="تفاصيل الطلب" wire:model.defer="orderDescription">
                            <span class="text-danger">
                                @error('orderDescription'){{$message}}@enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="">{{__('makeOrderPage.From')}} </label>
                            <input id="pac-input" class="form-control text-break" type="text" name="fromAddress" value="{{$fromAddress}}" placeholder="مكان استلام الطلب" title="مكان استلام الطلب" >
                            <span class="text-danger">
                        @error('fromAddress'){{$message}}@enderror
                    </span>
                        </div>
                        <div class="mb-3">
                            <label for="">{{__('makeOrderPage.To')}} </label>
                            <input  class="form-control text-break" type="text" name="toAddress" value="{{$toAddress}}" placeholder="مكان توصيل الطلب" title="مكان توصيل الطلب" >
                            <span class="text-danger">
                        @error('toAddress'){{$message}}@enderror
                    </span>
                        </div>
                        <div class="mb-3">
                            <label for="">Time</label>
                            <input  class="form-control text-break" type="text" name="toAddress" value=" {{$date}}" placeholder="مكان توصيل الطلب" title="مكان توصيل الطلب" >
                            <span class="text-danger">
                        @error('toAddress'){{$message}}@enderror

                        </div>

                        <div class="mb-3">
                            <label >{{__('makeOrderPage.Notes')}} </label>

                            <textarea class="form-control text-break" name="notes" id=""  rows="3" title="ملاحظات" wire:model.defer="notes">{{$notes}}</textarea>
                            <span class="text-danger">
                        @error('time'){{$message}}@enderror
                    </span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>

            </div>
        </div>
    </div>
</div>


<div wire:ignore.self class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <p>
                    Are you sure cancel this order.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" wire:click="cancelOrder">Yes</button>
            </div>
        </div>
    </div>
</div>

