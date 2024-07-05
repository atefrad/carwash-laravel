@extends('layouts.main')

@section('head-tag')
    <title>Show profile</title>
@endsection

@section('content')

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Profile's Detail</h2>
                </div>
                <div class="col-12">
                    <a href="">Home</a>
                    <a href="">Profile</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container">
        <h3 class="text-center m-5">Profile's Detail</h3>
        <div class="table-responsive col-6 offset-3">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th class="p-4">Name :</th>
                    <td class="p-4">{{ $user->name }}</td>
                </tr>
                <tr>
                    <th class="p-4">Phone :</th>
                    <td class="p-4">{{ $user->phone }}</td>
                </tr>
                <tr>
                    <th class="p-4">Email :</th>
                    <td class="p-4">
                        {{ $user->email }}
                    </td>
                </tr>

                <tr>
                    <th class="p-4">Operations :</th>
                    <td class="p-4">
                        <a id="edit_btn" class="btn btn-info text-white" href="{{ route('users.edit', $user) }}">Edit Profile</a>
                        <form class="d-inline" action="{{ route('users.destroy', $user) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button id="delete_btn" class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete your account?')">Delete User</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>

@endsection
