@extends('layouts.main')

@section('content')

    @if(session('status'))
        <div id="flash_success_message" class="position-absolute alert alert-success w-25 text-center">
            <p><strong>{{ session('status') }}</strong></p>
        </div>
    @endif

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Edit Profile</h2>
                </div>
                <div class="col-12">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('users.show', $user) }}">Profile</a>
                    <a href="{{ route('users.edit', $user) }}">Edit</a>
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
                        <p>Profile</p>
                        <h2 class="font-size-40px">Edit your profile</h2>
                    </div>

{{--                    profile's edit form--}}
                    <div class="location-form edit_profile_form bg-main">
                        <h3>Profile's Information</h3>
                        <form action="{{ route('users.update', $user) }}" method="POST">

                            @csrf
                            @method('PUT')

                            <div class="control-group">
                                <div>

                                </div>
                                <label class="text-white" for="name">Name: </label>
                                <input type="text" class="form-control" name="name" placeholder="Name" required="required" value="{{ $user->name }}" />
                                @error('name')
                                <span class="d-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="control-group">
                                <label class="text-white" for="phone">Phone: </label>
                                <input type="text" class="form-control" name="phone" placeholder="Phone" required="required" value="{{ $user->phone }}" />
                                @error('phone')
                                <span class="d-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="control-group">
                                <label class="text-white" for="email">Email: </label>
                                <input type="email" class="form-control" name="email" placeholder="Email" required="required" value="{{ $user->email }}" />
                                @error('email')
                                <span class="d-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div>
                                <button class="btn btn-custom" type="submit">Update</button>
                            </div>
                        </form>
                    </div>

{{--                    password's edit form--}}
                    <div class="location-form bg-main edit_profile_form mt-5">
                        <h3>Update Password</h3>
                        <form action="{{ route('password.update') }}" method="POST">

                            @csrf
                            @method('PUT')

                            <div class="control-group">
                                <div>

                                </div>
                                <label class="text-white" for="current_password">Current Password: </label>
                                <input type="password" class="form-control" name="current_password" required="required" />
                                @error('current_password')
                                <span class="d-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="control-group">
                                <label class="text-white" for="phone">New Password: </label>
                                <input type="password" class="form-control" name="password" required="required"/>
                                @error('password')
                                <span class="d-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="control-group">
                                <label class="text-white" for="password_confirmation">Confirm Password: </label>
                                <input type="password" class="form-control" name="password_confirmation" required="required"/>
                                @error('password_confirmation')
                                <span class="d-block text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div>
                                <button class="btn btn-custom" type="submit">Update</button>
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
        setTimeout(function () {
            $('#flash_success_message').toggleClass('d-none');
        }, 4000);
    </script>
@endsection
