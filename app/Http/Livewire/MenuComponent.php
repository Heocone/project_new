<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class MenuComponent extends Component
{
    public function render()
    {
        $category = Category::all();
        return view('livewire.menu-component',[
            'category' => $category
        ]);
    }
}
