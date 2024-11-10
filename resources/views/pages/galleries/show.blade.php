<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __($gallery->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-2xl">
                <div class="p-6 text-gray-900">
                    <a class="secondary-button" href="{{ route('dashboard.galleries') }}">
                        <x-heroicon-o-arrow-left class="w-5" />
                        Back
                    </a>
                    <div style="background-image: url({{ $gallery->img }})" class="w-full relative aspect-[16/9] bg-center bg-cover rounded-[3rem] drop-shadow-2xl mt-5 overflow-hidden text-white">
                        <div class="absolute flex flex-col justify-end w-full h-full p-16 bg-gradient-to-t from-black/70 to-black/0">
                            <h1 class="text-[2rem] font-bold">{{$gallery->name}}</h1>
                            <p class="text-neutral-300">{{$gallery->desc}}</p>
                        </div>        
                    </div>
                    
                    <h4 class="px-16 mt-10 title">Images</h4>
                    <div class="flex flex-wrap w-full mt-5 px-14">
                        @foreach ($gallery->images as $image)
                            
                            <button onclick="focused{{$image->id}}.showModal()" style="background-image: url({{$image->image}})" class="m-2 overflow-hidden transition-all duration-300 bg-center bg-cover shadow-lg hover:shadow-2xl w-36 aspect-square rounded-2xl hover:scale-110" alt=""></button>
                            
                            
                            <dialog id="focused{{$image->id}}" class="transition-all duration-500 modal">
                                <div class="relative p-0 overflow-hidden modal-box">
                                    <form action="{{ route('dashboard.galleries.image.destroy', ['image' => $image, 'gallery' => $gallery]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="absolute delete-button-rounded right-5 bottom-5">
                                            <div class="w-5 mb-[2px] mr-[1px]">
                                                @svg('heroicon-s-trash')
                                            </div>
                                        </button>
                                    </form>

                                  <img src={{$image->image}} class="object-contain w-full h-full">
                                  
                                </div>
                                <form method="dialog" class="modal-backdrop backdrop-blur-sm">
                                  <button>close</button>
                                </form>
                              </dialog>
                            
                        @endforeach
                        <button onclick="add_image_modal.showModal()" class="flex items-center justify-center m-2 transition-colors duration-300 bg-white border border-dashed w-36 aspect-square rounded-2xl border-neutral-600 hover:border-none hover:bg-blue-500 hover:text-white text-neutral-600">
                            <x-heroicon-c-plus class="w-10"/>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

   
</x-app-layout>




<dialog id="add_image_modal" class="modal modal-bottom sm:modal-middle">
    <div class="flex flex-col items-center px-5 modal-box w-max">
        <h3 class="text-lg font-bold">Add New Photo to {{$gallery->name}}</h3>
        <form action={{ route('dashboard.galleries.image.store', $gallery) }} method="POST" enctype="multipart/form-data"
            class="flex flex-col items-center w-full">
            @csrf
            {{-- img --}}
            <label class="w-full form-control">
                <div class="label">
                    <span class="label-text">Add Photo</span>
                </div>
                <input type="file" name="image" required class="w-full file-input file-input-bordered"
                    accept="image/*" />
                @error('image')
                    <div class="label error">
                        <span class="text-red-500 label-text-alt">{{ $message }}</span>
                    </div>
                @enderror
            </label>
            <button class="w-full mt-8 text-xl main-button" type="submit">Add Photo</button>
        </form>

        <div class="w-full mt-3 modal-action">
            <form method="dialog" class="flex flex-col items-center w-full">
                <button class="w-full shadow-inner btn bg-neutral-200 rounded-2xl">Close</button>
            </form>
        </div>
    </div>
</dialog>