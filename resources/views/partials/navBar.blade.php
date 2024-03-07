<!-- Nav Bar Start -->
<div class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
                    <a href="{{ route('trackAppointment.create') }}" class="nav-item nav-link">Track Your Appointment</a>
{{--                    <a href="service.html" class="nav-item nav-link">Service</a>--}}
{{--                    <a href="price.html" class="nav-item nav-link">Price</a>--}}
{{--                    <a href="location.html" class="nav-item nav-link">Washing Points</a>--}}
{{--                    <div class="nav-item dropdown">--}}
{{--                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>--}}
{{--                        <div class="dropdown-menu">--}}
{{--                            <a href="blog.html" class="dropdown-item">Blog Grid</a>--}}
{{--                            <a href="single.html" class="dropdown-item">Detail Page</a>--}}
{{--                            <a href="team.html" class="dropdown-item">Team Member</a>--}}
{{--                            <a href="booking.html" class="dropdown-item">Schedule Booking</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <a href="contact.html" class="nav-item nav-link">Contact</a>--}}
                </div>
                <div class="ml-auto">
                    <a class="btn btn-custom" href="{{ route('appointments.create') }}">Get Appointment</a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->
