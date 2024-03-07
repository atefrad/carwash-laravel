@extends('layouts.main')

@section('content')

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Track Appointment</h2>
                </div>
                <div class="col-12">
                    <a href="">Home</a>
                    <a href="">Tracking</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="single">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <section id="flash-message" class="alert alert-danger p-4 mt-4 d-none" role="alert">
                        @if(session('error'))
                            {{ session('error') }}
                        @endif
                    </section>
                    <div class="comment-form">
                        <h2 class="text-center">Track Your Appointment</h2>
                        <form action="{{ route('trackAppointment.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="phone">Phone *</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
                                @error('phone')
                                <span class="d-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tracking_code">Tracking Code *</label>
                                <input type="text" class="form-control" name="tracking_code" id="tracking_code" value="{{ old('tracking_code') }}">
                                @error('tracking_code')
                                <span class="d-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Submit" class="btn btn-custom">
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
        @if(session('error'))
        $('#flash-message').removeClass('d-none')

        setTimeout(function () {
            $('#flash-message').addClass('d-none');
        }, 5000)
        @endif
    </script>
@endsection
