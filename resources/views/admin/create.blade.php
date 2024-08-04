@extends('admin.master')

@section('title')
    Thêm Mới Đơn Hàng
@endsection

@section('content')
    <div class="container">
       
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        <form action="{{ route('orders.store') }}" method="post" enctype="multipart/form-data" class="border p-4 rounded shadow">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <h3 class="mt-3">Thông Tin Khách Hàng</h3>
                    <div class="form-group">
                        <label for="customer_name">Tên</label>
                        <input type="text" name="customer[name]" value="{{ old('customer.name') }}" id="customer_name" class="form-control">
                        @error('customer.name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="customer_address">Địa Chỉ</label>
                        <input type="text" name="customer[address]" value="{{ old('customer.address') }}" id="customer_address" class="form-control">
                        @error('customer.address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="customer_phone">Điện Thoại</label>
                        <input type="tel" name="customer[phone]" value="{{ old('customer.phone') }}" id="customer_phone" class="form-control">
                        @error('customer.phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="customer_email">Email</label>
                        <input type="email" name="customer[email]" value="{{ old('customer.email') }}" id="customer_email" class="form-control">
                        @error('customer.email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <h3 class="mt-3">Thông Tin Nhà Cung Cấp</h3>
                    <div class="form-group">
                        <label for="supplier_name">Tên</label>
                        <input type="text" name="supplier[name]" value="{{ old('supplier.name') }}" id="supplier_name" class="form-control">
                        @error('supplier.name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="supplier_address">Địa Chỉ</label>
                        <input type="text" name="supplier[address]" value="{{ old('supplier.address') }}" id="supplier_address" class="form-control">
                        @error('supplier.address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="supplier_phone">Điện Thoại</label>
                        <input type="tel" name="supplier[phone]" value="{{ old('supplier.phone') }}" id="supplier_phone" class="form-control">
                        @error('supplier.phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="supplier_email">Email</label>
                        <input type="email" name="supplier[email]" value="{{ old('supplier.email') }}" id="supplier_email" class="form-control">
                        @error('supplier.email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <h3 class="mt-3">Danh Sách Sản Phẩm</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th>Hình Ảnh</th>
                                    <th>Mô Tả</th>
                                    <th>Giá</th>
                                    <th>Số Lượng Tồn Kho</th>
                                    <th>Số Lượng Bán</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 2; $i++)
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="products[{{ $i }}][name]" value="{{ old("products.$i.name") }}">
                                            @error("products.$i.name")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="file" class="form-control" name="products[{{ $i }}][image]">
                                            @error("products.$i.image")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="products[{{ $i }}][description]" value="{{ old("products.$i.description") }}">
                                            @error("products.$i.description")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="products[{{ $i }}][price]" value="{{ old("products.$i.price") }}">
                                            @error("products.$i.price")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="products[{{ $i }}][stock_qty]" value="{{ old("products.$i.stock_qty") }}">
                                            @error("products.$i.stock_qty")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="order_details[{{ $i }}][qty]" value="{{ old("order_details.$i.qty") }}">
                                            @error("order_details.$i.qty")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-success mt-3">Lưu Đơn Hàng</button>
                </div>
            </div>
        </form>
    </div>
@endsection
