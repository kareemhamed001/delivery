<?php

namespace App\Http\Livewire\Driver;

use App\Models\Order;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    public $term='';
    public $orderId,$orderName,$orderDescription,$fromAddress,$toAddress,$date,$time,$notes;
    use WithPagination;
    protected $paginationTheme='bootstrap';

    function accept($id){
        try {
            $order=Order::find($id);
            if ($order){
                $order->update([
                    'accepted'=>'1',
                    'accepted_by'=>Auth::user()->id,
                ]);
            }else{

            }
        }catch (Exception $e){

        }
    }

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
    public function render()
    {
        $orders=Order::where('canceled','0')->where('accepted','0')->where('finished','0')->where('accepted','0')->whereRaw('Date(delivery_time) BETWEEN CURDATE()-2 AND CURDATE()')
            ->where(function ($query){
            $query->where('name','like','%'.$this->term.'%')->orWhere('id','like','%'.$this->term.'%')->orWhere('description','like','%'.$this->term.'%')
                ->orWhere('from_address','like','%'.$this->term.'%')
                ->orWhere('to_address','like','%'.$this->term.'%')
            ;
        })->orderBy('delivery_time','asc')->paginate(25);
        return view('livewire.driver.home',compact('orders'));
    }
}
