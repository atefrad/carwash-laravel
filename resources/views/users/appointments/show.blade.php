@extends('layouts.main')

@section('content')
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Appointment's Detail</h2>
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
        <h3 class="text-center m-5">Appointment's Detail</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th>Name :</th>
                    <td>{{ $appointment->user->name }}</td>
                </tr>
                <tr>
                    <th>Phone :</th>
                    <td>{{ $appointment->user->phone }}</td>
                </tr>
                <tr>
                    <th>Services :</th>
                    <td>
                        <ul class="list-unstyled">
                            @foreach($appointment->services as $service)
                                <li>{{ $service->name }}</li>
                            @endforeach
                        </ul>

                    </td>
                </tr>
                <tr>
                    <th>Price :</th>
                    <td>
                        {{ $appointment->total_price }}
                    </td>
                </tr>
                <tr>
                    <th>Time :</th>
                    <td>{{ $appointment->times[0]->year . '-' .
                           $appointment->times[0]->month . '-' .
                           $appointment->times[0]->day . ' ' .
                           substr($appointment->times[0]->start_time, 0, 5) }}
                    </td>
                </tr>
                <tr>
                    <th>Tracking Code :</th>
                    <td>{{ $appointment->tracking_code }}</td>
                </tr>
                <tr>
                    <th>Operations :</th>
                    <td>
                        <a id="edit_btn" class="btn btn-info text-white" href="{{ route('appointments.edit', $appointment) }}">Edit Appointment</a>
                        <form class="d-inline" action="{{ route('appointments.destroy', $appointment) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button id="delete_btn" class="btn btn-danger" type="submit">Cancel Appointment</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>

@endsection
@section('script')
    <script>
    const appointmentDay = {{ $appointment->times[0]->day }};

    const currentDate = new Date().getDate();

    if(appointmentDay <= currentDate)
    {
        const editBtn =  $('#edit_btn');

        $('#delete_btn').attr("disabled", true);
        editBtn.removeAttr('href');

        editBtn.click(function (e) {
            alert("You can only edit your appointment until one day before it!");
        });
    }

    </script>
@endsection

