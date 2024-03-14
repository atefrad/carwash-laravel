<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full border border-collapse border-slate-400">
                        <thead>
                            <tr class="border border-slate-300 bg-gray-300">
                                <th class="p-4">#</th>
                                <th class="p-4">Services</th>
                                <th class="p-4">Start Time</th>
                                <th class="p-4">Total Price</th>
                                <th class="p-4">Operations</th>
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
                                <td class="p-4 text-center operation_td">
                                    <a class="inline-flex items-center px-4 py-2 bg-green-700 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-500 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-green-900 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                       href="{{ route('appointments.show', $appointment) }}">
                                        Show
                                    </a>
                                    <a class="appointment_edit inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150
                                        @if($appointment->times[0]->day <= $today)
                                            {{ "cursor-not-allowed" }}
                                        @endif"
                                       href="{{ route('appointments.edit', $appointment) }}">
                                        Edit
                                    </a>
                                    <form class="inline" action="{{ route('appointments.destroy', $appointment) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150
                                        @if($appointment->times[0]->day <= $today)
                                            {{ "cursor-not-allowed" }}
                                        @endif"
                                        @if($appointment->times[0]->day <= $today)
                                            {{ "disabled" }}
                                        @endif
                                        >Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            @php $count++ @endphp
                        @empty
                            <tr class="border border-slate-300 bg-gray-300">
                                <td colspan="4" class="p-4 text-center">
                                    No Appointments Yet!
                                </td>
                            </tr>

                        @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $appointments->links() }}
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
