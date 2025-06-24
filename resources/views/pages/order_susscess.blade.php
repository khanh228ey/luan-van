@extends('layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 text-center">
            <div class="card shadow rounded-4 border-0">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    </div>
                    <h2 class="mb-3 text-success">Đặt hàng thành công!</h2>
                    <p class="mb-4">Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ liên hệ xác nhận và giao hàng sớm nhất.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary px-4 py-2 rounded-3 fw-semibold">Quay về trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
