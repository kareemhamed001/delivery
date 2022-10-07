<?php

namespace App\Http\Livewire\Admin\orders;

use App\Http\Livewire\Admin\Exception;
use App\Models\Order;
use App\Traits\OrdersTrait;
use Livewire\Component;

class CanceledOrders extends Component
{
    use OrdersTrait;

    protected $paginationTheme = 'bootstrap';


    public function rules()
    {
        return [
            'orderPrice' => ['required', 'numeric', 'max:1000'],
        ];
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


    public function render()
    {

        $orders =$this->getCanceledOrders();
        return view('livewire.admin.orders.canceled-orders',compact('orders'));
    }
}
