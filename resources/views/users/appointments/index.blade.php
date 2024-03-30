@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="table-responsive mt-5">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Services</th>
                        <th>Start Time</th>
                        <th>Total Price</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 1;
                        $today = \Carbon\Carbon::now()->day;
                    @endphp
                @forelse($appointments as $appointment)
                    <tr>
                        <td class="p-4 text-center">
                            {{ $count }}
                        </td>
                        <td class="p-4 text-center">
                            @foreach($appointment->services as $service)
                                @if($loop->last)
                                    {{ $service->name }}
                                @else
                                    {{ $service->name . ' - ' }}
                                @endif

                            @endforeach
                        </td>
                        <td class="p-4 text-center start_time_td">
                            {{
                                $appointment->times[0]->date_time
                            }}
                        </td>
                        <td class="p-4 text-center">
                            {{ $appointment->total_price }}
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('appointments.show', $appointment) }}">Show</a>
                            <a class="appointment_edit btn btn-success
                               @if($appointment->times[0]->day <= $today)
                                   {{ "disabled" }}
                               @endif"
                               href="{{ route('appointments.edit', $appointment) }}">Edit</a>
                            <form class="d-inline" action="{{ route('appointments.destroy', $appointment) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                @if($appointment->times[0]->day <= $today)
                                    {{ "disabled=disabled" }}@endif
                                onclick="return confirm('Are you sure you want to cancel this appointment?')">Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    @php $count++ @endphp
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center">
                            No Appointments Yet!
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
                <div class="mt-4">
                    {{ $appointments->links('vendor.pagination.bootstrap-4') }}
                </div>
        </div>
    </div>
@endsection

@section('script')
{{--    <script>--}}
{{--        $('.appointment_edit').on('click', function(e) {--}}
{{--            if($(this).hasClass('disabled'))--}}
{{--            {--}}
{{--                e.preventDefault();--}}
{{--                $(this).removeAttr('href');--}}
{{--                if(!$(this).hasClass('text-white'))--}}
{{--                {--}}
{{--                    $(this).addClass('text-white');--}}
{{--                }--}}
{{--                alert('You can only edit your appointment until the day before the appointment!');--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
@endsection
