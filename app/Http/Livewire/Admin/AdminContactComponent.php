<?php

namespace App\Http\Livewire\Admin;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class AdminContactComponent extends Component
{
    use WithPagination;
    public $contact_id;
    protected $paginationTheme = 'bootstrap';

    public function deleteContact()
    {
        $contact = Contact::find($this->contact_id);
        $contact->delete();
        session()->flash('message','Xóa thành công');
    }
    public function render()
    {
        $contacts = Contact::paginate(10);
        return view('livewire.admin.admin-contact-component',[
            'contacts' => $contacts,
        ]);
    }
}
