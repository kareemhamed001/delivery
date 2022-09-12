
<div wire:ignore.self class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div wire:loading class="p-2">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>

            <div wire:loading.remove>
                <form wire:submit.prevent="updateOrder" method="post">

                    <div class="modal-body">

                        <div class="mb-3">

                            <label for="">{{__('makeOrderPage.Order Name')}} </label>
                            <input class="form-control" type="text" name="orderName" value="{{$orderName}}"
                                   placeholder="ما الذي تريد توصيله" title="ما الذي تريد توصيله" wire:model.defer="orderName">
                            <span class="text-danger">
                                @error('orderName'){{$message}}@enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="">{{__('makeOrderPage.Order description')}} </label>
                            <input class="form-control" type="text" name="orderDescription"
                                   value="{{$orderDescription}}" placeholder="تفاصيل الطلب (الوزن,الابعاد)"
                                   title="تفاصيل الطلب" wire:model.defer="orderDescription">
                            <span class="text-danger">
                                @error('orderDescription'){{$message}}@enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="">{{__('makeOrderPage.From')}} </label>
                            <input id="pac-input" class="form-control" type="text" name="fromAddress" value="{{$fromAddress}}" placeholder="مكان استلام الطلب" title="مكان استلام الطلب" wire:model.defer="fromAddress">
                            <span class="text-danger">
                        @error('fromAddress'){{$message}}@enderror
                    </span>
                        </div>
                        <div class="mb-3">
                            <label for="">{{__('makeOrderPage.To')}} </label>
                            <input  class="form-control" type="text" name="toAddress" value="{{$toAddress}}" placeholder="مكان توصيل الطلب" title="مكان توصيل الطلب" wire:model.defer="toAddress">
                            <span class="text-danger">
                        @error('toAddress'){{$message}}@enderror
                    </span>
                        </div>
                        <div class="mb-3">
                            <label for="">{{__('makeOrderPage.Date')}} </label>
                            <input class="form-control" type="date" name="date" value="{{date($date)}}" placeholder="تاريخ التوصيل" title="تاريخ توصيل الطلب" wire:model.defer="date">
                            <span class="text-danger">
                        @error('date'){{$message}}@enderror
                    </span>
                        </div>
                        <div class="mb-3">
                            <label for="">{{__('makeOrderPage.Time')}} </label>
                            <input class="form-control" type="time" name="time" value="{{date($time)}}" title="وقت تسليمنا الطلب"wire:model.defer="time" >
                            <span class="text-danger">
                        @error('time'){{$message}}@enderror
                    </span>
                        </div>
                        <div class="mb-3">
                            <label >{{__('makeOrderPage.Notes')}} </label>

                            <textarea class="form-control" name="notes" id=""  rows="3" title="ملاحظات" wire:model.defer="notes">{{$notes}}</textarea>
                            <span class="text-danger">
                        @error('time'){{$message}}@enderror
                    </span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
