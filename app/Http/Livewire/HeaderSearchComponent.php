<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HeaderSearchComponent extends Component
{
    public $search_form;
    public function mount()
    {
        $this->fill(request()->only('search_form'));
    }
    public function render()
    {
        return view('livewire.header-search-component');
    }
}
