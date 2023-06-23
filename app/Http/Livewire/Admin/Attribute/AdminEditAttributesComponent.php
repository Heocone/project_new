<?php

namespace App\Http\Livewire\Admin\Attribute;

use Livewire\Component;
use App\Models\ProductAttribute;

class AdminEditAttributesComponent extends Component
{
    public $name;
    public $attribute_id;

    public function mount($attribute_id) 
    {
        $pattribute = ProductAttribute::find($attribute_id);
        $this->attribute_id = $pattribute->id;
        $this->name = $pattribute->name;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required',
        ]);
    }

    public function updateAttribute()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $pattribute = ProductAttribute::find($this->attribute_id);
        $pattribute->name = $this->name;
        $pattribute->save();
        session()->flash('message','Cập nhật thuộc tính thành công!');
    }
    
    public function render()
    {
        return view('livewire.admin.attribute.admin-edit-attributes-component');
    }
}
