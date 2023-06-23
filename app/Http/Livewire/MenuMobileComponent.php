<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class MenuMobileComponent extends Component
{
    public function render()
    {
        $category = Category::all();
        return view('livewire.menu-mobile-component',[
            'category' => $category
        ]);
    }
}
