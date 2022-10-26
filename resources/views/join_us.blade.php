@extends('layouts.front.index')
@section('content')
    <section class="container">
        <div class="py-2">
            <h3 class="text-capitalize">Join our drivers</h3>
        </div>
        <form action="{{url('join_us')}}" method="post" class="row">
            @csrf
            <div class="mb-3 col-md-4 ">
                <label for="" class="form-label ">Full name</label>
                <input value="{{old('name')}}" class="form-control " type="text" name="name">
                <span class="text-danger">
                        @error('name'){{$message}}@enderror
                    </span>
            </div>
            <div class="mb-3 col-md-4">
                <label for="" class="form-label ">Phone number</label>
                <input value="{{old('phone_number')}}" class="form-control" type="text" name="phone_number">
                <span class="text-danger">
                        @error('phone_number'){{$message}}@enderror
                    </span>
            </div>
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
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary mx-1" type="submit">Save</button>
                <button class="btn btn-danger mx-1" type="reset">Reset</button>
            </div>

        </form>

    </section>
@endsection
