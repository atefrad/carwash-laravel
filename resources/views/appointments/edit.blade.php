@extends('layouts.main')

@section('content')

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Edit Appointment</h2>
                </div>
                <div class="col-12">
                    <a href="">Home</a>
                    <a href="">Edit</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="single">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
{{--                    <section id="flash-message" class="alert alert-danger p-4 mt-4 d-none" role="alert">--}}
{{--                        @if(session('error'))--}}
{{--                            {{ session('error') }}--}}
{{--                        @endif--}}
{{--                    </section>--}}
                    <div class="comment-form">
                        <h2 class="text-center">Edit Your Appointment</h2>
                        <form action="{{ route('appointments.update', $appointment) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="phone">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $appointment->name }}">
                                @error('name')
                                <span class="d-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{ $appointment->phone }}" disabled>
                                @error('phone')
                                <span class="d-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="control-group border rounded p-3 my-3">
                                <p>Carwash services : </p>
                                @foreach($services as $service)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="{{ $service->name }}" name="services[]" value="{{ $service->id }}"
                                        @foreach($appointment->services as $appointmentService)
                                            @if($appointmentService->id === $service->id)
                                                {{ 'checked' }}
                                            @endif
                                        @endforeach>
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

                            <div class="form-group border rounded p-3">
                                <label for="time">Time</label>
                                <div class="row">
                                    <div class="col-9 ml-3">
                                        <input type="radio" class="form-check-input" name="time" id="selected_time"
                                               value="{{ $selectedTimeValues }}" required="required" />
                                        <label class="form-check-label d-block" for="selected_time">
                                            {{ $appointment->times[0]->year . '-' .
                                            $appointment->times[0]->month . '-' .
                                            $appointment->times[0]->day . ' ' .
                                            substr($appointment->times[0]->start_time, 0, 5) . ' - ' .
                                            substr($appointment->times[count($appointment->times) - 1]->finish_time, 0, 5)
                                               }}
                                            </label>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" id="change_time_btn" class="btn btn-custom">Change</button>
                                        </div>
                                    </div>
                                </div>

                                <div id="change_time_options" class="d-none">
                                    <div class="form-check my-3">
                                        <button type="button" class="btn btn-custom my-2" id="fastest_time">
                                            show the fastest time
                                        </button>
                                        <input type="radio" class="form-check-input d-none" name="time" id="fastest_time_input" value="" required="required" />
                                        <label class="form-check-label d-block" id="fastest_time_label" for="fastest_time">

                                        </label>
                                    </div>

                                    <div class="form-check my-3">
                                        <button type="button" class="btn btn-custom  my-2" id="custom_time">
                                            Show all available times
                                        </button>
                                        @error('time')
                                        <span class="d-block text-dark"> {{ $message }} </span>
                                        @enderror

                                        @error('time.*')
                                        <span class="d-block text-dark"> {{ $message }} </span>
                                        @enderror
                                    </div>

                                    <div id="time_options_div" class="control-group ml-3">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tracking_code">Tracking Code</label>
                                    <input type="text" class="form-control" name="tracking_code" id="tracking_code" value="{{ $appointment->tracking_code }}" disabled>
                                    @error('tracking_code')
                                    <span class="d-block text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Update" class="btn btn-custom">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @section('script')
        <script>

            $('#change_time_btn').click(function () {

                $('#change_time_options').removeClass('d-none');
            });

            const fastestTimeInput = $('#fastest_time_input');

            $('#fastest_time').click(function () {

                let servicesId = '';

                 $('input[name="services[]"]:checked').each(function () {

                     servicesId += $(this).val() + ' ';
                 });

                $.ajax({
                    url: "/api/times/show?service_id=" + servicesId,
                    type: "GET",
                    dataType: 'json',
                    success: function (response) {

                        if(response.error)
                        {
                            alert(response.error);
                        }

                        let timesId = '';

                        for(let timeSlot of response)
                        {
                            timesId+= timeSlot.id + ',';
                        }

                        fastestTimeInput.val(timesId);
                        fastestTimeInput.removeClass('d-none');
                        fastestTimeInput.addClass('d-block');
                        $('#fastest_time_label').text(
                            response[0].year + '-' +
                            response[0].month + '-' +
                            response[0].day + ' -- ' +
                            response[0].start_time.substring(0,5) + '-' +
                            response[response.length - 1].finish_time.substring(0,5)
                        );
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("Status: " + textStatus);
                        alert("Error: " + errorThrown);
                    }
                });

                if(!$('#time_options_div').hasClass('d-none'))
                {
                    $('#time_options_div').addClass('d-none');
                }
            });

            //ajax for all available time slots
            $('#custom_time').click(function () {

                let servicesId = '';

                $('input[name="services[]"]:checked').each(function () {

                    servicesId += $(this).val() + ' ';
                });

                $.ajax({
                    url: "/api/times/index?service_id=" + servicesId,
                    type: "GET",
                    dataType: 'json',
                    success: function (response) {

                        if(response.error)
                        {
                            alert(response.error);
                        }

                        let html = '<div id="time_options">'

                        let i = 1;

                        for(let timeSlots of response )
                        {
                            let timesId = '';

                            for(let timeSlot of timeSlots)
                            {
                                timesId+= timeSlot.id + ',';

                            }

                            html += '<input type="radio" class="form-check-input my-2" name="time" id="timeSlot-' + i + '"' + 'value="' + timesId + '" required="required" />';
                            html += '<label class="form-check-label d-block my-3" for="timeSlot-' + i + '">';
                            html += timeSlots[0].year + '-' +
                                timeSlots[0].month + '-' +
                                timeSlots[0].day + ' -- ' +
                                timeSlots[0].start_time.substring(0,5) + '-' +
                                timeSlots[timeSlots.length - 1].finish_time.substring(0,5);
                            html += '</label>';

                            i++;
                        }

                        html += '</div>';

                        $('#time_options').remove();

                        $('#time_options_div').append(html);

                        $('#time_options_div').removeClass('d-none');
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("Status: " + textStatus);
                        alert("Error: " + errorThrown);
                    }
                });
            });
        </script>
    @endsection
