@extends('layouts.main')

@section('content')

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
{{--                <div class="col-lg-7">--}}
{{--                    <div class="section-header text-left">--}}
{{--                        <p>Washing Points</p>--}}
{{--                        <h2>Car Washing & Care Points</h2>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-lg-5 offset-lg-4">
                    <div class="section-header text-center">
                        <p>Appointments</p>
                        <h2 class="font-size-40px">Booking an appointment</h2>
                    </div>
                    <div class="location-form">
                        <h3>Request for a car wash</h3>
                        <form action="{{ route('appointments.store') }}" method="POST">

                            @csrf

                            <div class="control-group">
                                <input type="text" class="form-control" name="name" placeholder="Name" required="required" />
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control" name="phone" placeholder="Phone" required="required" />
                            </div>
                            <div class="control-group">
                                <select class="form-control" name="service" id="service_selectBox" required="required" >
                                    <option disabled selected value="">Please select a service</option>
                                    <option class="text-dark" value="1">Exterior Wash</option>
                                    <option class="text-dark" value="2">Interior Cleaning</option>
                                    <option class="text-dark" value="3">Full Service</option>
                                </select>
                            </div>
                            <div class="form-check my-3 text-light">
                                <input type="radio" class="form-check-input" name="time_options" id="fastest_time" value="" required="required" />
                                <label class="form-check-label my-1" for="fastest_time">
                                    The fastest possible time
                                    <span class="d-block bg-light text-danger rounded p-1">1402/09/22 12:00-12:30</span>
                                </label>
                            </div>
                            <div class="form-check my-3 text-light">
                                <input type="radio" class="form-check-input" name="time_options" id="reserve_time" required="required" />
                                <label class="form-check-label" for="reserve_time">
                                    Reserve a time
                                </label>
                            </div>
                            <div id="time_options_div" class="control-group d-none">
                                <input type="datetime-local" class="form-control" name="time" id="time">
                            </div>
{{--                            <div id="time_options_div" class="control-group d-none">--}}
{{--                                <select class="form-control" name="time" id="service" required="required" >--}}
{{--                                    <option disabled selected value="">Please select a time</option>--}}
{{--                                    <option class="text-dark" value="1">The fastest possible time</option>--}}
{{--                                    <option class="text-dark" value="2">Reserve a time</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="control-group">--}}
{{--                                <input type="email" class="form-control" placeholder="Email" required="required" />--}}
{{--                            </div>--}}
{{--                            <div class="control-group">--}}
{{--                                <textarea class="form-control" placeholder="Description" required="required"></textarea>--}}
{{--                            </div>--}}
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
    <script>
        $('#reserve_time').click(function () {

            $('#time_options_div').removeClass('d-none');

        });
        $('#fastest_time').click(function () {

            if(!$('#time_options_div').hasClass('d-none'))
            {
                $('#time_options_div').addClass('d-none');
            }

        });

        $('#service_selectBox').change(function () {
            const serviceId = $(this).val()
            $.ajax({
                url: "/api/appointments/fastest-time?service_id=" + serviceId,
                type: "GET",
                dataType: 'json',
                success: function (response) {
                    // const myResponse = JSON.parse(response);
                    console.log(response);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        });
    </script>
@endsection
