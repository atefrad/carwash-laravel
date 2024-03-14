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

                    @auth
{{--                    <a href="{{ route('track-appointment.create') }}" class="nav-item nav-link">Track Your Appointment</a>--}}

                        @if(auth()->user()->is_manager)

                            <a href="{{ route('managers.index') }}" class="nav-item nav-link">Management Panel</a>

                        @else

                            <a href="{{ route('dashboard') }}" class="nav-item nav-link">Dashboard</a>

                        @endif

                    @endauth

                </div>
                @auth
                    <div class="ml-auto">
                        <a class="btn btn-custom" href="{{ route('appointments.create') }}">Get Appointment</a>
                        <form class="d-inline" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-custom" href="{{ route('logout') }}">Log out</button>
                        </form>
                    </div>
                @else
                    <div class="ml-auto">
                        <a class="btn btn-custom" href="{{ route('login') }}">Log in</a>
                        <a class="btn btn-custom" href="{{ route('register') }}">Register</a>
                    </div>
                @endauth

            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->
