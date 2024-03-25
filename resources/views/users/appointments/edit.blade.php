@extends('layouts.main')

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
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $appointment->user->name }}" disabled>
                                @error('name')
                                <span class="d-block text-danger pl-3"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{ $appointment->user->phone }}" disabled>
                                @error('phone')
                                <span class="d-block text-danger pl-3"> {{ $message }} </span>
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
                                <span class="d-block text-danger pl-3"> {{ $message }} </span>
                                @enderror

                                @error('services.*')
                                <span class="d-block text-danger pl-3"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="form-group border rounded p-3">
                                <label for="time">Time</label>
                                <div class="row">
                                    <div class="col-9 ml-3">
                                        <input type="radio" class="form-check-input" name="time" id="selected_time"
                                               value="{{ $selectedTimeValues }}" required="required" />
                                        <label class="form-check-label d-block" for="selected_time">
                                            {{ $appointment->times[0]->date_time . ' - ' .
                                            substr($appointment->times[count($appointment->times) - 1]->finish_time, 0, 5)
                                               }}
                                            </label>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" id="change_time_btn" class="btn btn-custom">Change</button>
                                        </div>
                                        @error('time')
                                        <span class="d-block text-danger pl-3"> {{ $message }} </span>
                                        @enderror

                                        @error('time.*')
                                        <span class="d-block text-danger pl-3"> {{ $message }} </span>
                                        @enderror
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
                                    </div>

                                    <div id="time_options_div" class="control-group ml-3 border rounded p-3 d-none">
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="tracking_code">Tracking Code</label>
                                    <input type="text" class="form-control" name="tracking_code" id="tracking_code" value="{{ $appointment->tracking_code }}" disabled>
                                    @error('tracking_code')
                                    <span class="d-block text-danger pl-3"> {{ $message }} </span>
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

        <script src="{{ asset('js/time-ajax.js') }}"></script>

        <script>

            $('#change_time_btn').click(function () {

                $('#change_time_options').removeClass('d-none');
            });

            setTimeout(function () {
                $('#transaction_error').toggleClass('d-none');
            }, 4000);

            //disable the old selected time when user change the service
            $('input[name="services[]"]').change(function () {

                $('#selected_time').prop('disabled', true);

                $('#change_time_options').removeClass('d-none');
            });

        </script>
    @endsection
