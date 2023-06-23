<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\Product;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutComponent extends Component
{
    public $firtsname;
    public $lastname;
    public $email;
    public $mobile;
    public $line1;
    public $line2;
    public $city;
    public $province;
    public $country = 'VN';
    public $zipcode;
    public $information;
    public $ship_to_different;
    public $payment_mod;

    public $s_firtsname;
    public $s_lastname;
    // public $s_email;
    public $s_mobile;
    public $s_line1;
    public $s_line2;
    public $s_city;
    public $s_province;
    public $s_country = 'VN';
    public $s_zipcode;
    public $thankyou;

    public function updated($field)
    {
        $this->validateOnly($field,[
            'firtsname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'line1' => 'required',
            // 'line2' => 'required',
            'city' => 'required',
            'province' => 'required',
            // 'country' => 'required',
            // 'zipcode' => 'required',
            'payment_mod' => 'required',      
        ]);

        if($this->ship_to_different)
        {
            $this->validateOnly($field,[
                's_firtsname' => 'required',
                's_lastname' => 'required',
                // 's_email' => 'required|email',
                's_mobile' => 'required|numeric',
                's_line1' => 'required',
                // 'line2' => 'required',
                's_city' => 'required',
                's_province' => 'required',
                // 'country' => 'required',
                // 'zipcode' => 'required',
            ]);
        }
    }

    public function placeOrder()
    {
        $this->validate([
            'firtsname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'line1' => 'required',
            // 'line2' => 'required',
            'city' => 'required',
            'province' => 'required',
            // 'country' => 'required',
            // 'zipcode' => 'required',
            'payment_mod' => 'required',    
        ]);
        if ($this->payment_mod == 'vnpay')
        {
            session()->put('checkoutvnpay',[
                'firtsname'=>$this->firtsname,
                'lastname'=>$this->lastname,
                'email'=>$this->email,
                'mobile'=>$this->mobile,
                'line1'=>$this->line1,
                'line2'=>$this->line2,
                'city'=>$this->city,
                'province'=>$this->province,
                'country'=>$this->country,
                'zipcode'=>$this->zipcode,
                'comment'=>$this->information,
                'user_id'=>Auth::user()->id,
            ]);
            return redirect()->route('VnpayC');
        }

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->subtotal = session()->get('checkout')['subtotal'];
        $order->discount = session()->get('checkout')['discount'];
        $order->tax = session()->get('checkout')['tax'];
        $order->total = session()->get('checkout')['total'];
        $order->firtsname = $this->firtsname;
        $order->lastname = $this->lastname;
        $order->email = $this->email;
        $order->mobile = $this->mobile;
        $order->line1 = $this->line1;
        $order->line2 = $this->line2;
        $order->city = $this->city;
        $order->province = $this->province;
        $order->country = $this->country;
        $order->zipcode = $this->zipcode;
        $order->status = 'ordered';
        $order->is_shipping_different = $this->ship_to_different ? 1:0;
        $order->information = $this->information;
        $order->save();

        foreach(Cart::instance('cart')->content() as $item) 
        {
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            if($item->options)
            {
                $orderItem->options = serialize($item->options);
            }
            $orderItem->save();
            $prod = Product::where('id',$orderItem->product_id)->first();
            $prod->countsale = $orderItem->quantity + $prod->countsale;
            $prod->quantity = $prod->quantity - $orderItem->quantity;
            $prod->update();

        }

        if($this->ship_to_different)
        {
            $this->validate([
                's_firtsname' => 'required',
                's_lastname' => 'required',
                // 's_email' => 'required|email',
                's_mobile' => 'required|numeric',
                's_line1' => 'required',
                // 'line2' => 'required',
                's_city' => 'required',
                's_province' => 'required',
                // 'country' => 'required',
                // 'zipcode' => 'required',    
            ]);

            $shipping = new Shipping();
            $shipping->order_id = $order->id;
            $shipping->firtsname = $this->s_firtsname;
            $shipping->lastname = $this->s_lastname;
            // $shipping->email = $this->s_email;
            $shipping->mobile = $this->s_mobile;
            $shipping->line1 = $this->s_line1;
            $shipping->line2 = $this->s_line2;
            $shipping->city = $this->s_city;
            $shipping->province = $this->s_province;
            $shipping->country = $this->s_country;
            $shipping->zipcode = $this->s_zipcode;
            $shipping->save();
        }
        
        if ($this->payment_mod == 'cod') {
            $this->makeTransaction($order->id,'pending');
            $this->resetCart();
        }
        $this->sendOrderConfirmationMail($order);
    }

    public function resetCart() 
    {
        $this->thankyou = 1;
        Cart::instance('cart')->destroy();
        session()->forget('checkout');
    }

    public function makeTransaction($order_id, $status)
    {
        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = $order_id;
        $transaction->mode = $this->payment_mod;
        $transaction->status = $status;
        $transaction->save();
    }
    public function sendOrderConfirmationMail($order)
    {
        Mail::to($order->email)->send(new OrderMail($order));
    }
    public function verifyForCheckout()
    {
        if (!Auth::check()) {
            session()->flash('checkk','Vui lòng đăng nhập để đặt hàng!');
            return redirect()->route('login');
        } else if($this->thankyou)
        {
            return redirect()->route('thankiu');
        }
        else if(!session()->get('checkout'))
        {
            session()->flash('checkkout','Vui lòng kiếm tra lại giỏ hàng trước khi thanh toán!');
            return redirect()->route('cart.index');
        }
        
    }

    public function render()
    {
        $this->verifyForCheckout();
        return view('livewire.checkout-component');
    }
}
