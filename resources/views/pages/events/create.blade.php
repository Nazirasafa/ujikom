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
                    <form action="{{ route('dashboard.events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="input-cluster">
                            {{-- name --}}
                            <label class="w-full max-w-xs form-control">
                                <div class="label">
                                    <span class="label-text">Event's Name</span>
                                </div>
                                <input type="text" name="name" placeholder="Type here"
                                    class="w-full max-w-xs input input-bordered" 
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <div class="label error">
                                        <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>

                            {{-- short desc --}}
                            <label class="w-full max-w-xs form-control">
                                <div class="label">
                                    <span class="label-text">Short Description</span>
                                </div>
                                <input type="text" name="short_desc" placeholder="Summarize the event's here"
                                    class="w-full max-w-xs input input-bordered"
                                    value="{{ old('short_desc') }}" />
                                @error('short_desc')
                                    <div class="label error">
                                        <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>

                        {{-- desc --}}
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text">Full Description</span>
                            </div>
                            <textarea name="desc" class="h-24 textarea textarea-bordered" 
                                placeholder="Type event's description here">{{ old('desc') }}</textarea>
                            @error('desc')
                                <div class="label error">
                                    <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                </div>
                            @enderror
                        </label>

                        <div class="input-cluster">
                            {{-- img --}}
                            <label class="w-full max-w-xs form-control">
                                <div class="label">
                                    <span class="label-text">Event's logo</span>
                                </div>
                                <input type="file" name="img"
                                    class="w-full max-w-xs file-input file-input-bordered"
                                    accept="image/*" />
                                @error('img')
                                    <div class="label error">
                                        <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>

                            {{-- social media --}}
                            <label class="w-full max-w-xs form-control">
                                <div class="label">
                                    <span class="label-text">Social media</span>
                                </div>
                                <input type="text" name="social_media"
                                    placeholder="Paste your social media profile link here"
                                    class="w-full max-w-xs input input-bordered"
                                    value="{{ old('social_media') }}" />
                                @error('social_media')
                                    <div class="label error">
                                        <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>

                        {{-- time --}}
                        <div class="input-cluster">
                            {{-- date --}}
                            <label class="w-full max-w-xs form-control">
                                <div class="label">
                                    <span class="label-text">Event's date</span>
                                </div>
                                <input name="date" type="date"
                                    class="w-full max-w-xs text-neutral-500 input input-bordered"
                                    value="{{ old('date') }}" />
                                @error('date')
                                    <div class="label error">
                                        <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                            <label class="w-full max-w-xs form-control without-label">
                                <input name="time_start" type="text" placeholder="Time Start (ex. 10)"
                                    class="w-full max-w-xs input input-bordered"
                                    value="{{ old('time_start') }}" />
                                @error('time_start')
                                    <div class="label error">
                                        <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>

                            <label class="w-full max-w-xs form-control without-label">
                                <input name="time_end" type="text" placeholder="Time End (ex. 14)"
                                    class="w-full max-w-xs input input-bordered"
                                    value="{{ old('time_end') }}" />
                                @error('time_end')
                                    <div class="label error">
                                        <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>

                        <button class="mt-8 text-xl min-w-lg main-button" type="submit">Submit Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>