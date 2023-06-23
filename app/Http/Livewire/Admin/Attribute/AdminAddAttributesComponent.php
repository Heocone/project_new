<?php

namespace App\Http\Livewire\Admin\Attribute;

use Livewire\Component;
use App\Models\ProductAttribute;

class AdminAddAttributesComponent extends Component
{
    public $name;

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            "name" => "required",
        ]);
    }

    public function storeAttributes()
    {
        $this->validate([
           "name" => "required",
        ]);

        $pattribute = new ProductAttribute();
        $pattribute->name = $this->name;
        $pattribute->save();
        session()->flash('message','Thêm thuộc tính mới thành công!');
    }


    public function render()
    {
        return view('livewire.admin.attribute.admin-add-attributes-component');
    }
}
