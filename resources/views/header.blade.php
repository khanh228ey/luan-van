<section class="header text-center">
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container"><a class="navbar-brand" href="{{ route('home') }}"><i
                    class="fas fa-shopping-bag primary-color mr-1"></i> BANGSHOP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-1"
                aria-controls="navbar-1" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse pull-xs-right justify-content-end" id="navbar-1">
                <ul class="navbar-nav mt-2 mt-md-0">
                    <li class="nav-item active"><a class="nav-link" href="{{ route('home') }}">Trang chủ <span
                                class="sr-only">(current)</span></a></li>
                    <li class="nav-item dropdown mega-menu"><a class="nav-link dropdown-toggle" href="#"
                            id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">Danh mục</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <div class="container">
                                <div class="divider"></div>
                                <div class="row">
                                    @foreach ($category as $item)
                                        <div class="col-md-2">
                                            <h6 class="text-uppercase">{{ $item->name }}</h6>
                                            <ul class="nav flex-column">
                                                @foreach ($item->products as $key => $product)
                                                    @if ($key > 3)
                                                        @break
                                                    @endif
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="{{ route('product.detail', $product->id) }}">{{ $product->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                    <div class="col-md-4">
                                        <h6 class="text-uppercase"></h6>
                                        <div class="row">
                                            <div class="col-6 text-center"><a href="item.html">
                                                    <img src="images/placeholder-product.jpg" alt=""
                                                        class="img-fluid mt-2 mb-3"></a>
                                                <h6 class="mb-0"><a href="item.html">Product Name</a></h6>
                                                <p><span class="emphasis">$49.00</span></p>
                                                <a href="#" class="btn btn-sm btn-outline-secondary mt-0">Buy
                                                    Now</a>
                                                <p>
                                            </div>
                                            <div class="col-6 text-center"><a href="item.html">
                                                    <img src="images/placeholder-product.jpg" alt=""
                                                        class="img-fluid mt-2 mb-3"></a>
                                                <h6 class="mb-0"><a href="item.html">Product Name</a></h6>
                                                <p><span class="emphasis">$49.00</span></p>
                                                <a href="#" class="btn btn-sm btn-outline-secondary mt-0">Buy
                                                    Now</a>
                                                <p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('product.list') }}">Danh sách sản phẩm</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact.index') }}">Liên hệ</a></li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="fas fa-shopping-cart"></i> <span
                                class="badge badge-pill badge-primary">0</span></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-cart" aria-labelledby="navbarDropdown">
                            @if (Auth::check())
                                <h6>Tổng {{ $cartUser->count() }} sản phẩm<span class="emphasis"></span></h6>
                                <div class="dropdown-divider"></div>
                                <ul class="shopping-cart-items">
                                    @foreach ($cartUser as $item)
                                    <li class="row">
                                        <div class="col-3">
                                            <img src="{{ asset('storage/' . $item->product->product_images->image1) }}" width="60">
                                        </div>
                                        <div class="col-9">
                                            <h6><a href="{{ route('product.detail', $item->product->id) }}">{{ $item->product->name }}</a></h6>
                                            <span class="text-muted">SL: {{ $item->quantity }}-</span>
                                            <span class="emphasis">{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}₫</span>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('cart.view') }}" class="btn btn-lg btn-full-width btn-primary"
                                    style="margin: 0;">Xem giỏ hàng</a>
                            @else
                                <div class="dropdown-item text-center">
                                    <span>Vui lòng <a href="{{ route('page.login') }}">đăng nhập</a> để xem giỏ
                                        hàng</span>
                                </div>
                            @endif
                        </div>
                    </li>
                    <!-- Profile Icon -->
                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="#">Thông tin cá nhân</a>
                                <form action="{{ route('auth.logout') }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="dropdown-item"
                                        style="background: none; border: none; padding: 0; margin: 0; color: inherit; text-align: center; width: 100%;">
                                        Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ route('page.login') }}"
                                id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Đăng nhập
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</section>
