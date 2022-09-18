<?php

namespace App\Http\Livewire\Driver;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DeliveredOrders extends Component
{
    public $term = '';
    public $orderName,$orderDescription,$fromAddress,$toAddress,$date,$time,$notes,$orderPrice,$phone,$orderBy='delivery_time';
    public $orderId,$userName;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    function orderBy($value){
        $this->orderBy=$value;
    }

    function showOrder($id)
    {
        try {
            $order = Order::find($id);

            $now = \Carbon\Carbon::now();

            $created_at = \Carbon\Carbon::parse($order->delivery_time);
            $diffHuman = $created_at->diffForHumans($now);

            if ($order) {
                $this->orderId=$id;
                $this->userName=$order->user->name;
                $this->orderName=$order->name;
                $this->orderPrice=$order->price;
                $this->orderDescription=$order->description;
                $this->fromAddress=$order->from_address;
                $this->toAddress=$order->to_address;
                $this->date=$diffHuman ;
                $this->notes=$order->notes;
                $this->phone=$order->user->phone_number;
                if ($this->orderId &&$this->fromAddress && $this->toAddress &&$this->orderName &&$this->orderDescription &&$this->date &&$this->notes){
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
        $this->dispatchBrowserEvent('close-modal');
    }



    public function render()
    {

        $orders = Order::where('accepted_by', Auth::user()->id)->where('finished_by', Auth::user()->id)->where('accepted', '1')->where('finished', '1')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->term . '%')->orWhere('id', 'like', '%' . $this->term . '%')
                    ->orWhere('from_address', 'like', '%' . $this->term . '%')
                    ->orWhere('to_address', 'like', '%' . $this->term . '%');
            })
            ->orderBy($this->orderBy,'asc')
            ->paginate(25);
        return view('livewire.driver.delivered-orders',compact('orders'));
    }
}
