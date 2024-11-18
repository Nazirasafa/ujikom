<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-semibold leading-tight text-gray-800">
            {{ __('Galleries') }}
        </h2>
    </x-slot>

    @if ($galleries->isNotEmpty())
        <div class="pb-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col items-center p-6 text-gray-900">
                    @if (session('success'))
                        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-2xl">
                            {{ session('success') }}
                        </div>
                    @endif

                    <button onclick="add_gallery_modal.showModal()" class="m-2 mb-5 main-button">
                        <x-heroicon-c-plus class="w-5" />
                        Create New Gallery
                    </button>

                    <!-- Masonry grid layout for Pinterest style -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($galleries as $gallery)
                            <div class="relative overflow-hidden transition-all duration-500 bg-center bg-cover drop-shadow-lg hover:drop-shadow-2xl rounded-2xl group hover:scale-105"
                                style="background-image: url({{ $gallery->img }}); height: 300px;">
                                <a href={{ route('dashboard.galleries.show', $gallery) }} class="flex items-center justify-center w-full h-full text-center text-white duration-500 bg-black bg-opacity-30 backdrop-blur-sm group-hover:backdrop-blur-none">
                                    <h1 class="text-xl font-semibold">{{ $gallery->name }}</h1>
                                </a>

                                <!-- Edit and delete buttons appear on hover -->
                                <div class="absolute bottom-5 right-5 space-x-2 hidden group-hover:flex">
                                    <button onclick="edit_{{ $gallery->id }}.showModal()" class="edit-button-rounded">
                                        @svg('heroicon-c-pencil', 'w-5')
                                    </button>

                                    <button onclick="delete{{ $gallery->id }}.showModal()" class="delete-button-rounded">
                                        @svg('heroicon-s-trash', 'w-5')
                                    </button>
                                </div>
                            </div>

                            <!-- Edit modal -->
                            <dialog id="edit_{{ $gallery->id }}" class="modal modal-bottom sm:modal-middle">
                                <div class="flex flex-col items-center px-5 modal-box w-max">
                                    <h3 class="text-lg font-bold">Edit {{ $gallery->name }} Gallery</h3>
                                    <form action={{ route('dashboard.galleries.update', $gallery) }} method="POST"
                                        enctype="multipart/form-data" class="flex flex-col items-center w-full">
                                        @csrf
                                        @method('PUT')
                                        {{-- Name --}}
                                        <label class="w-full form-control">
                                            <div class="label">
                                                <span class="label-text">Gallery's Name</span>
                                            </div>
                                            <input type="text" name="name" placeholder="Type here"
                                                class="w-full input input-bordered"
                                                value="{{ old('title', $gallery->name) }}" />
                                            @error('name')
                                                <div class="label error">
                                                    <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </label>

                                        {{-- Description --}}
                                        <label class="w-full form-control">
                                            <div class="label">
                                                <span class="label-text">Description</span>
                                            </div>
                                            <textarea name="desc" class="w-full h-24 textarea textarea-bordered"
                                                placeholder="Type event's description here">{{ old('desc', $gallery->desc) }}</textarea>
                                            @error('desc')
                                                <div class="label error">
                                                    <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </label>

                                        {{-- Image --}}
                                        <label class="w-full form-control">
                                            <div class="label">
                                                <span class="label-text">Gallery's Image</span>
                                            </div>
                                            <input type="file" name="img" class="w-full file-input file-input-bordered"
                                                accept="image/*" />
                                            @error('img')
                                                <div class="label error">
                                                    <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </label>
                                        <button class="w-full mt-8 text-xl main-button" type="submit">Update Gallery</button>
                                    </form>

                                    <div class="w-full mt-3 modal-action">
                                        <form method="dialog" class="flex flex-col items-center w-full">
                                            <button class="w-full shadow-inner btn bg-neutral-200 rounded-2xl">Close</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>

                            <!-- Delete modal -->
                            <dialog id="delete{{ $gallery->id }}" class="modal modal-bottom sm:modal-middle">
                                <div class="flex flex-col items-center justify-center modal-box">
                                    <img src="/assets/images/alert.png" class="object-cover w-40 aspect-square" alt="">
                                    <h3 class="w-full text-2xl font-bold text-center">Are you sure?</h3>
                                    <div class="flex items-center justify-center w-full mt-5 space-x-4 modal-action">
                                        <form action="{{ route('dashboard.galleries.destroy', $gallery) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white error-button">
                                                Delete This Gallery
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
            <p class="mt-1 desc">Let's create your first gallery</p>

            <button class="mt-5 main-button" onclick="add_gallery_modal.showModal()">Create Gallery</button>
        </div>
    @endif

    <!-- Add Gallery Modal -->
    <dialog id="add_gallery_modal" class="modal modal-bottom sm:modal-middle">
        <div class="flex flex-col items-center px-5 modal-box w-max">
            <h3 class="text-lg font-bold">Add New Gallery</h3>
            <form action="{{ route('dashboard.galleries.store') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col items-center w-full">
                @csrf
                <!-- Name -->
                <label class="w-full form-control">
                    <div class="label">
                        <span class="label-text">Gallery's Name</span>
                    </div>
                    <input type="text" name="name" placeholder="Type here" class="w-full input input-bordered" value="{{ old('name') }}" />
                    @error('name')
                        <div class="label error">
                            <span class="text-red-500 label-text-alt">{{ $message }}</span>
                        </div>
                    @enderror
                </label>
                <!-- Description -->
                <label class="w-full form-control">
                    <div class="label">
                        <span class="label-text">Description</span>
                    </div>
                    <textarea name="desc" class="w-full h-24 textarea textarea-bordered" placeholder="Type event's description here">{{ old('desc') }}</textarea>
                    @error('desc')
                        <div class="label error">
                            <span class="text-red-500 label-text-alt">{{ $message }}</span>
                        </div>
                    @enderror
                </label>
                <!-- Image -->
                <label class="w-full form-control">
                    <div class="label">
                        <span class="label-text">Gallery's Image</span>
                    </div>
                    <input type="file" name="img" class="w-full file-input file-input-bordered" accept="image/*" />
                    @error('img')
                        <div class="label error">
                            <span class="text-red-500 label-text-alt">{{ $message }}</span>
                        </div>
                    @enderror
                </label>
                <button class="w-full mt-8 text-xl main-button" type="submit">Submit Gallery</button>
            </form>

            <div class="w-full mt-3 modal-action">
                <form method="dialog" class="flex flex-col items-center w-full">
                    <button class="w-full shadow-inner btn bg-neutral-200 rounded-2xl">Close</button>
                </form>
            </div>
        </div>
    </dialog>
</x-app-layout>
