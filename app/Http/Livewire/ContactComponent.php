<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ContactComponent extends Component
{
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $comment;

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'comment' => 'required',
            
        ]);
    }

    public function sendMessage()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'comment' => 'required'
        ]);
        $contact = new Contact();
        $contact->name = $this->name;
        $contact->email = $this->email;
        $contact->phone = $this->phone;
        $contact->subject = $this->subject;
        $contact->comment = $this->comment;
        $contact->save();
        session()->flash('message','Lời nhắn đã được lưu lại cảm ơn quý khách!');
        return redirect()->route('contactus');
    }

    public function verifyForCheckout()
    {
        if (!Auth::check()) {
            session()->flash('checkk','Vui lòng đăng nhập để tiếp tục!');
            return redirect()->route('login');
        }
    }

    public function render()
    {
        $this->verifyForCheckout();
        return view('livewire.contact-component');
    }
}
