<?php

namespace App\Http\Livewire\Admin\Attribute;

use App\Models\ProductAttribute;
use Livewire\Component;

class AdminAttributesComponent extends Component
{
    public $pattribute_id;

    public function deleteCategory()
    {
        $pattribute = ProductAttribute::find($this->pattribute_id);
        $pattribute->delete();
        session()->flash('message','Xóa thành công');
    }

    public function render()
    {
        $pattributes = ProductAttribute::paginate(10);
        return view('livewire.admin.attribute.admin-attributes-component',[
            'pattributes' => $pattributes,
        ]);
    }
}
