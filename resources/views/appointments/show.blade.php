@extends('layouts.main')

@section('content')
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Appointment's Factor</h2>
                </div>
                <div class="col-12">
                    <a href="">Home</a>
                    <a href="">Show</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container">
        <h3 class="text-center m-5">Appointment's Factor</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th>Name :</th>
                    <td>{{ $appointment->name }}</td>
                </tr>
                <tr>
                    <th>Phone :</th>
                    <td>{{ $appointment->phone }}</td>
                </tr>
                <tr>
                    <th>Service :</th>
                    <td>{{ $appointment->service->name }}</td>
                </tr>
                <tr>
                    <th>Price :</th>
                    <td>{{ $appointment->service->price }}</td>
                </tr>
                <tr>
                    <th>Time :</th>
                    <td>{{ $appointment->start_time }}</td>
                </tr>
                <tr>
                    <th>Station :</th>
                    <td>{{ $appointment->station }}</td>
                </tr>
                <tr>
                    <th>Tracking Code :</th>
                    <td>{{ $appointment->tracking_code }}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection

