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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
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

                            <!-- Edit and Delete Modals here as in the original code -->
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

    <!-- Add Category Modal here as in the original code -->

</x-app-layout>
