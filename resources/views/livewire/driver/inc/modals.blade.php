<div wire:ignore.self class="modal  modal-xl  fade p-1" id="showOrderModal" tabindex="-1"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal"></button>
            </div>

            <div wire:loading class="p-2">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>

            <div wire:loading.remove>

                <div class="modal-body row">

                    <div class="col-12 col-md-6">

                        <label for="">{{__('makeOrderPage.Order Id')}} </label>
                        <input class="form-control text-break" type="text" value="{{$orderId}}"
                               placeholder="رقم الطلب" title="رقم الطلب"
                        >
                        <span class="text-danger">
                                @error('orderName'){{$message}}@enderror
                            </span>
                    </div>

                    <div class="col-12 col-md-6">

                        <label for="">{{__('makeOrderPage.Order Name')}} </label>
                        <input class="form-control text-break" type="text" value="{{$orderName}}"
                               placeholder="ما الذي تريد توصيله" title="ما الذي تريد توصيله"
                        >
                        <span class="text-danger">
                                @error('orderName'){{$message}}@enderror
                            </span>
                    </div>

                    <div class="mb-3">
                        <label for="">{{__('makeOrderPage.Order description')}} </label>
                        <textarea class="form-control text-break" id="" rows="1"
                                  title="ملاحظات">{{$orderDescription}}</textarea>
                        <span class="text-danger">
                                @error('orderDescription'){{$message}}@enderror
                            </span>
                    </div>

                    <div class="col-12 col-md-6">

                        <label for="">{{__('makeOrderPage.User Name')}} </label>
                        <input class="form-control text-break" type="text" value="{{$userName}}"
                               placeholder="اسم العميل" title="اسم العميل"
                        >
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="">Phone</label>
                        <input class="form-control text-break" type="text" value=" {{$phone}}"
                               placeholder="رقم موبايل العميل" title="رقم موبايل العميل">
                        <span class="text-danger">
                        @error('toAddress'){{$message}}@enderror

                    </div>

                    <div class="col-12 col-md-6">

                        <label for="">{{__('makeOrderPage.Order Price')}} </label>
                        <input class="form-control text-break" type="text" value="{{$orderPrice}}"
                               placeholder="سعر التوصيل" title="سعر التوصيل"
                        >
                        <span class="text-danger">
                                @error('orderName'){{$message}}@enderror
                            </span>
                    </div>


                    <div class="col-12 col-md-6">
                        <label for="">Time</label>
                        <input class="form-control text-break" type="text" value=" {{$date}}"
                               placeholder="مكان توصيل الطلب" title="مكان توصيل الطلب">
                        <span class="text-danger">
                        @error('toAddress'){{$message}}@enderror

                    </div>


                    <div class="mb-3">
                        <label for="">{{__('makeOrderPage.From')}} </label>
                        <input id="pac-input" class="form-control text-break" type="text"
                               value="{{$fromAddress}}" placeholder="مكان استلام الطلب" title="مكان استلام الطلب">
                        <span class="text-danger">
                        @error('fromAddress'){{$message}}@enderror
                    </span>
                    </div>
                    <div class="mb-3">
                        <label for="">{{__('makeOrderPage.To')}} </label>
                        <input class="form-control text-break" type="text" value="{{$toAddress}}"
                               placeholder="مكان توصيل الطلب" title="مكان توصيل الطلب">
                        <span class="text-danger">
                        @error('toAddress'){{$message}}@enderror
                    </span>
                    </div>


                    <div class="mb-3">
                        <label>{{__('makeOrderPage.Notes')}} </label>

                        <textarea class="form-control text-break" id="" rows="1" title="ملاحظات">{{$notes}}</textarea>
                        <span class="text-danger">
                        @error('time'){{$message}}@enderror
                    </span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>


<div wire:ignore.self class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal"></button>
            </div>
            <div class="modal-body ">
                <p>
                    Are you sure cancel this order.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">No
                </button>
                <button type="button" class="btn btn-danger" wire:click="cancelOrder">Yes</button>
            </div>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="finishOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">Finish Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal"></button>
            </div>
            <div class="modal-body ">
                <p>
                    Are you delivered this order.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">No
                </button>
                <button type="button" class="btn btn-danger" wire:click="finishOrder">Yes</button>
            </div>
        </div>
    </div>
</div>


<div wire:ignore.self class="modal fade" id="acceptOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">Accept Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal"></button>
            </div>
            <div class="modal-body ">
                <div class="mb-3">

                    <label for="">{{__('makeOrderPage.From')}} </label>
                    <p class="form-control text-break">{{$fromAddress}}</p>

                </div>
                <div class="mb-3">
                    <label for="">{{__('makeOrderPage.To')}} </label>
                    <p class="form-control text-break">{{$toAddress}}</p>
                </div>
                <div class="mb-3">

                    <label for="">{{__('makeOrderPage.Price')}} </label>
                    <input class="form-control text-break" type="text" name="orderName" value="{{$orderPrice}}"
                           placeholder="ادخل سعر التوصيل" title="ما الذي تريد توصيله" wire:model.defer="orderPrice">
                    <span class="text-danger">
                                @error('orderPrice'){{$message}}@enderror
                            </span>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">Cancel
                </button>
                <button type="button" class="btn btn-danger" wire:click="acceptOrder">Accept</button>
            </div>
        </div>
    </div>
</div>


