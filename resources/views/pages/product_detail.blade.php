@extends('layout')
@section('content')
    <section class="featured-block text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center">
                    <div class="product-image mt-3">
                        <img class="img-fluid" src="{{asset('storage/'.$product->product_images->image1)}}">
                    </div>
                    <div class="product-thumbnails"><a href="#">
                            <img class="mt-2 mr-2 img-fluid" src="{{asset('storage/'.$product->product_images->image2)}}"></a>
                        <a href="#">
                            <img class="mt-2 mr-2 img-fluid" src="{{asset('storage/'.$product->product_images->image3)}}"></a>
                        <a href="#">
                            <img class="mt-2 mr-2 img-fluid" src="{{asset('storage/'.$product->product_images->image4)}}"></a>
                    </div>
                </div>
                <div class="col-md-6 mt-5 mt-md-2 text-center text-md-left">
                    <h2 class="mb-3 mt-0">{{$product->name}}</h2>
                    <p class="lead mt-2 mb-3 primary-color">{{$product->price}} Đ</p>
                    <h5 class="mt-4">Description</h5>
                    <p>{{$product->description}}</p>
                    <select class="custom-select form-control mt-4 mb-4">
                        <option selected>Kích cỡ</option>
                        @foreach ($product->product_details as $size)
                            <option value="{{ $size->id }}">{{ $size->size }}</option>
                        @endforeach
                    </select>

                    <!--Quantity: <input type="text" class="form-control quantity mb-4" name="" value="1">-->

                    <a href="#" class="btn btn-full-width btn-lg btn-outline-primary">Thêm vào giỏ hàng</a>
                </div>
            </div>
        </div>
        </div>
    </section>

    <div class="divider"></div>

    <section class="products text-center">
        <div class="container">
            <h3 class="mb-4">Sản phẩm liên quan</h3>
            <div class="row">
                @foreach ($relatedProducts as $item)
                <div class="col-sm-6 col-md-3 col-product">
                    <figure>
                        <img class="rounded-corners img-fluid" src="{{asset('storage/'.$item->image)}}" width="240"
                            height="240">
                        <figcaption>
                            <div class="thumb-overlay"><a href="{{ route('product.detail', $item->id) }}" title="More Info">
                                    <i class="fas fa-search-plus"></i>
                                </a></div>
                        </figcaption>
                    </figure>
                    <h4><a href="{{ route('product.detail', $item->id) }}">{{$item->name}}</a></h4>
                    <p><span class="emphasis">{{$item->price}} Đ</span></p>
                </div>
                @endforeach
                
            </div>
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
@endsection
