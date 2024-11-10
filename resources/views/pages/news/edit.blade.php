<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit News') }}
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
                    <form action={{ route('dashboard.news.update', $news) }} method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="input-cluster">
                            {{-- name --}}
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">News's title</span>
                                </div>
                                <input type="text" name="title" placeholder="Type the New's title here"
                                    class="w-full input input-bordered" value="{{ old('title', $news->title) }}" />
                                @error('title')
                                    <div class="label error">
                                        <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>

                            {{-- img --}}
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">News's Thumbnail</span>
                                </div>
                                <input type="file" name="img" class="w-full file-input file-input-bordered"
                                    accept="image/*" />
                                @error('img')
                                    <div class="label error">
                                        <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>


                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">Read time</span>
                                </div>
                                <input type="text" name="read_time" placeholder="Read time in minutes"
                                    class="w-full input input-bordered"
                                    value="{{ old('read_time', $news->read_time) }}" />
                                @error('read_time')
                                    <div class="label error">
                                        <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>



                        </div>




                        <label class="form-control">
                            <div class="label">
                                <span class="label-text">News's Body</span>
                            </div>
                            <textarea name="body" class="h-80 textarea textarea-bordered" placeholder="Type news's body here">{{ old('body', $news->body) }}</textarea>
                            @error('body')
                                <div class="label error">
                                    <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                </div>
                            @enderror
                        </label>


                        <label class="form-control">
                            <div class="label">
                                <span class="label-text">Choose The Categories</span>
                            </div>
                            <div class="flex flex-wrap">
                                @foreach ($news->categories as $category)
                                    <label class="relative w-56 h-20 m-2 cursor-pointer">
                                        <input type="checkbox" 
                                               name="categories[]" 
                                               value="{{ $category->id }}"
                                               class="absolute opacity-0 peer"
                                               {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                        <div class="relative overflow-hidden transition-all duration-500 bg-center bg-cover drop-shadow-lg hover:drop-shadow-2xl rounded-2xl group hover:scale-105 peer-checked:ring-4 peer-checked:ring-blue-500 peer-checked:scale-105"
                                             style="background-image: url({{ $category->img }})">
                                            <div class="z-10 flex items-center justify-center w-full h-20 text-white duration-500 bg-black bg-opacity-30 backdrop-blur-sm group-hover:backdrop-blur-none peer-checked:bg-opacity-50 peer-checked:backdrop-blur-none">
                                                <h1 class="title">{{ $category->title }}</h1>
                                            </div>
                                            <!-- Indikator terpilih -->
                                            <div class="absolute hidden peer-checked:block top-2 right-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </label>


                        <button class="mt-8 text-xl min-w-lg main-button" type="submit">Update News</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
