<div>
    <section class="row d-flex flex-column  justify-content-center  bg-opacity-75 rounded position-relative">
        <div class="pt-4">

            <h4 class="">
{{--                <i class="fa-solid fa-house-chimney text-secondary "></i>--}}
                {{__('makeOrderPage.Make Order')}}
                <hr>
            </h4>
        </div>

        <div class="">
            <form class="d-flex flex-wrap justify-content-center bg-light shadow bg-opacity-50 p-2 rounded" method="post" action="{{url('admin/orders/create')}}" enctype="multipart/form-data">
                @csrf
                <div class="my-2 col-12 col-sm-12 col-md-12 p-1">
                    <label for="">{{__('User Name')}} </label>
                    <input class="form-control" type="text" name="userName" value="{{old('userName')}}" placeholder="اسم المستخدم" title="اسم المستخدم">
                    <span class="text-danger">
                        @error('userName'){{$message}}@enderror
                    </span>
                </div>
                <div class="my-2 col-12 col-sm-12 col-md-6 p-1">
                    <label for="">{{__('User Email')}} </label>
                    <input class="form-control" type="text" name="email" value="{{old('email')}}" placeholder="ايميل المستخدم" title="ايميل المستخدم">
                    <span class="text-danger">
                        @error('email'){{$message}}@enderror
                    </span>
                </div>
                <div class="my-2 col-12 col-sm-12 col-md-6 p-1">
                    <label for="">{{__('Phone Number')}} </label>
                    <input class="form-control" type="text" name="userPhone" value="{{old('userPhone')}}" placeholder="رقم موبايل المستخدم" title="رقم موبايل المستخدم">
                    <span class="text-danger">
                        @error('userPhone'){{$message}}@enderror
                    </span>
                </div>






                <div class="my-2 col-12 col-sm-12 col-md-6 p-1">
                    <label for="">{{__('makeOrderPage.Order Name')}} </label>
                    <input class="form-control" type="text" name="orderName" value="{{old('orderName')}}" placeholder="ما الذي تريد توصيله" title="ما الذي تريد توصيله">
                    <span class="text-danger">
                        @error('orderName'){{$message}}@enderror
                    </span>
                </div>
                <div class="my-2 col-12 col-sm-12 col-md-6 p-1">
                    <label for="">{{__('makeOrderPage.Order description')}} </label>
                    <input class="form-control" type="text" name="orderDescription" value="{{old('orderDescription')}}" placeholder="تفاصيل الطلب (الوزن,الابعاد)" title="تفاصيل الطلب">
                    <span class="text-danger">
                        @error('orderDescription'){{$message}}@enderror
                    </span>
                </div>
                <div class="my-2 col-12 col-sm-12 col-md-6 p-1">
                    <label for="">{{__('makeOrderPage.From')}} </label>
                    <input id="pac-input" class="form-control" type="text" name="fromAddress" value="{{old('fromAddress')}}" placeholder="مكان استلام الطلب" title="مكان استلام الطلب">
                    <span class="text-danger">
                        @error('fromAddress'){{$message}}@enderror
                    </span>
                </div>
                <div class="my-2 col-12 col-sm-12 col-md-6 p-1">
                    <label for="">{{__('makeOrderPage.To')}} </label>
                    <input  class="form-control" type="text" name="toAddress" value="{{old('toAddress')}}" placeholder="مكان توصيل الطلب" title="مكان توصيل الطلب">
                    <span class="text-danger">
                        @error('toAddress'){{$message}}@enderror
                    </span>

                </div>
                {{--                <div class="col-12 col-sm-12 col-md-12">--}}
                {{--                    <div id="map" class="w-50" style="height: 200px"></div>--}}
                {{--                </div>--}}


                <div class="row w-100">
                    <div class="my-2 col-6 col-md-6 p-1">
                        <label for="">{{__('makeOrderPage.Date')}} </label>
                        <input class="form-control" type="date" name="date" value="{{old('date')}}" placeholder="تاريخ التوصيل" title="تاريخ توصيل الطلب">
                        <span class="text-danger">
                        @error('date'){{$message}}@enderror
                    </span>
                    </div>
                    <div class="my-2 col-6 col-md-6 p-1">
                        <label for="">{{__('makeOrderPage.Time')}} </label>
                        <input class="form-control" type="time" name="time" value="{{old('time')}}" title="وقت تسليمنا الطلب" >
                        <span class="text-danger">
                        @error('time'){{$message}}@enderror
                    </span>
                    </div>
                </div>

                <div class="my-2 col-12 p-1">
                    <label for="">{{__('makeOrderPage.Notes')}} </label>

                    <textarea  class="form-control" name="notes" id=""  rows="3" title="ملاحظات">{{old('notes')}}</textarea>
                    <span class="text-danger">
                        @error('notes'){{$message}}@enderror
                    </span>
                </div>
                <div class="col-12 my-2  ">
                    <button class="btn text-white bg-secondary mx-1 float-end " type="submit" >{{__('makeOrderPage.Save')}}</button>
                    <button class="btn text-white bg-danger mx-1 float-end" type="reset">{{__('makeOrderPage.Cancel')}}</button>
                </div>

            </form>
        </div>
    </section>

</div>
