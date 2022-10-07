<?php

namespace App\Http\Livewire\Admin\orders;

use App\Http\Livewire\Admin\Exception;
use App\Models\Order;
use App\Traits\OrdersTrait;
use Livewire\Component;

class PendingOrders extends Component
{
    use OrdersTrait;

    protected $paginationTheme = 'bootstrap';


    public function rules()
    {
        return [
            'orderPrice' => ['required', 'numeric', 'max:1000'],
        ];
    }


    public function render()
    {

        $orders = $this->getPendingOrders();
        return view('livewire.admin.orders.pending-orders', compact('orders'));
    }
}
