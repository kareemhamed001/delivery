
@extends('layouts.admin.index')
@section('title',$order->name)
@section('content')
{{--    @livewire('admin.orders.show' ,['order'=>$order])--}}
    <livewire:admin.orders.show :order="$order">
@endsection
