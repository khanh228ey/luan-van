@extends('layout')
@section('content')
<section class="cart text-center">
    <div class="container">
        <form id="cartForm" action="{{ route('checkout.page') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-6 mb-3 text-md-left">
                    <a href="{{ route('product.list') }}"><i class="fas fa-arrow-left mr-2"></i>Tiếp tục mua sắm</a>
                </div>
                <div class="col-sm-6 text-md-right">
                    <button type="submit" class="btn btn-primary btn-lg pl-5 pr-5">Thanh toán</button>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="mt-5 mb-2">Giỏ hàng của bạn</h2>
                    <p class="mb-5"><span class="primary-color">{{ $cartUser->count() }}</span> sản phẩm trong giỏ hàng</p>
                    <table id="cart" class="table table-condensed">
                        <thead>
                            <tr>
                                <th style="width:4%"><input type="checkbox" id="checkAll"></th>
                                <th style="width:56%">Sản phẩm</th>
                                <th style="width:12%">Giá</th>
                                <th style="width:10%">Số lượng</th>
                                <th style="width:16%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartUser as $item)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="cart-checkbox" name="cart_item_ids[]" value="{{ $item->id }}">
                                        <input type="hidden" name="product_ids[{{ $item->id }}]" value="{{ $item->product->id }}">
                                        <input type="hidden" name="product_detail_ids[{{ $item->id }}]" value="{{ $item->productDetail->id }}">
                                        <input type="hidden" class="cart-qty-hidden" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}">
                                    </td>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-md-3 text-left">
                                                <img src="{{ asset('storage/' . $item->product->product_images->image1) }}" alt="" class="img-fluid">
                                            </div>
                                            <div class="col-md-9 text-left mt-sm-2">
                                                <h4>{{ $item->product->name }} - {{ $item->productDetail->size }}</h4>
                                                <p>{{ $item->product->brand->name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price">{{ number_format($item->product->price, 0, ',', '.') }}₫</td>
                                    <td data-th="Quantity">
                                        <input type="number" class="form-control text-center cart-qty-input" value="{{ $item->quantity }}" min="1" data-id="{{ $item->id }}">
                                    </td>
                                    <td class="actions" data-th="">
                                        <div class="text-right">
                                            <!-- Sử dụng method POST để xóa, không dùng DELETE -->
                                            <form action="{{ route('cart.delete') }}" method="POST" class="delete-form-ajax" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                                <button type="button" class="btn btn-white btn-md mb-2 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="clearfix"></div>
                    <div class="float-right text-right mt-4">
                        <h4>Tổng tiền:</h4>
                        <h1>{{ number_format($cartUser->sum(fn($item) => $item->product->price * $item->quantity), 0, ',', '.') }}₫</h1>
                        <p>(Chưa bao gồm phí vận chuyển)</p>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-sm-6 mb-3 text-md-left">
                    <a href="{{ route('product.list') }}"><i class="fas fa-arrow-left mr-2"></i>Tiếp tục mua sắm</a>
                </div>
                <div class="col-sm-6 text-md-right">
                    <button type="submit" class="btn btn-primary btn-lg pl-5 pr-5">Thanh toán</button>
                </div>
            </div>
        </form>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('checkAll');
    const checkboxes = document.querySelectorAll('.cart-checkbox');

    checkAll.addEventListener('change', function() {
        checkboxes.forEach(cb => cb.checked = checkAll.checked);
    });

    document.querySelectorAll('.cart-qty-input').forEach(function(input) {
        input.addEventListener('input', function() {
            const id = this.getAttribute('data-id');
            const hidden = document.querySelector('input.cart-qty-hidden[name="quantities['+id+']"]');
            if (hidden) hidden.value = this.value;
        });
    });

    document.getElementById('cartForm').addEventListener('submit', function(e) {
        let checked = false;
        checkboxes.forEach(cb => {
            const id = cb.value;
            const qtyHidden = document.querySelector('input.cart-qty-hidden[name="quantities['+id+']"]');
            if (!cb.checked && qtyHidden) {
                qtyHidden.disabled = true;
            } else if (cb.checked && qtyHidden) {
                qtyHidden.disabled = false;
                checked = true;
            }
        });
        if (!checked) {
            e.preventDefault();
            alert('Vui lòng chọn ít nhất 1 sản phẩm để thanh toán!');
        }
    });

    document.querySelectorAll('.cart-qty-input').forEach(function(input) {
        input.addEventListener('change', function() {
            const cartItemId = this.getAttribute('data-id');
            const quantity = this.value;
            if (quantity < 1) {
                alert('Số lượng tối thiểu là 1');
                this.value = 1;
                return;
            }
            fetch("{{ url('cart/update') }}/" + cartItemId, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ quantity })
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) alert(data.message || 'Lỗi khi cập nhật');
            })
            .catch(() => alert('Có lỗi xảy ra khi cập nhật số lượng!'));
        });
    });

    // Tách xử lý xoá AJAX ra khỏi form thanh toán
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (confirm('Bạn có chắc muốn xoá sản phẩm này khỏi giỏ hàng?')) {
                const cartItemId = this.closest('form').querySelector('input[name="cart_item_id"]').value;
                fetch('/api/gio-hang/xoa', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ cart_item_id: cartItemId })
                })
                .then(res => {
                    if (res.ok) {
                        location.reload();
                    } else {
                        res.text().then(txt => alert('Xóa thất bại!\n' + txt));
                    }
                })
                .catch(() => alert('Có lỗi xảy ra khi xóa!'));
            }
        });
    });
});
</script>
@endsection

