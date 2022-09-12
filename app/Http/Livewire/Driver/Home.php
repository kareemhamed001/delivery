<?php

namespace App\Http\Livewire\Driver;

use App\Models\Order;
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
    public function render()
    {
        $orders=Order::where('canceled','0')->where('accepted','0')->where('finished','0')->where(function ($query){
            $query->where('name','like','%'.$this->term.'%')->orWhere('id','like','%'.$this->term.'%')->orWhere('description','like','%'.$this->term.'%')
                ->orWhere('from_address','like','%'.$this->term.'%')
                ->orWhere('to_address','like','%'.$this->term.'%')
            ;
        })->paginate(25);
        return view('livewire.inc.home',compact('orders'));
    }
}
