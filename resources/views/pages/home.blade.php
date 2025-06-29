@extends('layout')
@section('content')

    <div id="carousel" class="carousel slide" data-ride="carousel">

        <script>
            $('.carousel').carousel({
                interval: 200
            })
        </script>

        <!-- Carousel Indicators -->
        <ul class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
        </ul>

        <!-- Carousel -->
        <div class="carousel-inner">

            <!--Text only with background image-->
            <div class="carousel-item active" style="background: url({{ asset('assets/images/cover-bg-1.jpg') }}) center;">
                <div class="container slide-textonly">
                    <div>
                        <h1>York &amp; Smith</h1>
                        <p class="lead">Spring/Summer 2025 Collection</p>
                        <a href="#" class="btn btn-outline-secondary">View Collection</a>
                    </div>
                </div>
            </div>

            <!--Text with image-->
            <div class="carousel-item">
                <div class="container slide-withimage">
                    <div class="description">
                        <h1>York &amp; Smith</h1>
                        <p class="lead">Ưu đãi cực lớn cho mọi đơn hàng</p>
                        <a href="#" class="btn btn-outline-secondary">View Collection</a>
                    </div>
                    <div class="slide-image">
                        <img src="{{ asset('assets/images/placeholder-shoes.png') }}" style="width: 80%;">
                    </div>
                </div>
            </div>

            <!--Text only with background image-->
            <div class="carousel-item" style="background: url({{ asset('assets/images/cover-bg-2.jpg') }}) center;">
                <div class="container slide-textonly">
                    <div>
                        <h1>York &amp; Smith</h1>
                        <p class="lead">Thời trang đỉnh cao, giá cực mềm</p>
                        <a href="#" class="btn btn-outline-secondary">View Collection</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="collections text-center ">
        <div class="container-fluid">
            <div class="row">
                <div class="collection col-md-6 alt-background">
                    <div class="container container-right text-center">
                        <div>
                            <h1>{{$brand1->name}}</h1>
                            <p class="lead">Spring/Summer 2025 Collection</p>
                            <a href="{{ route('product.brand', ['brandId' => $brand1->id]) }}" class="btn btn-outline-secondary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="collection col-md-6 bg-secondary inverted">
                    <div class="container container-left text-center">
                        <div>
                            <h1>{{$brand2->name}}</h1>
                            <p class="lead">Spring/Summer 2025 Collection</p>
                            <a href="{{ route('product.brand', ['brandId' => $brand2->id]) }}" class="btn btn-outline-white">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="featured-block text-center">
        <div class="container">
            <div class="row justify-center">
                <div class="col-md-6 text-center">
                    <img class="mt-4 mb-4 img-fluid" src="{{ asset('storage/'.$product->product_images->image1) }}" style="width: 100%;">
                </div>
                <div class="col-md-6 text-center text-md-left">
                    <h2 class="mb-3">{{$product->brand->name}} Bộ Sưu tập 2025</h2>
                    <p class="lead mt-2 mb-3">Sản phẩm nổi bật: {{$product->name}}.</p>
                    <p>{{$product->description}}</p>
                    <a href="{{ route('product.detail', $product->id) }}" class="btn btn-md btn-outline-primary mt-3">Mua ngay</a>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="products text-center">
        <div class="container">
            <h3 class="mb-4">Sản phẩm nổi bật</h3>
            <div class="row">
                @foreach ($products as $item )
                <div class="col-sm-6 col-md-3 col-product">
                    <figure>
                        <img class="rounded-corners img-fluid" src="{{asset('storage/'.$item->product_images->image1)}}" width="240"
                            height="240">
                        <figcaption>
                            <div class="thumb-overlay"><a href="{{ route('product.detail', $item->id) }}" title="More Info">
                                    <i class="fas fa-search-plus"></i>
                                </a></div>
                        </figcaption>
                    </figure>
                    <h4><a href="{{ route('product.detail', $item->id) }}">{{ $item->name }}</a></h4>
                    <p><span class="emphasis">{{ number_format($item->price, 0, ',', '.') }}₫</span></p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <section class="cta text-center">
        <div class="container">
            <h3 class="mt-0 mb-4">Đăng ký ngay để nhận giảm 10% cho đơn hàng đầu tiên.</h3>
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

    <script src="{{ asset('assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
@endsection
