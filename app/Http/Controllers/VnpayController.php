<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class VnpayController extends Controller
{
    //
    public function index() {
        return view('vnpay_php.vnpay_php.vnpay_pay');
    }
    public function return(){
        return view('vnpay_php.vnpay_php.vnpay_return');
    }
    public function gohome() {
        Cart::instance('cart')->destroy();
        return view('/');
    }
    public function vnpay_create_payment() {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        /**
         * 
         *
         * @author CTT VNPAY
         */
        $vnp_TmnCode = "3C5MVIN9"; //Mã định danh merchant kết nối (Terminal Id)
        $vnp_HashSecret = "PJZLTAFYHGEMOBTTUVTTIQKJZXJXUPKP"; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://laravel_9_pro2.test/return";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        //Config input format
        //Expire
        $startTime = date("YmdHis");
        $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));

        $vnp_TxnRef = rand(1,10000); //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $_POST['amount']; // Số tiền thanh toán
        $vnp_Locale = $_POST['language']; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = $_POST['bankCode']; //Mã phương thức thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount* 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" =>$vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$expire,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();
    }
    public function Quickview($id) {
        $product = Product::where('id',$id)->first();
        $output['product_name'] = $product->name;
        $output['product_short'] = $product->short_description;
        $output['product_description'] = $product->description;
        // $output['product_name'] = $product->name;
        // $output['product_name'] = $product->name;
        // $output['product_name'] = $product->name;

        $output['product_image'] = '<img src="assets/imgs/products/'.$product->image.'">';
        $output['product_image2'] = '<img src="assets/imgs/products/'.$product->image2.'">';
        $output['product_images'] = ' ';
        $imagess = explode(',', $product->images);
        foreach ($imagess as $image)
        {
            if ($image)
               { 
                $output['product_images'].= '<img src="assets/imgs/products/'.$image.'">';
            }
        }
        $output['product_image3'] = '<img src="assets/imgs/products/'.$product->image.'">';
        $output['product_image4'] = '<img src="assets/imgs/products/'.$product->image2.'">';
        $output['product_images2'] = ' ';
        $imagess1 = explode(',', $product->images);
        foreach ($imagess1 as $image)
        {
            if ($image)
               { 
                $output['product_images2'].= '<img src="assets/imgs/products/'.$image.'">';
            }
        }  
        foreach ($product->attributeValues->unique('product_attribute_id') as $av)
        {
            $output['product_attr_name'] = $av->productAttribute->name;
            foreach ($av->productAttribute->attributeValues->where('product_id',$product->id) as $pav)
            {
                $output['product_attr_value'] = $pav->value;
            }
        }       
        echo json_encode($output);
    }
}

