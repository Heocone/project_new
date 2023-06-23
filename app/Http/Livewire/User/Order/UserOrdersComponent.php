<?php

namespace App\Http\Livewire\User\Order;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserOrdersComponent extends Component
{
    
    public function render()
    {
        $orders = Order::where('user_id', Auth::user()->id)->paginate(10);
        return view('livewire.user.order.user-orders-component',[
            'orders' => $orders,
        ]);
    }
}
