<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-blue-500">
            {{ __('Create Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-2xl">
                <div class="p-8 text-gray-900">
                    <a class="secondary-button" href="{{ route('dashboard.events') }}">
                        <x-heroicon-o-arrow-left class="w-5" />
                        Back
                    </a>
                    <form action="{{ route('dashboard.events.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf

                        {{-- Event Name --}}
                        <div class="w-full">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Event's Name</label>
                            <input type="text" name="name" id="name" placeholder="Type here"
                                class="w-full input input-bordered" value="{{ old('name') }}" />
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Event Description --}}
                        <div class="w-full">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Event Description</label>
                            <textarea name="description" id="description" placeholder="Describe the event"
                                class="w-full input input-bordered h-24" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Event Date --}}
                        <div class="w-full">
                            <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Event Date</label>
                            <input type="date" name="date" id="date" class="w-full input input-bordered" value="{{ old('date') }}" />
                            @error('date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Event Logo --}}
                        <div class="w-full">
                            <label for="img" class="block text-sm font-medium text-gray-700 mb-2">Event's Logo</label>
                            <input type="file" name="img" id="img" class="w-full file-input file-input-bordered" accept="image/*" />
                            @error('img')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="px-6 py-2 text-white bg-blue-600 hover:bg-blue-500 rounded-lg main-button">Submit News</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
