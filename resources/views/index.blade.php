@extends('layouts.main')

@section('head-tag')
    <title> CarWash</title>
@endsection

@section('content')

<!-- Carousel Start -->
<div class="carousel">
    <div class="container-fluid">
        <div class="owl-carousel">
            <div class="carousel-item">
                <div class="carousel-img">
                    <img src="img/carousel-1.jpg" alt="Image">
                </div>
                <div class="carousel-text">
                    <h3>Washing & Detailing</h3>
                    <h1>Keep your Car Newer</h1>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasellus ut mollis mauris. Vivamus egestas eleifend dui ac
                    </p>
                    <a class="btn btn-custom" href="">Explore More</a>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-img">
                    <img src="img/carousel-2.jpg" alt="Image">
                </div>
                <div class="carousel-text">
                    <h3>Washing & Detailing</h3>
                    <h1>Quality service for you</h1>
                    <p>
                        Morbi sagittis turpis id suscipit feugiat. Suspendisse eu augue urna. Morbi sagittis orci sodales
                    </p>
                    <a class="btn btn-custom" href="">Explore More</a>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-img">
                    <img src="img/carousel-3.jpg" alt="Image">
                </div>
                <div class="carousel-text">
                    <h3>Washing & Detailing</h3>
                    <h1>Exterior & Interior Washing</h1>
                    <p>
                        Sed ultrices, est eget feugiat accumsan, dui nibh egestas tortor, ut rhoncus nibh ligula euismod quam
                    </p>
                    <a class="btn btn-custom" href="">Explore More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->

<!-- About Start -->
<div class="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-img">
                    <img src="img/about.jpg" alt="Image">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-header text-left">
                    <p>About Us</p>
                    <h2>car washing and detailing</h2>
                </div>
                <div class="about-content">
                    <p>
                        Lorem ipsum dolor sit amet elit. In vitae turpis. Donec in hendre dui, vel blandit massa. Ut vestibu suscipi cursus. Cras quis porta nulla, ut placerat risus. Aliquam nec magna eget velit luctus dictum
                    </p>
                    <ul>
                        <li><i class="far fa-check-circle"></i>Seats washing</li>
                        <li><i class="far fa-check-circle"></i>Vacuum cleaning</li>
                        <li><i class="far fa-check-circle"></i>Interior wet cleaning</li>
                        <li><i class="far fa-check-circle"></i>Window wiping</li>
                    </ul>
                    <a class="btn btn-custom" href="">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Service Start -->
<div class="service">
    <div class="container">
        <div class="section-header text-center">
            <p>What We Do?</p>
            <h2>Premium Washing Services</h2>
        </div>
        <div class="row">

            @foreach($services as $service)

                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-car-wash-1"></i>
                        <h3>{{ $service->name }}</h3>
                        <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                    </div>
                </div>

            @endforeach

        </div>
    </div>
</div>
<!-- Service End -->


<!-- Facts Start -->
<div class="facts" data-parallax="scroll" data-image-src="img/facts.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="fa fa-map-marker-alt"></i>
                    <div class="facts-text">
                        <h3 data-toggle="counter-up">25</h3>
                        <p>Service Points</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="fa fa-user"></i>
                    <div class="facts-text">
                        <h3 data-toggle="counter-up">350</h3>
                        <p>Engineers & Workers</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="fa fa-users"></i>
                    <div class="facts-text">
                        <h3 data-toggle="counter-up">1500</h3>
                        <p>Happy Clients</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="facts-item">
                    <i class="fa fa-check"></i>
                    <div class="facts-text">
                        <h3 data-toggle="counter-up">5000</h3>
                        <p>Projects Completed</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Facts End -->


<!-- Price Start -->
<div class="price">
    <div class="container">
        <div class="section-header text-center">
            <p>Washing Plan</p>
            <h2>Choose Your Plan</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="price-item">
                    <div class="price-header">
                        <h3>Exterior Wash</h3>
                        <h2><span>$</span><strong>25</strong><span>000</span></h2>
                    </div>
                    <div class="price-body">
                        <ul>
                            <li><i class="far fa-times-circle"></i>Seats Washing</li>
                            <li><i class="far fa-times-circle"></i>Vacuum Cleaning</li>
                            <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                            <li><i class="far fa-times-circle"></i>Interior Wet Cleaning</li>
                            <li><i class="far fa-check-circle"></i>Window Wiping</li>
                        </ul>
                    </div>
                    <div class="price-footer">
                        <a class="btn btn-custom" href="{{ route('appointments.create') }}">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="price-item featured-item">
                    <div class="price-header">
                        <h3>Interior Cleaning</h3>
                        <h2><span>$</span><strong>30</strong><span>000</span></h2>
                    </div>
                    <div class="price-body">
                        <ul>
                            <li><i class="far fa-check-circle"></i>Seats Washing</li>
                            <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                            <li><i class="far fa-times-circle"></i>Exterior Cleaning</li>
                            <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                            <li><i class="far fa-times-circle"></i>Window Wiping</li>
                        </ul>
                    </div>
                    <div class="price-footer">
                        <a class="btn btn-custom" href="{{ route('appointments.create') }}">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="price-item">
                    <div class="price-header">
                        <h3>Full Service</h3>
                        <h2><span>$</span><strong>80</strong><span>000</span></h2>
                    </div>
                    <div class="price-body">
                        <ul>
                            <li><i class="far fa-check-circle"></i>Seats Washing</li>
                            <li><i class="far fa-check-circle"></i>Vacuum Cleaning</li>
                            <li><i class="far fa-check-circle"></i>Exterior Cleaning</li>
                            <li><i class="far fa-check-circle"></i>Interior Wet Cleaning</li>
                            <li><i class="far fa-check-circle"></i>Window Wiping</li>
                        </ul>
                    </div>
                    <div class="price-footer">
                        <a class="btn btn-custom" href="{{ route('appointments.create') }}">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Price End -->

