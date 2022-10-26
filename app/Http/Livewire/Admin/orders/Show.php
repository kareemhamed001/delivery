<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    public $order;
    use WithPagination;
    protected $paginationTheme="bootstrap";

    function displayOrder($id){
//        dd($id);
        $this->order=Order::where('id',$id)->first();

    }

    public function render()
    {
        $moreOrders=Order::paginate(25);
        return view('livewire.admin.orders.show',compact('moreOrders'));
    }
}
