
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create News') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-2xl">
                <div class="p-6 text-gray-900">
                    <a class="secondary-button" href="{{ route('dashboard.news') }}">
                        <x-heroicon-o-arrow-left class="w-5" />
                        Back
                    </a>
                    <form action={{ route('dashboard.news.store') }} method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="input-cluster">
                            {{-- name --}}
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">News Title</span>
                                </div>
                                <input type="text" name="title" placeholder="Type the news title here"
                                    class="w-full input input-bordered" 
                                    value="{{ old('title') }}" required/>
                                @error('title')
                                    <div class="label error">
                                        <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>

                            {{-- read time --}}
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">Read Time</span>
                                </div>
                                <input type="number" name="read_time" placeholder="Time needed to read this news in minutes (ex. 5)"
                                    class="w-full input input-bordered"
                                    value="{{ old('read_time') }}" required/>
                                @error('read_time')
                                    <div class="label error">
                                        <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>

                        {{-- desc --}}
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text">News Body</span>
                            </div>
                            <textarea name="body" class="h-24 textarea textarea-bordered" 
                                placeholder="Type the news here" required>{{ old('body') }}</textarea>
                            @error('body')
                                <div class="label error">
                                    <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                </div>
                            @enderror
                        </label>

                        <div class="input-cluster">
                            {{-- img --}}
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">News Thumbnail</span>
                                </div>
                                <input type="file" name="img"
                                    class="w-full file-input file-input-bordered"
                                    accept="image/*" required/>
                                @error('img')
                                    <div class="label error">
                                        <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>

                        <button class="mt-8 text-xl min-w-lg main-button" type="submit">Submit News</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
