@extends('layouts')
@section('content')
    <section class="cart text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 mb-3 mb-m-1 text-md-left"><a href="catalog.html"><i class="fas fa-arrow-left mr-2"></i>
                        Continue Shopping</a></div>
                <div class="col-sm-6 text-md-right"><a href="catalog.html"
                        class="btn btn-primary btn-lg pl-5 pr-5">Checkout</a></div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="mt-5 mb-2">Your Shopping Cart</h2>
                    <p class="mb-5"><span class="primary-color">3</span> Items in your cart</p>
                    <table id="cart" class="table table-condensed">
                        <thead>
                            <tr>
                                <th style="width:60%">Product</th>
                                <th style="width:12%">Price</th>
                                <th style="width:10%">Quantity</th>
                                <th style="width:16%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-md-3 text-left">
                                            <img src="images/placeholder-product.jpg" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-md-9 text-left mt-sm-2">
                                            <h4>Product Name</h4>
                                            <p>York &amp; Smith</p>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price">$49.00</td>
                                <td data-th="Quantity">
                                    <input type="number" class="form-control text-center" value="1">
                                </td>
                                <td class="actions" data-th="">
                                    <div class="text-right">
                                        <button class="btn btn-white btn-md mb-2"><i class="fas fa-sync"></i></button>
                                        <button class="btn btn-white btn-md mb-2"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-md-3 text-left">
                                            <img src="images/placeholder-product.jpg" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-md-9 text-left mt-sm-2">
                                            <h4>Product Name</h4>
                                            <p>York &amp; Smith</p>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price">$49.00</td>
                                <td data-th="Quantity">
                                    <input type="number" class="form-control text-center" value="1">
                                </td>
                                <td class="actions" data-th="">
                                    <div class="text-right">
                                        <button class="btn btn-white btn-md mb-2"><i class="fas fa-sync"></i></button>
                                        <button class="btn btn-white btn-md mb-2"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-md-3 text-left">
                                            <img src="images/placeholder-product.jpg" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-md-9 text-left mt-sm-2">
                                            <h4>Product Name</h4>
                                            <p>York &amp; Smith</p>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price">$49.00</td>
                                <td data-th="Quantity">
                                    <input type="number" class="form-control text-center" value="1">
                                </td>
                                <td class="actions" data-th="">
                                    <div class="text-right">
                                        <button class="btn btn-white btn-md mb-2"><i class="fas fa-sync"></i></button>
                                        <button class="btn btn-white btn-md mb-2"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="float-right text-right">
                        <h4>Subtotal:</h4>
                        <h1>$147.00</h1>
                        <p>(Excluding Delivery)</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 mb-3 mb-m-1 text-md-left"><a href="catalog.html"><i class="fas fa-arrow-left mr-2"></i>
                        Continue Shopping</a></div>
                <div class="col-sm-6 text-md-right"><a href="catalog.html"
                        class="btn btn-primary btn-lg pl-5 pr-5">Checkout</a></div>
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
