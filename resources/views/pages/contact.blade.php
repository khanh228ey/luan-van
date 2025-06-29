@extends('layout')
@section('content')

    <section class="contact">
        <div id="map"></div>
        <script src="js/maps.js"></script>
        <!--YOU MUST REPLACE WITH YOUR OWN API KEY FOR THE MAP TO WORK-->
        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBptaDKT_ntSoNEytCnSang5JenaNAj_Us&callback=initMap"></script>
        <div class="container">
            <div class="row contact-details">
                <div class="col-sm-8 text-center text-md-left">
                    <h3 class="mb-4">Liên hệ với chúng tôi</h3>
                    <p class="mb-4"> Nếu bạn có bất kỳ câu hỏi, góp ý hoặc cần hỗ trợ, vui lòng liên hệ với chúng tôi qua thông tin dưới đây hoặc gửi tin nhắn qua biểu mẫu.</p>
                    <form class="contact-form mt-4">
                        <div class="row">
                            <div class="col-md-5">
                                <input type="text" class="form-control mb-4" placeholder="Name" value="Your name">
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control mb-4" placeholder="Email address"
                                    value="Email address">
                            </div>
                            <br />
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <textarea class="form-control mb-4" rows="5" style="height: 10em!important;">Your Message</textarea>
                                <br />
                                <button type="submit" class="btn btn-outline-primary btn-lg mb-4">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4 mb-5 text-center text-md-left">
                    <h3>Liên hệ</h3>
                    <h4 class="pt-4">Email</h4>
                    <p>vovietmy12@gmai.com</p>
                    <h4 class="pt-2">Phone</h4>
                    <p>0384385265</p>
                    <h4 class="pt-2">Address</h4>
                    <p>164 trần thị nơi, phường 4, quận 8
                        <br />Thành phố Hồ Chí Minh</p>
                    <ul class="social">
                        <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" title="Google+"><i class="fab fa-google"></i></a></li>
                        <li><a href="#" title="Dribbble"><i class="fab fa-dribbble"></i></a></li>
                        <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                        <div class="clear"></div>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
