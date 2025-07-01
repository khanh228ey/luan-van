@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-lg-3 sidebar-filter">
            <h3 class="mt-5 mb-5">Xem <span class="primary-color">{{$products->count()}}</span> sản phẩm</h3>
            <h6 class="text-uppercase">Danh mục</h6>
            @foreach ($categories as $cate)
                <a href="{{ route('product.category', ['categoryId' => $cate->id]) }}" class="d-block py-1 px-2 mb-1 rounded filter-link text-dark" style="transition: background 0.2s;">
                    {{ $cate->name }}
                </a>
            @endforeach
            <div class="divider"></div>
            <h6 class="text-uppercase">Thương hiệu</h6>
            @foreach ($brands as $brand)
                <a href="{{ route('product.brand', ['brandId' => $brand->id]) }}" class="d-block py-1 px-2 mb-1 rounded filter-link text-dark" style="transition: background 0.2s;">
                    {{ $brand->name }}
                </a>
            @endforeach
            <style>
            .filter-link:hover {
                background: #f1f1f1;
                text-decoration: none;
            }
            </style>
            <div class="divider"></div>

            <h6 class="text-uppercase">Lọc theo giá</h6>
            <form method="GET" action="{{ route('product.filter.price') }}">
                <div class="price-filter">
                    <input type="number" class="form-control mb-2" name="min_price" placeholder="Giá từ" value="{{ request('min_price') }}">
                    <input type="number" class="form-control mb-2" name="max_price" placeholder="Giá đến" value="{{ request('max_price') }}">
                </div>
                <button type="submit" class="btn btn-lg btn-full-width btn-primary mt-2">Lọc giá</button>
            </form>

            <div class="divider"></div>
        </div>

            <div class="col-md-8 col-lg-9">
                <section class="products">
                    <div class="container">
                        <div class="row sorting mb-5">
                            <div class="col-12">
                                <div class="dropdown float-left">
                                    <label class="mr-2">Sort by:</label>
                                    <a class="btn btn-lg btn-white dropdown-toggle" data-toggle="dropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Relevance <span
                                            class="caret"></span></a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown"><a class="dropdown-item"
                                            href="#">Relevance</a>
                                        <a class="dropdown-item" href="#">Price Descending</a>
                                        <a class="dropdown-item" href="#">Price Ascending</a>
                                        <a class="dropdown-item" href="#">Best Selling</a>
                                    </div>
                                </div>
                                <div class="btn-group float-right ml-3">
                                    <button type="button" class="btn btn-lg btn-white"><span
                                            class="fa fa-arrow-left"></span></button>
                                    <button type="button" class="btn btn-lg btn-white"><span
                                            class="fa fa-arrow-right"></span></button>
                                </div>
                                <div class="dropdown float-right">
                                    <label class="mr-2">View:</label>
                                    <a class="btn btn-lg btn-white dropdown-toggle" data-toggle="dropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">12 <span
                                            class="caret"></span></a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown"><a class="dropdown-item"
                                            href="#">12</a>
                                        <a class="dropdown-item" href="#">24</a>
                                        <a class="dropdown-item" href="#">48</a>
                                        <a class="dropdown-item" href="#">96</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if($products->count() == 0)
                                <div class="col-12 text-center">
                                    <p>Không có sản phẩm nào.</p>
                                </div>
                            @endif
                            @foreach ($products as $product)
                                <div class="col-md-6 col-lg-4 col-product">
                                    <figure>
                                        <img class="rounded-corners img-fluid"
                                            src="{{ asset('storage/' . $product->product_images->image1) }}">
                                        <figcaption>
                                            <div class="thumb-overlay"><a href="{{ route('product.detail', $product->id) }}"
                                                    title="More Info">
                                                    <i class="fas fa-search-plus"></i>
                                                </a></div>
                                        </figcaption>
                                    </figure>
                                    <h4 class="mb-1"><a
                                            href="{{ route('product.detail', $product->id) }}">{{ $product->name }}</a>
                                    </h4>
                                    <p><span class="emphasis">{{ number_format($product->price, 0, ',', '.') }} Đ</span></p>
                                </div>
                            @endforeach
                        </div>
                        <div class="row sorting mb-5">
                            <div class="col-12"><a class="btn"><i class="fas fa-arrow-up mr-2"></i>Quay lại</a>
                                <div class="btn-group float-right ml-3">
                                    <button type="button" class="btn btn-lg btn-white"><span
                                            class="fa fa-arrow-left"></span></button>
                                    <button type="button" class="btn btn-lg btn-white"><span
                                            class="fa fa-arrow-right"></span></button>
                                </div>
                                <div class="dropdown float-right">
                                    <label class="mr-2">View:</label>
                                    <a class="btn btn-white btn-lg dropdown-toggle" data-toggle="dropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">12 <span
                                            class="caret"></span></a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown"><a class="dropdown-item"
                                            href="#">12</a>
                                        <a class="dropdown-item" href="#">24</a>
                                        <a class="dropdown-item" href="#">48</a>
                                        <a class="dropdown-item" href="#">96</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

<div class="divider"></div>

<section class="cta text-center">
    <div class="container">
        <h3 class="mt-0 mb-4">Liên hệ với chúng tôi</h3>
        <form class="subscribe">
            <div class="form-group row pt-3">
                <div class="col-sm-8 mb-3">
                    <input type="text" class="form-control" id="inputName" placeholder="Your Name">
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-lg btn-outline-primary">Gửi email</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