<!-- Testimonial Start -->
<div class="testimonial">
    <div class="container">
        <div class="section-header text-center">
            <p>Testimonial</p>
            <h2>What our clients say</h2>
        </div>
        <div class="owl-carousel testimonials-carousel">
            <div class="testimonial-item">
                <img src="img/testimonial-1.jpg" alt="Image">
                <div class="testimonial-text">
                    <h3>Client Name</h3>
                    <h4>Profession</h4>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu metus tortor auctor gravid
                    </p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="img/testimonial-2.jpg" alt="Image">
                <div class="testimonial-text">
                    <h3>Client Name</h3>
                    <h4>Profession</h4>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu metus tortor auctor gravid
                    </p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="img/testimonial-3.jpg" alt="Image">
                <div class="testimonial-text">
                    <h3>Client Name</h3>
                    <h4>Profession</h4>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu metus tortor auctor gravid
                    </p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="img/testimonial-4.jpg" alt="Image">
                <div class="testimonial-text">
                    <h3>Client Name</h3>
                    <h4>Profession</h4>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu metus tortor auctor gravid
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->


<!-- Blog Start -->
<div class="blog">
    <div class="container">
        <div class="section-header text-center">
            <p>Our Blog</p>
            <h2>Latest news & articles</h2>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="blog-item">
                    <div class="blog-img">
                        <img src="img/blog-1.jpg" alt="Image">
                        <div class="meta-date">
                            <span>01</span>
                            <strong>Jan</strong>
                            <span>2045</span>
                        </div>
                    </div>
                    <div class="blog-text">
                        <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
                        <p>
                            Lorem ipsum dolor sit amet elit. Pellent iaculis blandit lorem, quis convall diam eleife. Nam in arcu sit amet massa ferment quis enim. Nunc  augue velit metus congue eget semper
                        </p>
                    </div>
                    <div class="blog-meta">
                        <p><i class="fa fa-user"></i><a href="">Admin</a></p>
                        <p><i class="fa fa-folder"></i><a href="">Web Design</a></p>
                        <p><i class="fa fa-comments"></i><a href="">15 Comments</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog-item">
                    <div class="blog-img">
                        <img src="img/blog-2.jpg" alt="Image">
                        <div class="meta-date">
                            <span>01</span>
                            <strong>Jan</strong>
                            <span>2045</span>
                        </div>
                    </div>
                    <div class="blog-text">
                        <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
                        <p>
                            Lorem ipsum dolor sit amet elit. Pellent iaculis blandit lorem, quis convall diam eleife. Nam in arcu sit amet massa ferment quis enim. Nunc  augue velit metus congue eget semper
                        </p>
                    </div>
                    <div class="blog-meta">
                        <p><i class="fa fa-user"></i><a href="">Admin</a></p>
                        <p><i class="fa fa-folder"></i><a href="">Web Design</a></p>
                        <p><i class="fa fa-comments"></i><a href="">15 Comments</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog-item">
                    <div class="blog-img">
                        <img src="img/blog-3.jpg" alt="Image">
                        <div class="meta-date">
                            <span>01</span>
                            <strong>Jan</strong>
                            <span>2045</span>
                        </div>
                    </div>
                    <div class="blog-text">
                        <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
                        <p>
                            Lorem ipsum dolor sit amet elit. Pellent iaculis blandit lorem, quis convall diam eleife. Nam in arcu sit amet massa ferment quis enim. Nunc  augue velit metus congue eget semper
                        </p>
                    </div>
                    <div class="blog-meta">
                        <p><i class="fa fa-user"></i><a href="">Admin</a></p>
                        <p><i class="fa fa-folder"></i><a href="">Web Design</a></p>
                        <p><i class="fa fa-comments"></i><a href="">15 Comments</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog End -->
@endsection
