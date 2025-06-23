@extends('layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card shadow rounded-4 border-0">
                <div class="card-body p-4">
                    <div class="row align-items-center mb-4">
                        <div class="col-auto text-center">
                            <img src="{{ Auth::user()->avatar ?? 'https://via.placeholder.com/100' }}" alt="Avatar" class="rounded-circle border shadow-sm" style="width:100px;height:100px;object-fit:cover;">
                        </div>
                        <div class="col ps-0">
                            <h3 class="mb-1 fw-bold">{{ Auth::user()->name }}</h3>
                            <div class="text-muted" style="font-size:1.1em;">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <form id="profileForm" method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Số điện thoại</label>
                            <input type="text" class="form-control form-control-lg rounded-3" name="phone" value="{{ Auth::user()->phone }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Địa chỉ</label>
                            <input type="text" class="form-control form-control-lg rounded-3 mb-2" name="address_detail" value="{{ Auth::user()->address_detail }}" placeholder="Địa chỉ" readonly>
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <select class="form-control form-control-lg rounded-3" name="province" disabled>
                                        <option>{{ Auth::user()->province ?? 'Tỉnh / thành' }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control form-control-lg rounded-3" name="district" disabled>
                                        <option>{{ Auth::user()->district ?? 'Quận / huyện' }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control form-control-lg rounded-3" name="ward" disabled>
                                        <option>{{ Auth::user()->ward ?? 'Phường / xã' }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4 align-items-center">
                            <button type="button" id="editBtn" class="btn btn-outline-primary px-4 py-2 rounded-3 fw-semibold">Chỉnh sửa</button>
                            <button type="submit" id="saveBtn" class="btn btn-primary ms-3 px-4 py-2 rounded-3 fw-semibold d-none">Lưu</button>
                            <button type="button" id="cancelBtn" class="btn btn-secondary ms-4 px-4 py-2 rounded-3 fw-semibold d-none">Huỷ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const form = document.getElementById('profileForm');
    const inputs = form.querySelectorAll('input, select');

    editBtn.addEventListener('click', function() {
        inputs.forEach(i => i.removeAttribute('readonly'));
        inputs.forEach(i => i.removeAttribute('disabled'));
        editBtn.classList.add('d-none');
        saveBtn.classList.remove('d-none');
        cancelBtn.classList.remove('d-none');
    });

    cancelBtn.addEventListener('click', function() {
        window.location.reload();
    });
});
</script>
@endsection
