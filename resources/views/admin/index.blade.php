@extends('admin.master')

@section('title')
    Danh Sách Đơn Hàng
@endsection

@section('content')
    <div class="container">
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Tạo Đơn Hàng Mới</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Thông Tin Khách Hàng</th>
                        <th>Tổng Tiền</th>
                        <th>Chi Tiết Sản Phẩm</th>
                        <th>Ngày Tạo</th>
                        <th>Ngày Cập Nhật</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    <li><strong>Tên:</strong> {{ $order->customer->name }}</li>
                                    <li><strong>Email:</strong> {{ $order->customer->email }}</li>
                                    <li><strong>Địa Chỉ:</strong> {{ $order->customer->address }}</li>
                                    <li><strong>Điện Thoại:</strong> {{ $order->customer->phone }}</li>
                                </ul>
                            </td>
                            <td>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                            <td>
                                @foreach ($order->products as $product)
                                    <div class="mb-2">
                                        <strong>Sản Phẩm:</strong> {{ $product->name }}
                                        <ul class="list-unstyled">
                                            <li><strong>Giá:</strong> {{ number_format($product->pivot->price, 0, ',', '.') }} VNĐ</li>
                                            <li><strong>Số Lượng:</strong> {{ $product->pivot->quantity }}</li>
                                            @if ($product->image && \Storage::exists($product->image))
                                                <li>
                                                    <img width="100px" src="{{ \Storage::url($product->image) }}" alt="{{ $product->name }}">
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                @endforeach
                            </td>
                            <td>{{ $order->created_at}}</td>
                            <td>{{ $order->updated_at }}</td>
                            <td>
                                <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning btn-sm">Chỉnh Sửa</a>

                                <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $orders->links() }}
    </div>
@endsection
