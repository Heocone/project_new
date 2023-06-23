<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xác nhận đơn hàng</title>
</head>
<body>
    <p>Chào {{ $order->firtsname }} {{ $order->lastname }}!</p>
    <p>Cảm ơn bạn đã đặt hàng tại shop của chúng tôi!</p></p>
    <p>Shop đã nhận được đơn hàng của bạn.</p>
    <br>
    <table style="width:600px; text-align:right">
        <h3>Đơn hàng:</h3>
        <thead>
            <tr>
                <th>Ảnh </th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td><img src="{{ asset('assets/imgs/products') }}/{{ $item->product->image }}" width="100" alt=""></td> 
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ $item->price * $item->quantity }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" style="border-top: 1px solid #ccc"></td>
                <td style="font-size:15px;font-weight:bold;border-top: 1px solid #ccc">Tổng phụ: ${{ $order->subtotal }}</td>
            </tr>

            <tr>
                <td colspan="3"></td>
                <td style="font-size:15px;font-weight:bold">Thuế: ${{ $order->tax }}</td>
            </tr>

            <tr>
                <td colspan="3"></td>
                <td style="font-size:15px;font-weight:bold">Phí giao hàng: Free ship</td>
            </tr>

            <tr>
                <td colspan="3"></td>
                <td style="font-size:15px;font-weight:bold">Tổng tiền: ${{ $order->total }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>