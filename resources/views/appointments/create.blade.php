@extends('layouts.main')

@section('content')

{{--    @if($errors->any())--}}
{{--        @foreach($errors->all() as $error)--}}
{{--            {{ $error }}--}}
{{--        @endforeach--}}
{{--    @endif--}}

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
                                <span class="d-block text-dark"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control" name="phone" placeholder="Phone" required="required" value="{{ old('phone') }}" />
                                @error('phone')
                                <span class="d-block text-dark"> {{ $message }} </span>
                                @enderror
                            </div>
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

                            <div id="time_options_div" class="control-group ml-3">
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
    <script>
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
                        html += '<label class="form-check-label d-block text-light my-3" for="timeSlot-' + i + '">';
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
