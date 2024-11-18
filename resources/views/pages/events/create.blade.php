<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-2xl">
                <div class="p-6 text-gray-900">
                    <a class="secondary-button" href="{{ route('dashboard.events') }}">
                        <x-heroicon-o-arrow-left class="w-5" />
                        Back
                    </a>
                    <form action="{{ route('dashboard.events.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf

                        {{-- Event Name --}}
                        <div class="w-full">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Event's Name</label>
                            <input type="text" name="name" id="name" placeholder="Type here"
                                class="w-full input input-bordered" value="{{ old('name') }}" />
                            @error('name')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Short Description --}}
                        <div class="w-full">
                            <label for="short_desc" class="block mb-2 text-sm font-medium text-gray-700">Short Description</label>
                            <input type="text" name="short_desc" id="short_desc" placeholder="Summarize the event's here"
                                class="w-full input input-bordered" value="{{ old('short_desc') }}" />
                            @error('short_desc')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Full Description --}}
                        <div class="w-full">
                            <label for="desc" class="block mb-2 text-sm font-medium text-gray-700">Full Description</label>
                            <textarea name="desc" id="desc" class="w-full h-24 textarea textarea-bordered" 
                                placeholder="Type event's description here">{{ old('desc') }}</textarea>
                            @error('desc')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Event Date --}}
                        <div class="w-full">
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-700">Event Date</label>
                            <input name="date" type="date" id="date"
                                class="w-full text-neutral-500 input input-bordered" value="{{ old('date') }}" />
                            @error('date')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Social Media --}}
                        <div class="w-full">
                            <label for="social_media" class="block mb-2 text-sm font-medium text-gray-700">Social Media</label>
                            <input type="text" name="social_media" id="social_media"
                                placeholder="Paste your social media profile link here"
                                class="w-full input input-bordered" value="{{ old('social_media') }}" />
                            @error('social_media')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                          {{-- Time Start --}}
                          <div class="w-full">
                            <label for="time_start" class="block text-sm font-medium text-gray-700">Time Start</label>
                            <input type="text" name="time_start" id="time_start" placeholder="Time Start"
                                class="w-full mt-1 input input-bordered"
                                value="{{ old('time_start' ) }}" />
                            @error('time_start')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Time End --}}
                        <div class="w-full">
                            <label for="time_end" class="block text-sm font-medium text-gray-700">Time End</label>
                            <input type="text" name="time_end" id="time_end" placeholder="Time End"
                                class="w-full mt-1 input input-bordered"
                                value="{{ old('time_end' ) }}" />
                            @error('time_end')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        
                    
                    

                        {{-- Event Logo --}}
                        <div class="w-full">
                            <label for="img" class="block mb-2 text-sm font-medium text-gray-700">Event's Logo</label>
                            <input type="file" name="img" id="img" class="w-full file-input file-input-bordered" accept="image/*" />
                            @error('img')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg main-button">Submit Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
