@extends('layouts.main')

@section('head-tag')
    <title>Create new appointment</title>
@endsection

@section('content')

    @error('transaction')
        <div id="transaction_error" class="position-absolute alert alert-danger w-25 text-center">
            <p><strong>{{ $message }}</strong></p>
        </div>
    @enderror

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Booking</h2>
                </div>
                <div class="col-12">
                    <a href="">Home</a>
                    <a href="">Booking</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Location Start -->
    <div class="location">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 offset-lg-4">
                    <div class="section-header text-center">
                        <p>Appointments</p>
                        <h2 class="font-size-40px">Booking an appointment</h2>
                    </div>
                    <div class="location-form">
                        <h3>Request for a car wash</h3>
                        <form action="{{ route('appointments.store') }}" method="POST">

                            @csrf

{{--                            <div class="control-group">--}}
{{--                                <input type="text" class="form-control" name="name" placeholder="Name" required="required" value="{{ old('name') }}" />--}}
{{--                                @error('name')--}}
{{--                                <span class="d-block text-dark"> {{ $message }} </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="control-group">--}}
{{--                                <input type="text" class="form-control" name="phone" placeholder="Phone" required="required" value="{{ old('phone') }}" />--}}
{{--                                @error('phone')--}}
{{--                                <span class="d-block text-dark"> {{ $message }} </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
                            <div class="control-group border border-white rounded p-3">
                                <p class="text-light">Carwash services : </p>
                                @foreach($services as $service)
                                    <div class="form-check form-check-inline text-light">
                                        <input class="form-check-input" type="checkbox" id="{{ $service->name }}" name="services[]" value="{{ $service->id }}">
                                        <label class="form-check-label" for="{{ $service->name }}">{{ $service->name }}</label>
                                    </div>
                                @endforeach

                                @error('services')
                                <span class="d-block text-dark"> {{ $message }} </span>
                                @enderror

                                @error('services.*')
                                <span class="d-block text-dark"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="form-check my-3 text-light">
                                <button type="button" class="btn bg-light text-danger my-2" id="fastest_time">
                                    show the fastest time
                                </button>
                                <input type="radio" class="form-check-input d-none" name="time" id="fastest_time_input" value="" required="required" />
                                <label class="form-check-label d-block" id="fastest_time_label" for="fastest_time">

                                </label>
                            </div>

                            <div class="form-check my-3 text-light">
                                <button type="button" class="btn bg-light text-danger my-2" id="custom_time">
                                    Show all available times
                                </button>
                                @error('time')
                                <span class="d-block text-dark"> {{ $message }} </span>
                                @enderror

                                @error('time.*')
                                <span class="d-block text-dark"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div id="time_options_div" class="control-group ml-3 border border-white text-light rounded p-3 d-none">
                            </div>

                            <div>
                                <button class="btn btn-custom" type="submit">Send Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Location End -->

@endsection

@section('script')

    <script src="{{ asset('js/time-ajax.js') }}"></script>

    <script>

        setTimeout(function () {
            $('#transaction_error').toggleClass('d-none');
        }, 4000);

    </script>
@endsection
