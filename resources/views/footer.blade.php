<footer class="footer">
    <div class="container">
        <div class="row mb-5 text-center">
            @foreach ($category as $item)                                   
            <div class="col-sm-6 col-md-3 pt-2">
                <h5>{{ $item->name }} </h5>
                <ul class="nav-footer">
                    @foreach ( $item->products as $key => $pros)
                    @if ($key > 3)
                        @break      
                    @endif                                  
                    <li class="nav-item"><a class="nav-link" href="#">{{ $pros->name }}</a></li>
                   @endforeach
                </ul>
            </div>
         @endforeach
        </div>
    </div>

    <div class="container-fluid">
        <div class="divider"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-left mt-2 mb-3 pt-1">
                <p class="copyright">Copyright &copy; Example. Theme by <a href="https://medialoot.com">Medialoot</a>.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-right mb-4">
                <ul class="social">
                    <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#" title="Google+"><i class="fab fa-google"></i></a></li>
                    <li><a href="#" title="Dribbble"><i class="fab fa-dribbble"></i></a></li>
                    <li><a href="https://www.instagram.com/my_teiv/" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                    <div class="clear"></div>
                </ul>
            </div>
        </div>
    </div>
</footer>
