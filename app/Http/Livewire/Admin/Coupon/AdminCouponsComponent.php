<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCouponsComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $coupon_id;
    public function deleteCategory()
    {
        $coupon = Coupon::find($this->coupon_id);
        $coupon->delete();
        session()->flash('message','Xóa mã giảm giá thành công');
    }
    public function render()
    {
        $coupons = Coupon::paginate(8);
        return view('livewire.admin.coupon.admin-coupons-component',[
            'coupons' => $coupons,
        ]);
    }
}
