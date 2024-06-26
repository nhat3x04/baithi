<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem lại đơn đặt hàng</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
</head>
<body>
    <div class="container">
        <h1>Đơn đặt hàng của bạn</h1>
        <!-- Giả sử bạn có một biến $bills chứa danh sách đơn đặt hàng -->
        @if($bills->isEmpty())
            <p>Bạn chưa có đơn đặt hàng nào.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bills as $bill)
                        <tr>
                            <td>{{ $bill->id }}</td>
                            <td>{{ $bill->date_order }}</td>
                            <td>{{ number_format($bill->total) }} VND</td>
                            <td>{{ $bill->status }}</td>
                            <td><a href="{{ route('bill.details', $bill->id) }}">Xem chi tiết</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
