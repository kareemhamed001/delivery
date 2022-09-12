<?php

namespace App\Http\Livewire\Driver;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MyOrders extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';

    public $term='';
    public $orderId,$orderName,$orderDescription,$fromAddress,$toAddress,$date,$time,$notes;

    function showOrder($id){
        try {
            $order=Order::find($id);

            $now = \Carbon\Carbon::now();

            $created_at = \Carbon\Carbon::parse($order->delivery_time);
            $diffHuman = $created_at->diffForHumans($now);

            if ($order){
                $this->orderId=$id;
                $this->orderName=$order->name;
                $this->orderDescription=$order->description;
                $this->fromAddress=$order->from_address;
                $this->toAddress=$order->to_address;
                $this->date=$diffHuman ;


                $this->notes=$order->notes;
            }else{

            }
        }catch (Exception $e){

        }
    }

    function accept($id){
        try {
            $order=Order::find($id);
            if ($order){
                $order->update([
                    'accepted'=>'0',
                    'accepted_by'=>Auth::user()->id,
                ]);
            }else{

            }
        }catch (Exception $e){

        }
    }

    public function render()
    {
        $orders=Auth::user()->orders()->where('accepted','1')->where('finished','0')->where(function ($query){
            $query->where('name','like','%'.$this->term.'%')->orWhere('id','like','%'.$this->term.'%')
                ->orWhere('from_address','like','%'.$this->term.'%')
                ->orWhere('to_address','like','%'.$this->term.'%')

            ;
        })->paginate(10);
        return view('livewire.driver.my-orders',compact('orders'));
    }
}
