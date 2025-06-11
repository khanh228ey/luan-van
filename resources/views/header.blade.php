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
                             aria-expanded="false">Danh mục </a>
                         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                             <div class="container">
                                 <div class="divider"></div>
                                 <div class="row">
                                    @foreach ($category as $item)
                                        <div class="col-md-2">
                                            <h6 class="text-uppercase">{{ $item->name }}</h6>
                                            <ul class="nav flex-column">
                                                @foreach ($item->products as $key => $product)
                                                @if ($key >3)
                                                    @break
                                                @endif
                                                    <li class="nav-item"><a class="nav-link" href="#">{{ $product->name }}</a></li>
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
                     <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                             id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                             aria-expanded="false">Pages </a>
                         <div class="dropdown-menu" aria-labelledby="navbarDropdown"><a class="dropdown-item"
                                 href="index.html">Homepage</a>
                             <div class="dropdown-divider"></div>
                             <a class="dropdown-item" href="catalog.html">Catalog</a>
                             <a class="dropdown-item" href="item.html">Item Detail</a>
                             <a class="dropdown-item" href="cart.html">Cart</a>
                             <div class="dropdown-divider"></div>
                             <a class="dropdown-item" href="contact.html">Liên hệ</a>
                         </div>
                     </li>
                     <li class="nav-item"><a class="nav-link" href="contact.html">Liên hệ</a></li>
                     <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                             id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                             aria-expanded="false"><i class="fas fa-shopping-cart"></i> <span
                                 class="badge badge-pill badge-primary">3</span></a>
                         <div class="dropdown-menu dropdown-menu-right dropdown-cart"
                             aria-labelledby="navbarDropdown">
                             <h6>3 Items <span class="emphasis">$147.00</span></h6>
                             <div class="dropdown-divider"></div>
                             <ul class="shopping-cart-items">
                                 <li class="row">
                                     <div class="col-3">
                                         <img src="images/placeholder-product.jpg" width="60">
                                     </div>
                                     <div class="col-9">
                                         <h6><a href="item.html">Product Name</a></h6>
                                         <span class="text-muted">1x</span>
                                         <span class="emphasis">$49.00</span>
                                     </div>
                                 </li>
                                 <li class="row">
                                     <div class="col-3">
                                         <img src="images/placeholder-product.jpg" width="60">
                                     </div>
                                     <div class="col-9">
                                         <h6><a href="item.html">Product Name</a></h6>
                                         <span class="text-muted">1x</span>
                                         <span class="emphasis">$49.00</span>
                                     </div>
                                 </li>
                                 <li class="row">
                                     <div class="col-3">
                                         <img src="images/placeholder-product.jpg" width="60">
                                     </div>
                                     <div class="col-9">
                                         <h6><a href="item.html">Product Name</a></h6>
                                         <span class="text-muted">1x</span>
                                         <span class="emphasis">$49.00</span>
                                     </div>
                                 </li>
                             </ul>

                             <a href="cart.html" class="btn btn-lg btn-full-width btn-primary"
                                 style="margin: 0;">View Cart</a>
                         </div>
                     </li>
                 </ul>
             </div>
         </div>
     </nav>
 </section>