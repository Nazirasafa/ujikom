<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit News') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-2xl">
                <div class="p-8 text-gray-900">
                    <a class="mb-4 secondary-button" href="{{ route('dashboard.news') }}">
                        <x-heroicon-o-arrow-left class="w-5" />
                        Back
                    </a>
                    <form action="{{ route('dashboard.news.update', $news) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- News Title --}}
                        <div class="w-full">
                            <label for="title" class="block text-sm font-medium text-gray-700">News Title</label>
                            <input type="text" name="title" id="title" placeholder="Type the News title here"
                                class="w-full mt-1 input input-bordered" value="{{ old('title', $news->title) }}" />
                            @error('title')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- News Thumbnail --}}
                        <div class="w-full">
                            <label for="img" class="block text-sm font-medium text-gray-700">News Thumbnail</label>
                            <input type="file" name="img" id="img" class="w-full mt-1 file-input file-input-bordered"
                                accept="image/*" />
                            @error('img')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Read Time --}}
                        <div class="w-full">
                            <label for="read_time" class="block text-sm font-medium text-gray-700">Read Time</label>
                            <input type="text" name="read_time" id="read_time" placeholder="Read time in minutes"
                                class="w-full mt-1 input input-bordered" value="{{ old('read_time', $news->read_time) }}" />
                            @error('read_time')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- News Body --}}
                        <div class="w-full">
                            <label for="body" class="block text-sm font-medium text-gray-700">News Body</label>
                            <textarea name="body" id="body" class="w-full mt-1 h-80 textarea textarea-bordered" placeholder="Type news body here">{{ old('body', $news->body) }}</textarea>
                            @error('body')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" class="w-full px-4 py-2 text-white transition duration-150 bg-blue-400 rounded-lg hover:bg-blue-500">Update News</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
