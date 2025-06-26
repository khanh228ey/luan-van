@extends('layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card shadow rounded-4 border-0">
                <div class="card-body p-4">
                    <!-- Thông tin cá nhân -->
                    <div class="mb-4">
                        <div class="row align-items-center">
                            <div class="col-auto text-center">
                                <img src="{{ $user->avatar ?? 'https://via.placeholder.com/100' }}" alt="Avatar" class="rounded-circle border shadow-sm" style="width:100px;height:100px;object-fit:cover;">
                            </div>
                            <div class="col ps-0">
                                <h3 class="mb-1 fw-bold">{{ $user->name }}</h3>
                                <div class="text-muted" style="font-size:1.1em;">{{ $user->email }}</div>
                                <div class="text-muted" style="font-size:1.1em;">SĐT: {{ $user->phone }}</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- Danh sách địa chỉ -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="fw-bold mb-0">Địa chỉ của bạn</h5>
                            <button class="btn btn-sm btn-success" id="addAddressBtn">+ Thêm địa chỉ</button>
                        </div>
                        <ul class="list-group mb-3" id="addressList">
                            @foreach($addresses as $address)
                                <li class="list-group-item d-flex justify-content-between align-items-center {{ $address->is_default ? 'border-primary' : '' }}">
                                    <div>
                                        <div>
                                            <strong>{{ $address->detail }}</strong>
                                            <span class="text-muted small">
                                                ({{ $address->ward }}, {{ $address->district }}, {{ $address->province }})
                                            </span>
                                            @if($address->is_default)
                                                <span class="badge bg-primary ms-2">Mặc định</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-outline-primary btn-sm select-address-btn" data-id="{{ $address->id }}">Chọn</button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Form địa chỉ đang chọn -->
                    <form id="addressForm" method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="address_id" id="address_id" value="">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Địa chỉ chi tiết</label>
                            <input type="text" class="form-control form-control-lg rounded-3 mb-2" name="detail" id="detail" placeholder="Địa chỉ" required readonly>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-md-4">
                                <select class="form-control form-control-lg rounded-3" name="province" id="province" required disabled>
                                    <option value="">Tỉnh / thành</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control form-control-lg rounded-3" name="district" id="district" required disabled>
                                    <option value="">Quận / huyện</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control form-control-lg rounded-3" name="ward" id="ward" required disabled>
                                    <option value="">Phường / xã</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_default" id="is_default" value="1" disabled>
                            <label class="form-check-label" for="is_default">
                                Đặt làm địa chỉ mặc định
                            </label>
                        </div>
                        <div class="d-flex justify-content-end align-items-center">
                            <button type="button" id="editAddressBtn" class="btn btn-outline-primary px-4 py-2 rounded-3 fw-semibold d-none">Chỉnh sửa</button>
                            <button type="submit" id="saveAddressBtn" class="btn btn-primary ms-3 px-4 py-2 rounded-3 fw-semibold d-none">Lưu</button>
                            <button type="button" id="cancelAddressBtn" class="btn btn-secondary ms-4 px-4 py-2 rounded-3 fw-semibold d-none">Huỷ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
let addressData = {};
let addresses = @json($addresses);

// Load address tree
fetch('{{ asset('address/tree.json') }}')
    .then(res => res.json())
    .then(data => {
        addressData = data;
        // Nếu có địa chỉ mặc định thì load vào form
        let defaultAddress = addresses.find(a => a.is_default);
        if (defaultAddress) {
            loadAddressToForm(defaultAddress);
        }
    });

function loadAddressToForm(address) {
    document.getElementById('address_id').value = address.id;
    document.getElementById('detail').value = address.detail;
    document.getElementById('is_default').checked = !!address.is_default;

    // Enable/disable các trường
    setAddressFormReadonly(true);

    // Load province select
    let provinceSelect = document.getElementById('province');
    provinceSelect.innerHTML = '<option value="">Tỉnh / thành</option>';
    for (const code in addressData) {
        const province = addressData[code];
        const opt = document.createElement('option');
        opt.value = province.name_with_type;
        opt.textContent = province.name_with_type;
        opt.setAttribute('data-code', code);
        if (province.name_with_type === address.province) opt.selected = true;
        provinceSelect.appendChild(opt);
    }

    // Load district select
    let districtSelect = document.getElementById('district');
    districtSelect.innerHTML = '<option value="">Quận / huyện</option>';
    let provinceCode = getProvinceCodeByName(address.province);
    if (provinceCode && addressData[provinceCode]) {
        let districts = addressData[provinceCode]['quan-huyen'];
        for (const dCode in districts) {
            const d = districts[dCode];
            const opt = document.createElement('option');
            opt.value = d.name_with_type;
            opt.textContent = d.name_with_type;
            opt.setAttribute('data-code', dCode);
            if (d.name_with_type === address.district) opt.selected = true;
            districtSelect.appendChild(opt);
        }
    }

    // Load ward select
    let wardSelect = document.getElementById('ward');
    wardSelect.innerHTML = '<option value="">Phường / xã</option>';
    let districtCode = getDistrictCodeByName(provinceCode, address.district);
    if (provinceCode && districtCode && addressData[provinceCode]['quan-huyen'][districtCode]) {
        let wards = addressData[provinceCode]['quan-huyen'][districtCode]['xa-phuong'];
        for (const wCode in wards) {
            const w = wards[wCode];
            const opt = document.createElement('option');
            opt.value = w.name_with_type;
            opt.textContent = w.name_with_type;
            if (w.name_with_type === address.ward) opt.selected = true;
            wardSelect.appendChild(opt);
        }
    }

    // Hiện nút chỉnh sửa
    document.getElementById('editAddressBtn').classList.remove('d-none');
    document.getElementById('saveAddressBtn').classList.add('d-none');
    document.getElementById('cancelAddressBtn').classList.add('d-none');
}

function setAddressFormReadonly(readonly) {
    document.getElementById('detail').readOnly = readonly;
    document.getElementById('province').disabled = readonly;
    document.getElementById('district').disabled = readonly;
    document.getElementById('ward').disabled = readonly;
    document.getElementById('is_default').disabled = readonly;
}

function getProvinceCodeByName(name) {
    for (const code in addressData) {
        if (addressData[code].name_with_type === name) return code;
    }
    return null;
}
function getDistrictCodeByName(provinceCode, name) {
    if (!provinceCode || !addressData[provinceCode]) return null;
    let districts = addressData[provinceCode]['quan-huyen'];
    for (const dCode in districts) {
        if (districts[dCode].name_with_type === name) return dCode;
    }
    return null;
}

// Sự kiện chọn địa chỉ
document.querySelectorAll('.select-address-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        let id = this.getAttribute('data-id');
        let address = addresses.find(a => a.id == id);
        if (address) loadAddressToForm(address);
    });
});

