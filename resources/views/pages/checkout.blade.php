@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Left: Customer Info & Payment -->
            <div class="col-md-7">
                <h3 class="mb-4">Thông tin khách hàng</h3>
                <form>
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input type="text" class="form-control" id="name" name="name" required
                            value="{{ auth()->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone" required
                            value="{{ auth()->user()->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="address_detail">Địa chỉ nhận hàng</label>
                        <input type="text" class="form-control mb-3" id="address_detail" name="address_detail"
                            placeholder="Địa chỉ" required>
                        <div class="row">
                            <div class="col-md-4 mb-2 mb-md-0">
                                <select class="form-control" name="province" id="province" required>
                                    <option value="">Tỉnh / thành</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2 mb-md-0">
                                <select class="form-control" name="district" id="district" required>
                                    <option value="">Quận / huyện</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="ward" id="ward" required>
                                    <option value="">Phường / xã</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note">Ghi chú (tuỳ chọn)</label>
                        <textarea class="form-control" id="note" name="note" rows="2">Giao giờ hành chính</textarea>
                    </div>
                    <!-- Shipping Method -->
                    <h5 class="mt-4"
                        style="letter-spacing:1px;font-size:1.05em;font-weight:500;text-transform:uppercase;">Phương thức
                        vận chuyển</h5>
                    <div style="border:1px solid #ddd;border-radius:7px;margin-bottom:1.5rem;">
                        <div style="display:flex;align-items:center;padding:10px 16px;">
                            <input class="form-check-input" type="radio" name="shipping_method" id="shipping_hcm"
                                value="hcm" checked style="width:22px;height:22px;margin-right:14px;">
                            <label class="form-check-label flex-grow-1" for="shipping_hcm"
                                style="font-size:1.08em;flex:1 1 auto;cursor:pointer;">
                                Giao hàng tiêu chuẩn
                            </label>
                            <span id="shipping_fee" style="font-size:1.08em;white-space:nowrap;">25,000₫</span>
                        </div>
                    </div>
                    <!-- End Shipping Method -->
                    <h5 class="mt-4">Phương thức thanh toán</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod"
                            checked>
                        <label class="form-check-label" for="cod">
                            Thanh toán khi nhận hàng (COD)
                        </label>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="payment_method" id="bank" value="bank">
                        <label class="form-check-label" for="bank">
                            Chuyển khoản ngân hàng
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Đặt hàng</button>
                </form>
            </div>
            <!-- Right: Cart Summary -->
            <div class="col-md-5">
                <h4 class="mb-4">Đơn hàng của bạn</h4>
                <ul class="list-group mb-3">
                    @foreach ($cartItems as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $item->product->product_images->image1) }}"
                                    alt="{{ $item->product->name }}" class="rounded mr-3"
                                    style="width:50px;height:50px;object-fit:cover;">
                                <div class="ms-3">
                                    <strong>{{ $item->product->name }}</strong>
                                    @if($item->productDetail && $item->productDetail->size)
                                        <div class="text-muted small">Size: {{ $item->productDetail->size }}</div>
                                    @endif
                                    <div class="text-muted small">x{{ $item->quantity }}</div>
                                </div>
                            </div>
                            <span>{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}₫</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span><strong>Tổng cộng</strong></span>
                        <strong class="text-primary">{{ number_format($total, 0, ',', '.') }}₫</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @push('sripts')
        <script>
            // Lấy địa chỉ và giá vận chuyển theo tỉnh
            let addressData = {};
            fetch('{{ asset('address/tree.json') }}')
                .then(res => res.json())
                .then(data => {
                    addressData = data;
                    const provinceSelect = document.getElementById('province');
                    for (const code in addressData) {
                        const province = addressData[code];
                        const opt = document.createElement('option');
                        opt.value = code;
                        opt.textContent = province.name_with_type;
                        provinceSelect.appendChild(opt);
                    }
                });

            document.getElementById('province').addEventListener('change', function() {
                const provinceCode = this.value;
                const districtSelect = document.getElementById('district');
                const wardSelect = document.getElementById('ward');
                districtSelect.innerHTML = '<option value="">Quận / huyện</option>';
                wardSelect.innerHTML = '<option value="">Phường / xã</option>';
                if (provinceCode && addressData[provinceCode]) {
                    const districts = addressData[provinceCode]['quan-huyen'];
                    for (const dCode in districts) {
                        const d = districts[dCode];
                        const opt = document.createElement('option');
                        opt.value = dCode;
                        opt.textContent = d.name_with_type;
                        districtSelect.appendChild(opt);
                    }
                }

                // Lấy giá vận chuyển theo tỉnh
                const cityCodes = ['01', '79', '48', '31', '92']; // Hà Nội, HCM, Đà Nẵng, Hải Phòng, Cần Thơ
                const feeSpan = document.getElementById('shipping_fee');
                if (cityCodes.includes(provinceCode)) {
                    feeSpan.textContent = '25,000₫';
                } else if (provinceCode) {
                    feeSpan.textContent = '40,000₫';
                } else {
                    feeSpan.textContent = '25,000₫';
                }
            });

            document.getElementById('district').addEventListener('change', function() {
                const provinceCode = document.getElementById('province').value;
                const districtCode = this.value;
                const wardSelect = document.getElementById('ward');
                wardSelect.innerHTML = '<option value="">Phường / xã</option>';
                if (
                    provinceCode &&
                    districtCode &&
                    addressData[provinceCode] &&
                    addressData[provinceCode]['quan-huyen'][districtCode]
                ) {
                    const wards = addressData[provinceCode]['quan-huyen'][districtCode]['xa-phuong'];
                    for (const wCode in wards) {
                        const w = wards[wCode];
                        const opt = document.createElement('option');
                        opt.value = wCode;
                        opt.textContent = w.name_with_type;
                        wardSelect.appendChild(opt);
                    }
                }
            });

            {{-- Đặt script ở cuối file, sau các select --}}
            if (cityCodes.includes(provinceCode)) {
                feeSpan.textContent = '25,000₫';
            } else if (provinceCode) {
                feeSpan.textContent = '40,000₫';
            } else {
                feeSpan.textContent = '25,000₫';
            }
            });

            document.getElementById('district').addEventListener('change', function() {
                const provinceCode = document.getElementById('province').value;
                const districtCode = this.value;
                const wardSelect = document.getElementById('ward');
                wardSelect.innerHTML = '<option value="">Phường / xã</option>';
                if (
                    provinceCode &&
                    districtCode &&
                    addressData[provinceCode] &&
                    addressData[provinceCode]['quan-huyen'][districtCode]
                ) {
                    const wards = addressData[provinceCode]['quan-huyen'][districtCode]['xa-phuong'];
                    for (const wCode in wards) {
                        const w = wards[wCode];
                        const opt = document.createElement('option');
                        opt.value = wCode;
                        opt.textContent = w.name_with_type;
                        wardSelect.appendChild(opt);
                    }
                }
            });
        </script>
    @endpush
@endsection
