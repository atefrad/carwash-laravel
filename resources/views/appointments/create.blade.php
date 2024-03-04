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
                                <input type="text" class="form-control" name="name" placeholder="Name" required="required" value="{{ old('name') }}" />
                                @error('name')
                                <span> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control" name="phone" placeholder="Phone" required="required" value="{{ old('phone') }}" />
                                @error('phone')
                                <span> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="control-group border border-white rounded p-3">
{{--                                <select class="form-control" name="service_id" id="service_selectBox" required="required" multiple>--}}
{{--                                    <option disabled selected value="">Please select a service</option>--}}
{{--                                    @foreach($services as $service)--}}
{{--                                        <option {{ old('service_id') == $service->id ? 'selected' : '' }} class="text-dark" value="{{ $service->id }}">{{ $service->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
                                <p class="text-light">Carwash services : </p>
                                @foreach($services as $service)
                                    <div class="form-check form-check-inline text-light">
                                        <input class="form-check-input" type="checkbox" id="{{ $service->name }}" name="services[]" value="{{ $service->id }}">
                                        <label class="form-check-label" for="{{ $service->name }}">{{ $service->name }}</label>
                                    </div>
                                @endforeach

                                @error('service_id')
                                <span> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="form-check my-3 text-light">
                                <input type="radio" class="form-check-input" name="fastest_time" id="fastest_time" value="" required="required" />
                                <label class="form-check-label" for="fastest_time">
                                    The fastest possible time
                                    <span id="fastest_time_span" class="d-none bg-light text-danger rounded p-1 pl-2 mt-2"></span>
                                </label>
                                <input id="fastest_time_station" type="hidden" name="station" value="">
                            </div>
                            <div class="form-check my-3 text-light">
                                <input type="radio" class="form-check-input" name="fastest_time" id="reserve_time" required="required" />
                                <label class="form-check-label" for="reserve_time">
                                    Reserve a time
                                </label>
                                @error('start_time')
                                <span class="d-block text-dark"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div id="time_options_div" class="control-group d-none">
                                <input type="datetime-local" class="form-control" name="start_time" id="time">
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
                    console.log(response);
                    $('#fastest_time').val(response.fastest_time);
                    $('#fastest_time_span').removeClass('d-none');
                    $('#fastest_time_span').addClass('d-block');
                    $('#fastest_time_span').text(response.fastest_time);
                    $('#fastest_time_station').val(response.station);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        });
    </script>
@endsection
