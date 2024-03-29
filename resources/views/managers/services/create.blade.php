<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight m-5">
                {{ __('Create New Service') }}
            </h2>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg sm:w-3/4 md:w-1/2 mx-auto">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        <h2 class="mb-3 text-center text-gray-700 font-bold">Create New Service</h2>
                        <form action="{{ route('managers.services.store') }}" method="POST">

                            @csrf

                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name: </label>
                                <input class="block shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name') }}" type="text" name="name" id="name">

                                @error('name')
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="duration">Duration: </label>
                                <select class="block shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="duration" id="duration">
                                    <option value="" selected disabled>Please select the duration of the service.</option>

                                    @for($i = 1; $i <= 10; $i++)

                                        @php $duration = $timeSlotDuration * $i; @endphp

                                        <option value="{{ $duration }}" @if(old('duration') === $duration) {{ 'selected' }} @endif>{{ $duration }} minutes</option>

                                    @endfor

                                </select>

                                @error('duration')
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Price: </label>
                                <input class="block shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('price') }}" type="text" name="price" id="price">

                                @error('price')
                                <span class="text-red-700 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 focus:bg-indigo-900 py-2 px-3 border-transparent rounded text-white uppercase text-xs font-semibold border border-transparent focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

