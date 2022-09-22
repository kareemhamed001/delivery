<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{

    public $term='';
    public $orderName,$orderDescription,$fromAddress,$toAddress,$date,$time,$notes,$orderPrice,$phone,$orderBy='delivery_time';
    public $orderId,$userName;
    use WithPagination;
    protected $paginationTheme='bootstrap';

    function orderBy($value){
        $this->orderBy=$value;
    }

    public function rules()
    {
        return [
            'orderPrice'=>['required','numeric','max:1000'],
        ];
    }

    function acceptOrder(){


//        try {
        $validatedData = $this->validate();

        $order=Order::find($this->orderId);
        if ($order && $this->orderPrice){


            $order->update([
                'accepted'=>'1',
                'price'=>$this->orderPrice,
                'accepted_by'=>Auth::user()->id
            ]);
            $this->dispatchBrowserEvent('close-modals');
            $this->emptyFields();
        }else{
            $validatedData = $this->validate();

        }
//        }catch (Exception $e){
//
//            return $e;
//        }
    }

    function setAddress($id){
        try {
            $order=Order::where('hashed_id',$id)->first();
            if ($order){
                $this->orderId=$order->id;
                $this->fromAddress=$order->from_address;
                $this->toAddress=$order->to_address;
                if ($this->orderId &&$this->fromAddress && $this->toAddress){
                    $this->dispatchBrowserEvent('openAcceptOrderModal');
                }
            }else{

            }

        }catch (Exception $e){

        }

    }

    function showOrder($id){
        try {


            $order=Order::where('hashed_id',$id)->first();

            $now = \Carbon\Carbon::now();

            $created_at = \Carbon\Carbon::parse($order->delivery_time);
            $diffHuman = $created_at->diffForHumans($now);

            if ($order){
                $this->orderId=$order->id;
                $this->userName=$order->user->name;
                $this->orderName=$order->name;
                $this->orderDescription=$order->description;
                $this->fromAddress=$order->from_address;
                $this->toAddress=$order->to_address;
                $this->date=$diffHuman ;
                $this->notes=$order->notes;
                $this->phone=$order->user->phone_number;
                if ($this->orderId &&$this->fromAddress && $this->toAddress &&$this->orderName &&$this->orderDescription &&$this->date &&$this->notes){

                    $this->dispatchBrowserEvent('openShowOrderModal');
                }
            }else{

            }
        }catch (Exception $e){

        }
    }
    function emptyFields(){
        $this->orderId=null;
        $this->orderName=null;
        $this->orderPrice=null;
        $this->orderDescription=null;
        $this->fromAddress=null;
        $this->toAddress=null;
        $this->date=null;
        $this->time=null;
        $this->notes=null;
    }

    function closeModal(){
        $this->emptyFields();
    }


    public function render()
    {

        $orders=Order::with('user')->where('canceled','0')->where('accepted','0')->where('finished','0')
            ->whereRaw('Date(delivery_time) BETWEEN CURDATE()-2 AND CURDATE()')
            ->where(function ($query){
                $query
                    ->where('name','like','%'.$this->term.'%')->orWhere('id','like','%'.$this->term.'%')
                    ->orWhere('from_address','like','%'.$this->term.'%')
                    ->orWhere('to_address','like','%'.$this->term.'%')
                ;
            })->orderBy($this->orderBy,'asc')->paginate(25);
        return view('livewire.admin.orders' ,compact('orders'));
    }
}
