<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class AdminOrderComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $order_id;
    public function updateOrderStatus($order_id, $status)
    {
        $order = Order::find($order_id);
        $order->status = $status;
        if($status == "delivered")
        {
            $order->delivered_date = DB::raw('CURRENT_DATE');

        }
        else if($status == "canceled")
        {
            $order->canceled_date = DB::raw('CURRENT_DATE');
        }
        $order->save();
        session()->flash('order_message', 'Cap nhat trang thai thanh cong');
    }
    public function deleteOrder()
    {
        $order = Order::find($this->order_id);
        $order->delete();
        session()->flash('message','Xóa đơn hàng thành công');
    }
    public function render()
    {
        $orders = Order::orderBy('created_at','DESC')->paginate(10);
        return view('livewire.admin.admin-order-component',[
            'orders'=>$orders,
        ]);
    }
}
