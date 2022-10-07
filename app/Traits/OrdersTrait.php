<?php

namespace App\Traits;

use App\Models\Order;
use Livewire\WithPagination;

trait OrdersTrait
{

    public $term = '';
    public $orderName, $orderDescription, $fromAddress, $toAddress, $date, $time, $notes, $orderPrice, $phone, $orderBy = 'delivery_time', $arrange = 'asc';
    public $orderId, $userName;
    use WithPagination;

    function getOrders()
    {
        return Order::with('user')->where(function ($query) {
            $query->where('name', 'like', '%' . $this->term . '%')->orWhere('id', 'like', '%' . $this->term . '%')
                ->orWhere('from_address', 'like', '%' . $this->term . '%')
                ->orWhere('to_address', 'like', '%' . $this->term . '%');
        })->orderBy($this->orderBy, $this->arrange)->paginate(100);
    }

    function getPendingOrders()
    {
        return Order::where('accepted', 0)->where(function ($query) {
            $query->where('name', 'like', '%' . $this->term . '%')->orWhere('id', 'like', '%' . $this->term . '%')
                ->orWhere('from_address', 'like', '%' . $this->term . '%')
                ->orWhere('to_address', 'like', '%' . $this->term . '%');
        })->orderBy($this->orderBy, $this->arrange)->paginate(100);
    }

    function getFinishedOrders()
    {
        return Order::where('accepted', 1)->where('finished', 1)->where(function ($query) {
            $query->where('name', 'like', '%' . $this->term . '%')->orWhere('id', 'like', '%' . $this->term . '%')
                ->orWhere('from_address', 'like', '%' . $this->term . '%')
                ->orWhere('to_address', 'like', '%' . $this->term . '%');
        })->orderBy($this->orderBy, $this->arrange)->paginate(100);
    }

    function getCanceledOrders()
    {
        return Order::where('canceled', 1)->where(function ($query) {
            $query->where('name', 'like', '%' . $this->term . '%')->orWhere('id', 'like', '%' . $this->term . '%')
                ->orWhere('from_address', 'like', '%' . $this->term . '%')
                ->orWhere('to_address', 'like', '%' . $this->term . '%');
        })->orderBy($this->orderBy, $this->arrange)->paginate(100);
    }

    function getRunningOrders()
    {
        return Order::where('accepted', 1)->where('finished', 0)->where(function ($query) {
            $query->where('name', 'like', '%' . $this->term . '%')->orWhere('id', 'like', '%' . $this->term . '%')
                ->orWhere('from_address', 'like', '%' . $this->term . '%')
                ->orWhere('to_address', 'like', '%' . $this->term . '%');
        })->orderBy($this->orderBy, $this->arrange)->paginate(100);
    }

    function getTodayOrders()
    {
        return Order::with('user')->whereRaw('DATE(delivery_time)=CURDATE()')
            ->where(function ($query) {
                $query
                    ->where('name', 'like', '%' . $this->term . '%')->orWhere('id', 'like', '%' . $this->term . '%')
                    ->orWhere('from_address', 'like', '%' . $this->term . '%')
                    ->orWhere('to_address', 'like', '%' . $this->term . '%');
            })->orderBy($this->orderBy, $this->arrange)->paginate(100);
    }

    function showOrder($id)
    {
        try {
            $order = Order::where('hashed_id',$id)->first();
            if ($order) {
                $now = \Carbon\Carbon::now();
                $created_at = \Carbon\Carbon::parse($order->delivery_time);
                $diffHuman = $created_at->diffForHumans($now);
                $this->orderId = $order->id;
                $this->userName = $order->user->name;
                $this->orderName = $order->name;
                $this->orderDescription = $order->description;
                $this->fromAddress = $order->from_address;
                $this->toAddress = $order->to_address;
                $this->date = $diffHuman;
                $this->notes = $order->notes;
                $this->orderPrice = $order->price;
                $this->phone = $order->user->phone_number;

                if ($this->orderId && $this->fromAddress && $this->toAddress && $this->orderName && $this->orderDescription && $this->date) {

                    $this->dispatchBrowserEvent('openShowOrderModal');
                }
            } else {

            }
        } catch (Exception $e) {

        }
    }

    function emptyFields()
    {
        $this->orderId = null;
        $this->orderName = null;
        $this->orderPrice = null;
        $this->orderDescription = null;
        $this->fromAddress = null;
        $this->toAddress = null;
        $this->date = null;
        $this->time = null;
        $this->notes = null;
    }

    function closeModal()
    {
        $this->emptyFields();
        $this->dispatchBrowserEvent('close-modals');
    }

    function setAddress($id)
    {
        try {
            $order = Order::where('hashed_id', $id)->first();
            if ($order) {
                $this->orderId = $order->id;
                $this->fromAddress = $order->from_address;
                $this->toAddress = $order->to_address;
                if ($this->orderId && $this->fromAddress && $this->toAddress) {
                    $this->dispatchBrowserEvent('openAcceptOrderModal');
                }
            } else {

            }

        } catch (Exception $e) {

        }

    }

    function acceptOrder()
    {
        $validatedData = $this->validate();

        $order = Order::find($this->orderId);
        if ($order && $this->orderPrice) {
            $order->update([
                'price' => $this->orderPrice
            ]);
            $this->dispatchBrowserEvent('close-modals');
            $this->emptyFields();
        } else {
            $validatedData = $this->validate();
        }
    }

    function orderBy($value)
    {
        if ($this->orderBy == $value) {
            if ($this->arrange == 'asc') {
                $this->arrange = 'desc';
            } else {
                $this->arrange = 'asc';
            }
        }
        $this->orderBy = $value;
    }
}