// Sự kiện chỉnh sửa
document.getElementById('editAddressBtn').addEventListener('click', function() {
    setAddressFormReadonly(false);
    this.classList.add('d-none');
    document.getElementById('saveAddressBtn').classList.remove('d-none');
    document.getElementById('cancelAddressBtn').classList.remove('d-none');
});

// Sự kiện huỷ
document.getElementById('cancelAddressBtn').addEventListener('click', function() {
    let id = document.getElementById('address_id').value;
    let address = addresses.find(a => a.id == id);
    if (address) loadAddressToForm(address);
});

// Sự kiện thay đổi tỉnh/thành
document.getElementById('province').addEventListener('change', function () {
    let provinceCode = this.options[this.selectedIndex].getAttribute('data-code');
    let districtSelect = document.getElementById('district');
    let wardSelect = document.getElementById('ward');
    districtSelect.innerHTML = '<option value="">Quận / huyện</option>';
    wardSelect.innerHTML = '<option value="">Phường / xã</option>';
    if (provinceCode && addressData[provinceCode]) {
        let districts = addressData[provinceCode]['quan-huyen'];
        for (const dCode in districts) {
            const d = districts[dCode];
            const opt = document.createElement('option');
            opt.value = d.name_with_type;
            opt.textContent = d.name_with_type;
            opt.setAttribute('data-code', dCode);
            districtSelect.appendChild(opt);
        }
    }
});

// Sự kiện thay đổi quận/huyện
document.getElementById('district').addEventListener('change', function () {
    let provinceCode = document.getElementById('province').options[document.getElementById('province').selectedIndex].getAttribute('data-code');
    let districtCode = this.options[this.selectedIndex].getAttribute('data-code');
    let wardSelect = document.getElementById('ward');
    wardSelect.innerHTML = '<option value="">Phường / xã</option>';
    if (
        provinceCode &&
        districtCode &&
        addressData[provinceCode] &&
        addressData[provinceCode]['quan-huyen'][districtCode]
    ) {
        let wards = addressData[provinceCode]['quan-huyen'][districtCode]['xa-phuong'];
        for (const wCode in wards) {
            const w = wards[wCode];
            const opt = document.createElement('option');
            opt.value = w.name_with_type;
            opt.textContent = w.name_with_type;
            wardSelect.appendChild(opt);
        }
    }
});

// Sự kiện thêm địa chỉ mới
document.getElementById('addAddressBtn').addEventListener('click', function() {
    document.getElementById('address_id').value = '';
    document.getElementById('detail').value = '';
    document.getElementById('is_default').checked = false;
    setAddressFormReadonly(false);

    // Reset select
    let provinceSelect = document.getElementById('province');
    provinceSelect.innerHTML = '<option value="">Tỉnh / thành</option>';
    for (const code in addressData) {
        const province = addressData[code];
        const opt = document.createElement('option');
        opt.value = province.name_with_type;
        opt.textContent = province.name_with_type;
        opt.setAttribute('data-code', code);
        provinceSelect.appendChild(opt);
    }
    document.getElementById('district').innerHTML = '<option value="">Quận / huyện</option>';
    document.getElementById('ward').innerHTML = '<option value="">Phường / xã</option>';

    document.getElementById('editAddressBtn').classList.add('d-none');
    document.getElementById('saveAddressBtn').classList.remove('d-none');
    document.getElementById('cancelAddressBtn').classList.remove('d-none');
});
</script>
@endsection
