<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>VNPAY RESPONSE</title>
        <!-- Bootstrap core CSS -->
        <link href="assets/bootstrap.min.css" rel="stylesheet"/>
        <!-- Custom styles for this template -->
        <link href="assets/jumbotron-narrow.css" rel="stylesheet">         
        <script src="assets/jquery-1.11.3.min.js"></script>
    </head>
    <body>
        <?php

use Gloudemans\Shoppingcart\Facades\Cart;

        date_default_timezone_set('Asia/Ho_Chi_Minh');
  
        $vnp_TmnCode = "3C5MVIN9"; //Mã định danh merchant kết nối (Terminal Id)
        $vnp_HashSecret = "PJZLTAFYHGEMOBTTUVTTIQKJZXJXUPKP"; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://vnpay_php.test/vnpay_php/vnpay_return.php";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        //Config input format
        //Expire
        $startTime = date("YmdHis");
        $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));

        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        ?>
        <!--Begin display -->
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">VNPAY RESPONSE</h3>
            </div>
            <div class="table-responsive">
                <div class="form-group">
                    <label >Mã đơn hàng:</label>

                    <label><?php echo $_GET['vnp_TxnRef']?></label>
                </div>    
                <div class="form-group">

                    <label >Số tiền:</label>
                    <label><?php echo $_GET['vnp_Amount'] ?></label>
                </div>  
                <div class="form-group">
                    <label >Nội dung thanh toán:</label>
                    <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã phản hồi (vnp_ResponseCode):</label>
                    <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã GD Tại VNPAY:</label>
                    <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã Ngân hàng:</label>
                    <label><?php echo $_GET['vnp_BankCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Thời gian thanh toán:</label>
                    <label><?php echo $_GET['vnp_PayDate'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Kết quả:</label>
                    <label>
                        <?php
                        if ($secureHash == $vnp_SecureHash) {
                            if ($_GET['vnp_ResponseCode'] == '00') {
                                echo "<span style='color:blue'>GD Thanh cong</span>";
                                $order = new App\Models\Order();
                                $order->user_id = Illuminate\Support\Facades\Session::get('checkoutvnpay')['user_id'];
                                $order->subtotal = Illuminate\Support\Facades\Session::get('checkout')['subtotal'];
                                $order->discount = Illuminate\Support\Facades\Session::get('checkout')['discount'];
                                $order->tax = Illuminate\Support\Facades\Session::get('checkout')['tax'];
                                $order->total = Illuminate\Support\Facades\Session::get('checkout')['total'];
                                $order->firtsname = Illuminate\Support\Facades\Session::get('checkoutvnpay')['firtsname'];
                                $order->lastname = Illuminate\Support\Facades\Session::get('checkoutvnpay')['lastname'];
                                $order->email = Illuminate\Support\Facades\Session::get('checkoutvnpay')['email'];
                                $order->mobile = Illuminate\Support\Facades\Session::get('checkoutvnpay')['mobile'];
                                $order->line1 = Illuminate\Support\Facades\Session::get('checkoutvnpay')['line1'];
                                $order->line2 = Illuminate\Support\Facades\Session::get('checkoutvnpay')['line2'];
                                $order->city = Illuminate\Support\Facades\Session::get('checkoutvnpay')['city'];
                                $order->province = Illuminate\Support\Facades\Session::get('checkoutvnpay')['province'];
                                $order->country = Illuminate\Support\Facades\Session::get('checkoutvnpay')['country'];
                                $order->zipcode = Illuminate\Support\Facades\Session::get('checkoutvnpay')['zipcode'];
                                $order->information = Illuminate\Support\Facades\Session::get('checkoutvnpay')['comment'];
                                $order->save();
                                foreach(Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->content() as $item) 
                                {
                                    $orderItem = new App\Models\OrderItem();
                                    $orderItem->product_id = $item->id;
                                    $orderItem->order_id = $order->id;
                                    $orderItem->price = $item->price;
                                    $orderItem->quantity = $item->qty;
                                    if($item->options)
                                    {
                                        $orderItem->options = serialize($item->options);
                                    }
                                    $orderItem->save();
                                }
                                $transaction = new App\Models\Transaction();
                                $transaction->user_id = Illuminate\Support\Facades\Auth::user()->id;
                                $transaction->order_id = $order->id;
                                $transaction->mode = 'vnpay';
                                $transaction->status = 'thanhcong';
                                $transaction->save();
                                Cart::instance('cart')->destroy();
                            } else {
                                echo "<span style='color:red'>GD Khong thanh cong</span>";  
                            }
                        } else {
                            echo "<span style='color:red'>Chu ky khong hop le</span>";
                        }
                        ?>

                    </label>
                </div> 
            </div>
            <p>
                &nbsp;
            </p>
            <a type="button" href="#">Quay tro lai trang web sau 3 giay</a>
            <footer class="footer">
                   <p>&copy; VNPAY <?php echo date('Y')?></p>
            </footer>
        </div>  
    </body>
</html>
<script>
    const myTimeout = setTimeout(myGreeting, 3000);
    function myGreeting() {
        window.location.href = "/Vnpay"
    }
</script>
