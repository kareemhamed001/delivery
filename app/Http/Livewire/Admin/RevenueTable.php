<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class RevenueTable extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';

    public function render()
    {
        $driversRevenue = Order::selectRaw('accepted_by,COUNT(accepted_by) as count,SUM(price) as revenue')
            ->orderBy('revenue', 'desc')
            ->groupBy('accepted_by')
            ->where('accepted', '0')
            ->where('accepted_by', '!=', 'null')
            ->with('driver')

            ->simplePaginate(100);
        return view('livewire.admin.revenue-table',compact('driversRevenue'));
    }
}
