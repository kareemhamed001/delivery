<?php

namespace App\Http\Livewire\Admin\orders;

use App\Models\Order;
use App\Traits\OrdersTrait;
use Livewire\Component;

class TodayOrders extends Component
{
    use OrdersTrait;

    protected $paginationTheme = 'bootstrap';

    public $filterValue = 0;

    public function rules()
    {
        return [
            'orderPrice' => ['required', 'numeric', 'max:1000'],
        ];
    }

    public function render()
    {
        $title='Today\'s';
        $query = Order::query();
        if ($this->filterValue) {
            if ($this->filterValue == 1) {

                $title='Today pending';

                $query->where('accepted', '0')->where('finished', '0')->where('canceled', '0');

            } else if ($this->filterValue == 2) {

                $title='Today running';

                $query->where('accepted', '1')->where('finished', '0')->where('canceled', '0');

            } else if ($this->filterValue == 3) {

                $title='Today finished';

                $query->where('accepted', '1')->where('finished', '1');

            } else if ($this->filterValue == 4) {

                $title='Today canceled';

                $query->where('canceled', '1');

            }
        }
        $orders = $query->with('user')->whereRaw('DATE(delivery_time)=CURDATE()')
            ->where(function ($query) {
                $query
                    ->where('name', 'like', '%' . $this->term . '%')->orWhere('id', 'like', '%' . $this->term . '%')
                    ->orWhere('from_address', 'like', '%' . $this->term . '%')
                    ->orWhere('to_address', 'like', '%' . $this->term . '%');
            })->orderBy($this->orderBy, $this->arrange)->paginate(50);
        $ordersCount=$orders->total();



        return view('livewire.admin.orders.today-orders', compact('orders','ordersCount','title'));
    }
}
