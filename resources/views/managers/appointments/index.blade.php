<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight m-5">
                {{ __('Appointments') }}
            </h2>
            <form class="flex" action="{{ route('managers.appointments.index') }}">
                <h2 class="m-5">Filter by</h2>
                <div class="flex items-center pe-2">
                    <select name="service"  class="w-52 px-3 block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600">
                        <option value="" selected disabled>Service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center pe-2">
                    <input type="text" name="time" id="time" class="w-52 px-3 block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" placeholder="Date" onfocus="(this.type='date')">
                </div>
                <div class="flex items-center pe-2">
                    <x-primary-button>Filter</x-primary-button>
                </div>
            </form>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full border border-collapse border-slate-400">
                        <thead>
                            <tr class="border border-slate-300 bg-gray-300">
                                <th class="p-4">#</th>
                                <th class="p-4">Name</th>
                                <th class="p-4">Phone</th>
                                <th class="p-4">Services</th>
                                <th class="p-4">Start Time</th>
                                <th class="p-4">Tracking code</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $count = 1;
                            $today = \Carbon\Carbon::now()->day;
                        @endphp
                        @forelse($appointments as $appointment)
                            <tr class="border border-slate-300 hover:bg-gray-100">
                                <td class="p-4 text-center">
                                    {{ $count }}
                                </td>
                                <td class="p-4 text-center">
                                    {{ $appointment->user->name }}
                                </td>
                                <td class="p-4 text-center">
                                    {{ $appointment->user->phone }}
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
                                    {{ $appointment->tracking_code }}
                                </td>
                            </tr>

                            @php $count++ @endphp
                        @empty
                            <tr class="border border-slate-300 hover:bg-gray-100">
                                <td colspan="7" class="text-center p-4">
                                    No Appointments Yet!
                                </td>
                            </tr>

                        @endforelse
                        <tr class="border border-slate-300 bg-gray-300">
                            <th class="p-4">Total Count</th>
                            <td colspan="6" class="text-center p-4">{{ $totalCount }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $appointments->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script>
            $('.appointment_edit').on('click', function(e) {
                   if($(this).hasClass('cursor-not-allowed'))
                   {
                       e.preventDefault();
                       $(this).removeAttr('href');
                       alert('You can only edit your appointment until the day before the appointment!');
                   }
            });
        </script>
    </x-slot>
</x-app-layout>
