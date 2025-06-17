@extends('layout')
@section('content')
    <section class="cart text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 mb-3 mb-m-1 text-md-left"><a href="{{ route('product.list') }}"><i class="fas fa-arrow-left mr-2"></i>
                       Tiếp tục mua sắm</a></div>
                <div class="col-sm-6 text-md-right"><a href=""
                        class="btn btn-primary btn-lg pl-5 pr-5">Thanh toán</a></div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="mt-5 mb-2">Giỏ hàng của bạn</h2>
                    <p class="mb-5"><span class="primary-color">{{ $cartUser->count() }}</span> sản phẩm trong giỏ hàng</p>
                    <table id="cart" class="table table-condensed">
                        <thead>
                            <tr>
                                <th style="width:60%">Sản phẩm</th>
                                <th style="width:12%">Giá</th>
                                <th style="width:10%">Số lượng</th>
                                <th style="width:16%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartUser as $item)
                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-md-3 text-left">
                                                <img src="{{ asset('storage/' . $item->product->product_images->image1) }}" alt=""
                                                    class="img-fluid">
                                            </div>
                                            <div class="col-md-9 text-left mt-sm-2">
                                                <h4>{{ $item->product->name }}</h4>
                                                <p>{{ $item->product->brand->name}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price">{{ number_format($item->product->price, 0, ',', '.') }}₫</td>
                                    <td data-th="Quantity">
                                        <input type="number" class="form-control text-center" value="{{ $item->quantity }}">
                                    </td>
                                    <td class="actions" data-th="">
                                        <div class="text-right">
                                            <form action="{{ route('cart.delete') }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                                <button type="submit" class="btn btn-white btn-md mb-2"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-right text-right">
                        <h4>Tổng tiền:</h4>
                        <h1>{{ number_format($cartUser->sum(function($item) {
                            return $item->product->price * $item->quantity;
                        }), 0, ',', '.') }}₫</h1>
                        <p>(Chưa bao gồm phí vận chuyển)</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 mb-3 mb-m-1 text-md-left"><a href="{{ route('product.list') }}"><i class="fas fa-arrow-left mr-2"></i>
                       Tiếp tục mua sắm</a></div>
                <div class="col-sm-6 text-md-right"><a href=""
                        class="btn btn-primary btn-lg pl-5 pr-5">Thanh toán</a></div>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <section class="cta text-center">
        <div class="container">
            <h3 class="mt-0 mb-4">Sign up now to save 10% on your first order</h3>
            <form class="subscribe">
                <div class="form-group row pt-3">
                    <div class="col-sm-8 mb-3">
                        <input type="text" class="form-control" id="inputName" placeholder="Your Name">
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-lg btn-outline-primary">Sign me up</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
