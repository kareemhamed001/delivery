<?php

namespace App\Http\Livewire\Front;

use App\Http\Requests\OrderRequest;
use App\Models\brand;
use App\Models\Order;
use Exception;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class RunningOrders extends Component
{
    public $term='';
    public $orderId,$orderName,$orderDescription,$fromAddress,$toAddress,$date,$time,$notes;

    use WithPagination;
    protected $paginationTheme='bootstrap';

    public function rules()
    {
        return [
            'orderName'=>['required','string','max:100'],
            'orderDescription'=>['required','string','max:255'],
            'fromAddress'=>['required','string','max:255'],
            'toAddress'=>['required','string','max:255'],
            'date'=>['required','date'],
            'time'=>['required'],
            'notes'=>['nullable','max:1000'],
        ];
    }
    function emptyFields(){
        $this->orderId=null;
        $this->orderName=null;
        $this->orderDescription=null;
        $this->fromAddress=null;
        $this->toAddress=null;
        $this->date=null;
        $this->time=null;
        $this->notes=null;
    }

    function editOrder( $id){
        $order=Order::find($id);
        try {
            if ($order){
                $this->orderId=$id;
                $this->orderName=$order->name;
                $this->orderDescription=$order->description;
                $this->fromAddress=$order->from_address;
                $this->toAddress=$order->to_address;
                $this->date=$order->date;
                $this->time=$order->time;
                $this->notes=$order->notes;

            }else{

            }
        }catch (Exception $e){

        }
    }

    function updateOrder(){
        $validatedData = $this->validate();

//        dd($validatedData['orderName']);
        try {
            $order=Order::find($this->orderId);

            $order->update([
                'name' => $this->orderName,
                'description' =>  $this->orderDescription,
                'from_address' =>  $this->fromAddress,
                'to_address'=> $this->toAddress,
                'notes'=> $this->notes,
                'date'=> $this->date,
                'time'=> $this->time
            ]);

        }catch (Exception $e){
            return $e;
        }

        session()->flash('done', 'Order Updated Successfully');

        $this->dispatchBrowserEvent('close-modal');
        $this->emptyFields();
    }

    public function render()
    {
        $orders = Order::where('user_id',Auth::user()->id)->where('accepted','=','1')->where('finished','=','0')->where('canceled','0')
            ->where(function ($query)
            {
                $query->where('name','like','%'.$this->term.'%')->orWhere('id','like','%'.$this->term.'%') ;
            })
            ->orderBy('delivery_time','asc')->paginate(10);
        return view('livewire.front.running-orders',compact( 'orders'));
    }
}
