{{-- filepath: d:\Project\mỹ lord\luan-van\resources\views\pages\order_detail.blade.php --}}
@extends('layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Đơn hàng của bạn</h2>
    <div class="row g-4">
        @foreach ($orders as $item)
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold text-primary">Mã đơn hàng: {{ $item->id }}</span>
                        @php
                            $statusArr = [
                                0 => ['label' => 'Đang chờ', 'class' => 'bg-secondary'],
                                1 => ['label' => 'Đã duyệt', 'class' => 'bg-primary'],
                                2 => ['label' => 'Đang giao', 'class' => 'bg-warning'],
                                3 => ['label' => 'Đã giao hàng', 'class' => 'bg-success'],
                                4 => ['label' => 'Đã huỷ', 'class' => 'bg-danger'],
                            ];
                            $status = $statusArr[$item->status] ?? $statusArr[0];
                        @endphp
                        <span class="badge {{ $status['class'] }} text-white py-2 px-3 fs-6">
                            {{ $status['label'] }}
                        </span>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted small">Ngày đặt:</span>
                        <span>{{ $item->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted small">Tổng tiền:</span>
                        <span class="fw-bold text-danger">{{ number_format($item->total, 0, ',', '.') }}₫</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted small">Thanh toán:</span>
                        <span class="badge {{ $item->payment_status == 1 ? 'bg-success' : 'bg-secondary' }} text-white py-2 px-3 fs-6">
                            {{ $item->payment_status == 1 ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                        </span>
                    </div>
                    <button class="btn btn-outline-primary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#orderModal{{ $item->id }}">
                        Xem chi tiết
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Modal chi tiết đơn hàng --}}
    @foreach ($orders as $item)
    <div class="modal fade" id="orderModal{{ $item->id }}" tabindex="-1" aria-labelledby="orderModalLabel{{ $item->id }}" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="orderModalLabel{{ $item->id }}">Chi tiết đơn hàng #{{ $item->id }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
          </div>
          <div class="modal-body">
            @if(count($item->products))
            <ul class="list-group mb-3">
                @foreach ($item->products as $product)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        {{-- Ảnh sản phẩm --}}
                        <img src="{{ asset('storage/' . $product->product_images->image1) }}" alt="{{ $product->product->name }}" style="width:48px;height:48px;object-fit:cover;border-radius:6px;margin-right:12px;">
                        <div>
                            <strong>{{ $product->product->name }}</strong>
                            <div class="text-muted small">
                                Size: {{ $product->size ?? 'Không có thông tin' }}
                            </div>
                            <div class="text-muted small">
                                x{{ $product->pivot->quantity ?? 1 }}
                            </div>
                        </div>
                    </div>
                    <span>{{ number_format($product->price ?? 0, 0, ',', '.') }}₫</span>
                </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between">
                    <span><strong>Tổng cộng</strong></span>
                    <strong class="text-primary">{{ number_format($item->getOriginal('total'), 0, ',', '.') }}₫</strong>
                </li>
            </ul>
            @else
            <div class="alert alert-warning mb-3">
                Đơn hàng không có sản phẩm nào.
            </div>
            @endif
            <div>
                <strong>Địa chỉ giao hàng:</strong>
                <p class="mb-0">
                    {{ $item->detail }},
                    {{ $item->ward }},
                    {{ $item->district }},
                    {{ $item->province }}
                </p>
            </div>
            <div>
                <strong>Ghi chú:</strong>
                <p class="mb-0">{{ $item->note }}</p>
            </div>
            @if ($item->status == 4)
            <div class="alert alert-danger mt-3 mb-0">
                Đơn hàng này đã bị huỷ.
            </div>
            @endif
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
</div>
@endsection