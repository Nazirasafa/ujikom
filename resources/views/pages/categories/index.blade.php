<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-semibold leading-tight text-gray-800">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    @if ($categories->isNotEmpty())
        <div class="pb-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col items-center p-6 text-gray-900">
                    @if (session('success'))
                        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-2xl">
                            {{ session('success') }}
                        </div>
                    @endif

                    <button onclick="add_category_modal.showModal()" class="m-2 mb-5 main-button">
                        <x-heroicon-c-plus class="w-5" />
                        Create New Category
                    </button>
                    <div class="grid w-full grid-cols-1 gap-4 md:grid-cols-2">
                        @foreach ($categories as $category)
                            <div class="relative overflow-hidden transition-all duration-500 bg-center bg-cover drop-shadow-lg hover:drop-shadow-2xl h-80 rounded-2xl group hover:scale-105"
                                style="background-image: url({{ $category->img }})">
                                <h1 class="z-10 flex items-center justify-center w-full h-full text-white duration-500 bg-black title bg-opacity-30 backdrop-blur-sm group-hover:backdrop-blur-none">
                                    {{ $category->title }}
                                </h1>

                                <div class="hidden group-hover:block">
                                    <button onclick="edit_{{ $category->id }}.showModal()" class="absolute edit-button-rounded right-12 bottom-5">
                                        <div class="w-4">
                                            @svg('heroicon-c-pencil')
                                        </div>
                                    </button>

                                    <button onclick="delete{{ $category->id }}.showModal()" class="absolute delete-button-rounded right-3 bottom-5">
                                        <div class="w-4">
                                            @svg('heroicon-s-trash')
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <dialog id="edit_{{ $category->id }}" class="modal modal-bottom sm:modal-middle">
                                <div class="flex flex-col items-center px-5 modal-box w-max">
                                    <h3 class="text-lg font-bold">Edit {{ $category->title }} Category</h3>
                                    <form action={{ route('dashboard.categories.update', $category) }} method="POST"
                                        enctype="multipart/form-data" class="flex flex-col items-center w-full">
                                        @csrf
                                        @method('PUT')
                                        {{-- name --}}
                                        <label class="w-full form-control">
                                            <div class="label">
                                                <span class="label-text">Category's Name</span>
                                            </div>
                                            <input type="text" name="title" placeholder="Type here"
                                                class="w-full input input-bordered"
                                                value="{{ old('title', $category->title) }}" />
                                            @error('name')
                                                <div class="label error">
                                                    <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </label>

                                        {{-- img --}}
                                        <label class="w-full form-control">
                                            <div class="label">
                                                <span class="label-text">Category's Image</span>
                                            </div>
                                            <input type="file" name="img"
                                                class="w-full file-input file-input-bordered"
                                                value="{{ old('img', $category->img) }}" accept="image/*" />
                                            @error('img')
                                                <div class="label error">
                                                    <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </label>
                                        <button class="w-full mt-8 text-xl main-button" type="submit">Submit
                                            Categories</button>
                                    </form>

                                    <div class="w-full mt-3 modal-action">
                                        <form method="dialog" class="flex flex-col items-center w-full">
                                            <button
                                                class="w-full shadow-inner btn bg-neutral-200 rounded-2xl">Close</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>


                            {{-- modal --}}
                            <dialog id="delete{{ $category->id }}" class="modal modal-bottom sm:modal-middle">
                                <div class="flex flex-col items-center justify-center modal-box">
                                    <img src="/assets/images/alert.webp" class="object-cover w-40 aspect-square"
                                        alt="">
                                    <h3 class="w-full text-2xl font-bold text-center">Are you sure?</h3>
                                    <div class="flex items-center justify-center w-full mt-5 space-x-4 modal-action">
                                        <form action="{{ route('dashboard.categories.destroy', $category) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white error-button">
                                                Delete This Category
                                            </button>
                                        </form>
                                        <form method="dialog">

                                            <button class="secondary-button">Close</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="flex flex-col items-center justify-center w-full h-[70vh]">
            <h1 class="mt-2 title">No Categories Yet</h1>
            <p class="mt-1 desc">Let's create your first category</p>

            <button class="mt-5 main-button" onclick="add_category_modal.showModal()">Create Category</button>
        </div>
    @endif

    <dialog id="add_category_modal" class="modal modal-bottom sm:modal-middle">
        <div class="flex flex-col items-center px-5 modal-box w-max">
            <h3 class="text-lg font-bold">Add New Category</h3>
            <form action="{{ route('dashboard.categories.store') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col items-center w-full">
                @csrf
                {{-- name --}}
                <label class="w-full form-control">
                    <div class="label">
                        <span class="label-text">Category's Name</span>
                    </div>
                    <input type="text" name="title" placeholder="Type here" class="w-full input input-bordered"
                        value="{{ old('title') }}" />
                    @error('name')
                        <div class="label error">
                            <span class="text-red-500 label-text-alt">{{ $message }}</span>
                        </div>
                    @enderror
                </label>

                {{-- img --}}
                <label class="w-full form-control">
                    <div class="label">
                        <span class="label-text">Category's Image</span>
                    </div>
                    <input type="file" name="img" class="w-full file-input file-input-bordered"
                        accept="image/*" />
                    @error('img')
                        <div class="label error">
                            <span class="text-red-500 label-text-alt">{{ $message }}</span>
                        </div>
                    @enderror
                </label>
                <button class="w-full mt-8 main-button" type="submit">Submit Categories</button>
            </form>

            <div class="w-full mt-3 modal-action">
                <form method="dialog" class="flex flex-col items-center w-full">
                    <button class="w-full shadow-inner btn bg-neutral-200 rounded-2xl">Close</button>
                </form>
            </div>
        </div>
    </dialog>

</x-app-layout>
