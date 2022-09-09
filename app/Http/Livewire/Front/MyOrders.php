<?php

namespace App\Http\Livewire\Front;

use App\Models\Order;
use Livewire\Component;

class MyOrders extends Component
{
    public function render()
    {
        $orders=Order::all();
        return view('livewire.front.my-orders',compact('orders'));
    }
}
