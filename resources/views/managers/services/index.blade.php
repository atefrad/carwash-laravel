<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight m-5">
                {{ __('Services') }}
            </h2>

            @if(session('success'))
                <div class="flash_success_message">
                    <div role="alert" class="bg-green-200 border border-green-600 rounded-md p-4 text-green-700">
                        <h4>{{ session('success') }}</h4>
                    </div>
                </div>
            @endif

            <div class="mt-3">
                <a class="inline-flex items-center px-4 py-3 bg-cyan-600 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-cyan-500 dark:hover:bg-white focus:bg-cyan-800 dark:focus:bg-white active:bg-cyan-700 dark:active:bg-cyan-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" href="{{ route('managers.services.create') }}">
                    Create New Service
                </a>
            </div>
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
                                <th class="p-4">Duration</th>
                                <th class="p-4">Price</th>
                                <th class="p-4">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @forelse($services as $service)
                            <tr class="border border-slate-300 hover:bg-gray-100">
                                <td class="p-4 text-center">
                                    {{ $count }}
                                </td>
                                <td class="p-4 text-center">
                                    {{ $service->name }}
                                </td>
                                <td class="p-4 text-center">
                                    {{ $service->duration }}
                                </td>
                                <td class="p-4 text-center">
                                    {{ $service->price }}
                                </td>
                                <td class="p-4 text-center">
                                    <a class="inline-flex items-center px-4 py-2 bg-green-700 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-500 dark:hover:bg-white focus:bg-green-900 dark:focus:bg-white active:bg-green-800 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                       href="{{ route('managers.services.edit', $service) }}">
                                        Edit
                                    </a>
                                    <form class="inline" action="{{ route('managers.services.destroy', $service) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this service?')" class="inline-flex items-center mx-2 px-4 py-2 bg-red-600 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-red-500 dark:hover:bg-white focus:bg-red-800 dark:focus:bg-white active:bg-red-700 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @php $count++ @endphp
                        @empty
                            <tr class="border border-slate-300 hover:bg-gray-100">
                                <td colspan="7" class="text-center p-4">
                                    No Services Yet!
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

        <script>
            setTimeout(function () {

                $('.flash_success_message').addClass('hidden');

            }, 3000);
        </script>

    </x-slot>

</x-app-layout>
