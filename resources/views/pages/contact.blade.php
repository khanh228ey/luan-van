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
                    <h3 class="mb-4">Ask us a question</h3>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus venenatis velit
                        vestibulum massa sollicitudin auctor. Cras ac venenatis orci. Ut consequat, purus ut ultrices
                        ultricies, nisi sem ornare quam, sed ultricies mi nisl sit amet purus.</p>
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
                    <h3>Contact</h3>
                    <h4 class="pt-4">Email</h4>
                    <p>hello@example.com</p>
                    <h4 class="pt-2">Phone</h4>
                    <p>+111 234 567 89</p>
                    <h4 class="pt-2">Address</h4>
                    <p>1 Street Name, City, Zip Code
                        <br />United States
                    </p>
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
