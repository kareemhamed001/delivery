<?php

namespace App\Http\Livewire\Admin\orders;

use App\Traits\OrdersTrait;
use Livewire\Component;

class TodayOrders extends Component
{
    use OrdersTrait;
    protected $paginationTheme = 'bootstrap';

    public $filterValue;

    public function rules()
    {
        return [
            'orderPrice' => ['required', 'numeric', 'max:1000'],
        ];
    }

    public function render()
    {

        $orders = $this->getTodayOrders();
        return view('livewire.admin.orders.today-orders',compact('orders'));
    }
}
