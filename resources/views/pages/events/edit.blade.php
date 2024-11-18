<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-2xl">
                <div class="p-8 text-gray-900">
                    <a class="mb-4 secondary-button" href="{{ route('dashboard.events') }}">
                        <x-heroicon-o-arrow-left class="w-5" />
                        Back
                    </a>
                    <form action="{{ route('dashboard.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Event Name --}}
                        <div class="w-full">
                            <label for="name" class="block text-sm font-medium text-gray-700">Event's Name</label>
                            <input type="text" name="name" id="name" placeholder="Type here"
                                class="w-full mt-1 input input-bordered"
                                value="{{ old('name', $event->name) }}" />
                            @error('name')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Short Description --}}
                        <div class="w-full">
                            <label for="short_desc" class="block text-sm font-medium text-gray-700">Short Description</label>
                            <input type="text" name="short_desc" id="short_desc" placeholder="Summarize the event's here"
                                class="w-full mt-1 input input-bordered"
                                value="{{ old('short_desc', $event->short_desc) }}" />
                            @error('short_desc')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Full Description --}}
                        <div class="w-full">
                            <label for="desc" class="block text-sm font-medium text-gray-700">Full Description</label>
                            <textarea name="desc" id="desc" class="w-full h-24 mt-1 textarea textarea-bordered"
                                placeholder="Type event's description here">{{ old('desc', $event->desc) }}</textarea>
                            @error('desc')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Social Media --}}
                        <div class="w-full">
                            <label for="social_media" class="block text-sm font-medium text-gray-700">Social Media</label>
                            <input type="text" name="social_media" id="social_media" placeholder="Paste your social media profile link here"
                                class="w-full mt-1 input input-bordered"
                                value="{{ old('social_media', $event->social_media) }}" />
                            @error('social_media')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                            
                   
                        
                        {{-- Event Date --}}
                        <div class="w-full">
                            <label for="date" class="block text-sm font-medium text-gray-700">Event's Date</label>
                            <input name="date" id="date" type="date" class="w-full mt-1 input input-bordered text-neutral-500"
                                value="{{ old('date', $event->date) }}" />
                            @error('date')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                          {{-- Time Start --}}
                          <div class="w-full">
                            <label for="time_start" class="block text-sm font-medium text-gray-700">Time Start</label>
                            <input type="text" name="time_start" id="time_start" placeholder="Paste your social media profile link here"
                                class="w-full mt-1 input input-bordered"
                                value="{{ old('time_start', $event->time_start ) }}" />
                            @error('time_start')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Time End --}}
                        <div class="w-full">
                            <label for="time_end" class="block text-sm font-medium text-gray-700">Time End</label>
                            <input type="text" name="time_end" id="time_end" placeholder="Paste your social media profile link here"
                                class="w-full mt-1 input input-bordered"
                                value="{{ old('time_end', $event->time_end ) }}" />
                            @error('time_end')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        
                    
                    

                        {{-- Event's Logo --}}
                        <div class="w-full">
                            <label for="img" class="block text-sm font-medium text-gray-700">Event's Logo</label>
                            <input type="file" name="img" id="img" class="w-full mt-1 file-input file-input-bordered"
                                accept="image/*" />
                            @error('img')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" class="w-full px-4 py-2 text-white transition duration-150 bg-blue-400 rounded-lg hover:bg-blue-500">Update Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
