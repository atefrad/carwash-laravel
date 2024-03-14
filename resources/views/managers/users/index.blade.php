<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight m-5">
                {{ __('Users') }}
            </h2>
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
                                <th class="p-4">Email</th>
                                <th class="p-4">Total Payments</th>
                                <th class="p-4">Last Use Of The Services</th>
                                <th class="p-4">Activity Level</th>
                                <th class="p-4">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $count = 1;@endphp
                        @forelse($users as $user)
                            <tr class="border border-slate-300 hover:bg-gray-100">
                                <td class="p-4 text-center">
                                    {{ $count }}
                                </td>
                                <td class="p-4 text-center">
                                    {{ $user->name }}
                                </td>
                                <td class="p-4 text-center">
                                    {{ $user->phone }}
                                </td>
                                <td class="p-4 text-center">
                                    {{ $user->email }}
                                </td>
                                <td class="p-4 text-center start_time_td">
                                    {{ $user->total_payments }}
                                    <span><small>Tomans</small></span>
                                </td>
                                <td class="p-4 text-center">
                                    {{ $user->last_use }}
                                </td>
                                <td class="p-4 text-center bg-opacity-90 text-white
                                @if($user->activity <= 1)
                                    {{ "bg-red-500" }}
                                @elseif($user->activity >= 2 && $user->activity <= 5)
                                    {{ "bg-orange-500" }}
                                @elseif($user->activity > 5)
                                    {{ "bg-green-500" }}
                                @endif">
                                    {{ $user->activity }}
                                </td>
                                <td class="p-4 text-center">
                                    <a class="inline-flex items-center px-4 py-2 bg-green-700 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-500 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-green-900 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                       href="{{ route('managers.appointments.index', ['user' => $user->id]) }}">
                                        Details
                                    </a>
                                </td>
                            </tr>
                            @php $count++ @endphp
                        @empty
                            <tr class="border border-slate-300 hover:bg-gray-100">
                                <td colspan="7" class="text-center p-4">
                                    No Users Yet!
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
