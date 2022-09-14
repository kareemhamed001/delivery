<?php

namespace App\Http\Livewire\Driver;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RunningOrders extends Component
{

    public $term='';
    public $orderId,$orderName,$orderDescription,$fromAddress,$toAddress,$date,$time,$notes;
    use WithPagination;
    protected $paginationTheme='bootstrap';

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

    function setId($id){
        $this->orderId=$id;


    }

    function cancelOrder(){
        try {
            $order=Order::find($this->orderId);
            if ($order){
                $order->delete();
                session()->flash('done','order canceled successfully');
                $this->dispatchBrowserEvent('close-modal');
            }else{

            }
        }catch (Exception $e){

        }
    }

    public function render()
    {
        $orders=Order::where('accepted_by',Auth::user()->id)->where('accepted','1')->where('finished','0')
           ->where(function ($query){
               $query->where('name','like','%'.$this->term.'%')->orWhere('id','like','%'.$this->term.'%')
                   ->orWhere('from_address','like','%'.$this->term.'%')
                   ->orWhere('to_address','like','%'.$this->term.'%');
           })
            ->paginate(25);
        return view('livewire.driver.running-orders',compact('orders'));
    }
}
