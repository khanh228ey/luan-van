@extends('layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-4 flex-shrink-0" style="margin-right:2rem !important;">
                            @if ($user->image)
                            <img src="{{ asset('storage/' . $user->image) }}" alt="Avatar" class="rounded-circle border border-3 border-primary" width="96" height="96" style="object-fit:cover;">
                            @else
                            <img src="{{ asset('upload/avatar.png') }}" alt="Avatar" class="rounded-circle border border-3 border-primary" width="96" height="96" style="object-fit:cover;">
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="mb-1 fw-bold text-primary">{{ $user->name }}</h3>
                            <div class="text-muted mb-1"><i class="bi bi-envelope"></i> {{ $user->email }}</div>
                            <div class="text-muted"><i class="bi bi-telephone"></i> {{ $user->phone ?? 'Chưa có' }}</div>
                        </div>
                        <div class="ms-2">
                            <button class="btn btn-primary px-3 py-2 rounded-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                <i class="bi bi-pencil"></i> Sửa
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary mb-1">Địa chỉ:</label>
                        @if ($user->address && $user->address->detail && $user->address->ward && $user->address->district && $user->address->province)
                            <div class="fs-6">
                                <i class="bi bi-geo-alt text-danger"></i>
                                {{ $user->address->detail }},
                                {{ $user->address->ward }},
                                {{ $user->address->district }},
                                {{ $user->address->province }}
                            </div>
                        @else
                            <div class="text-danger fst-italic">Chưa có địa chỉ</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal chỉnh sửa hồ sơ --}}
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">
      <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        <div class="modal-header bg-primary text-white rounded-top-4">
          <h5 class="modal-title" id="editProfileModalLabel"><i class="bi bi-person-lines-fill"></i> Chỉnh sửa hồ sơ</h5>
          <button type="button" class="btn btn-close btn-close-white d-flex align-items-center justify-content-center" data-bs-dismiss="modal" aria-label="Đóng">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="row g-4">
            <div class="col-md-6">
              <label class="form-label fw-semibold">Họ tên</label>
              <input type="text" name="name" class="form-control rounded-3" value="{{ $user->name }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Email</label>
              <input type="email" name="email" class="form-control rounded-3" value="{{ $user->email }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Số điện thoại</label>
              <input type="text" name="phone" class="form-control rounded-3" value="{{ $user->phone }}">
            </div>
            <div class="col-md-12">
              <label class="form-label fw-semibold">Địa chỉ chi tiết</label>
              <input type="text" name="detail" class="form-control rounded-3" value="{{ $user->address->detail ?? '' }}">
            </div>
            <div class="col-md-4">
              <label class="form-label fw-semibold">Tỉnh/Thành phố</label>
              <select id="province" name="province" class="form-select rounded-3" required style="min-height:44px;">
                <option value="">Chọn tỉnh/thành</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label fw-semibold">Quận/Huyện</label>
              <select id="district" name="district" class="form-select rounded-3" required style="min-height:44px;">
                <option value="">Chọn quận/huyện</option>
              </select>
            </div>
            <div class="col-md-4 d-flex flex-column">
              <label class="form-label fw-semibold">Phường/Xã</label>
              <select id="ward" name="ward" class="form-select rounded-3 flex-grow-1" required style="min-height:44px;">
                <option value="">Chọn phường/xã</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light rounded-bottom-4">
          <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary px-4">Lưu thay đổi</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('sripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let addressData = {};
    let provinceSelect = document.getElementById('province');
    let districtSelect = document.getElementById('district');
    let wardSelect = document.getElementById('ward');

    fetch('{{ asset('address/tree.json') }}')
        .then(res => res.json())
        .then(data => {
            addressData = data;
            // Render province
            let selectedProvince = @json($user->address->province ?? '');
            let selectedDistrict = @json($user->address->district ?? '');
            let selectedWard = @json($user->address->ward ?? '');
            for (const code in addressData) {
                const province = addressData[code];
                const opt = document.createElement('option');
                opt.value = province.name_with_type;
                opt.textContent = province.name_with_type;
                opt.setAttribute('data-code', code);
                if (opt.value === selectedProvince) opt.selected = true;
                provinceSelect.appendChild(opt);
            }
            if (provinceSelect.value) {
                renderDistricts();
            }
        });

    provinceSelect.addEventListener('change', renderDistricts);
    districtSelect.addEventListener('change', renderWards);

    function renderDistricts() {
        districtSelect.innerHTML = '<option value="">Chọn quận/huyện</option>';
        wardSelect.innerHTML = '<option value="">Chọn phường/xã</option>';
        let selectedProvince = provinceSelect.value;
        let selectedDistrict = @json($user->address->district ?? '');
        const selectedOption = provinceSelect.options[provinceSelect.selectedIndex];
        const provinceCode = selectedOption.getAttribute('data-code');
        if (!provinceCode || !addressData[provinceCode]) return;
        const districts = addressData[provinceCode]['quan-huyen'];
        for (const dCode in districts) {
            const d = districts[dCode];
            const opt = document.createElement('option');
            opt.value = d.name_with_type;
            opt.textContent = d.name_with_type;
            opt.setAttribute('data-code', dCode);
            if (opt.value === selectedDistrict) opt.selected = true;
            districtSelect.appendChild(opt);
        }
        if (districtSelect.value) {
            renderWards();
        }
    }

    function renderWards() {
        wardSelect.innerHTML = '<option value="">Chọn phường/xã</option>';
        let selectedWard = @json($user->address->ward ?? '');
        const provinceOption = provinceSelect.options[provinceSelect.selectedIndex];
        const districtOption = districtSelect.options[districtSelect.selectedIndex];
        const provinceCode = provinceOption.getAttribute('data-code');
        const districtCode = districtOption ? districtOption.getAttribute('data-code') : null;
        if (!provinceCode || !districtCode || !addressData[provinceCode] || !addressData[provinceCode]['quan-huyen'][districtCode]) return;
        const wards = addressData[provinceCode]['quan-huyen'][districtCode]['xa-phuong'];
        for (const wCode in wards) {
            const w = wards[wCode];
            const opt = document.createElement('option');
            opt.value = w.name_with_type;
            opt.textContent = w.name_with_type;
            if (opt.value === selectedWard) opt.selected = true;
            wardSelect.appendChild(opt);
        }
    }
});
</script>
@endpush
@endsection