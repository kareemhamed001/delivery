<?php

namespace App\Http\Livewire\Front;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DeliveredOrders extends Component
{

    public $term='';

    use WithPagination;
    protected $paginationTheme='bootstrap';

    public function render()
    {
        $orders = Order::where('user_id',Auth::user()->id)->where('accepted','=','1')->where('finished','=','1')
            ->where(function ($query)
            {
                $query->where('name','like','%'.$this->term.'%')->orWhere('id','like','%'.$this->term.'%') ;
            })
            ->paginate(10);
        return view('livewire.front.delivered-orders',compact('orders'));
    }
}
