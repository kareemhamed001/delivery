<?php

namespace App\Http\Livewire\Admin\orders;

use App\Http\Livewire\Admin\Exception;
use App\Models\Order;
use App\Traits\OrdersTrait;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use OrdersTrait;

    public $term = '';
    public $orderName, $orderDescription, $fromAddress, $toAddress, $date, $time, $notes, $orderPrice, $phone, $orderBy = 'delivery_time', $arrange = 'asc';
    public $orderId, $userName;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public function rules()
    {
        return [
            'orderPrice' => ['required', 'numeric', 'max:1000'],
        ];
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

    public function render()
    {
        $orders = $this->getOrders();
        return view('livewire.admin.orders.orders', compact('orders'));
    }
}
