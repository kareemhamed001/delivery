<div>
    <div class="row">
        <h4>
            Add User
        </h4>
        <div class="my-2">
            <form action="{{url('admin/addUser')}}" method="post" class="row">
                @csrf
                <div class="mb-2 col-md-6">
                    <label for="">User Name</label>
                    <input type="text" name="user_name" class="form-control" value="{{old('user_name')}}">
                    <span class="text-danger">
                        @error('user_name'){{$message}}@enderror
                    </span>
                </div>

                <div class="mb-2 col-md-6">
                    <label for="">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" value="{{old('phone_number')}}">
                    <span class="text-danger">
                        @error('phone_number'){{$message}}@enderror
                    </span>
                </div>
                <div class="mb-2 col-md-12">
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control" value="{{old('email')}}">
                    <span class="text-danger">
                        @error('email'){{$message}}@enderror
                    </span>
                </div>
                <div class="mb-2 col-md-6">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" value="{{old('password')}}">
                    <span class="text-danger">
                        @error('password'){{$message}}@enderror
                    </span>
                </div>
                <div class="mb-2 col-md-6">
                    <label for="">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" value="{{old('password_confirmation')}}">
                    <span class="text-danger">
                        @error('password_confirmation'){{$message}}@enderror
                    </span>
                </div>
                <div class="mb-2 ">
                        <?php $userType=old('user_type')?>
                    <label for="">User type</label>
                    <select class="form-select" name="user_type" wire:model="userType">

                        <option value=0 @if(old('user_type')==0)selected @endif>User  </option>
                        <option value=1 @if(old('user_type')==1)selected @endif>Driver</option>
                        <option value=2 @if(old('user_type')==2)selected @endif>Admin </option>
                    </select>
                    <span class="text-danger">
                        @error('user_type'){{$message}}@enderror
                    </span>
                </div>
                @if(old('user_type')==1 ||$userType==1)
                    <div class="row my-2">
                        <h5>Motorcycle Info</h5>

                        <div class="mb-3 col-md-4">
                            <label for="" class="form-label ">National Id</label>
                            <input value="{{old('national_id')}}" class="form-control" type="text" name="national_id">
                            <span class="text-danger">
                        @error('national_id'){{$message}}@enderror
                    </span>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="" class="form-label ">Motorcycle number</label>
                            <input value="{{old('moto_number')}}" class="form-control" type="text" name="moto_number">
                            <span class="text-danger">
                        @error('moto_number'){{$message}}@enderror
                    </span>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="" class="form-label ">Motorcycle model</label>
                            <select name="moto_model" class="form-select">
                                <option>--select year--</option>
                                @for($i=now()->year-5;$i<=now()->year;$i++)
                                    <option value="{{$i}}" @if($i == old('moto_model')) selected @endif>{{$i}}</option>
                                @endfor
                            </select>
                            <span class="text-danger">
                        @error('moto_model'){{$message}}@enderror
                    </span>

                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="" class="form-label ">The year of obtaining motorcycle license</label>
                            <select name="year_of_getting_licence" class="form-select">
                                <option>--select year--</option>
                                @for($i=now()->year-3;$i<=now()->year;$i++)
                                    <option value="{{$i}}" @if($i == old('year_of_getting_licence')) selected @endif>{{$i}}</option>
                                @endfor
                            </select>
                            <span class="text-danger">
                        @error('year_of_getting_licence'){{$message}}@enderror
                    </span>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="" class="form-label ">The number of years of motorcycle license</label>
                            <select name="number_of_years_of_the_license" class="form-select">
                                <option>--select number of year--</option>
                                @for($i=1;$i<=3;$i++)
                                    <option value="{{$i}}"
                                            @if($i == old('number_of_years_of_the_license')) selected @endif>{{$i}}</option>
                                @endfor
                            </select>
                            <span class="text-danger">
                        @error('number_of_years_of_the_license'){{$message}}@enderror
                    </span>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="" class="form-label ">Have aBox?</label>
                            <br>
                            <input   class="form-check-input" type="checkbox" name="have_box">
                            <span class="text-danger">
                        @error('have_box'){{$message}}@enderror
                    </span>
                        </div>

                    </div>

                @endif
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary mx-1" type="submit">Save</button>
                    <button class="btn btn-danger mx-1" type="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
