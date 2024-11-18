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
                        </div>
                        <button class="mt-8 text-xl min-w-lg bg-blue-400 text-white rounded-lg px-6 py-2" style="background-color: #60a5fa;" type="submit">Submit Event</button>

                   </form>
                </div>
            </div>
        </div>
    </div>

    <dialog id="add_category_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
          <h3 class="text-lg font-bold">Hello!</h3>
          <p class="py-4">Press ESC key or click the button below to close</p>
          <div class="modal-action">
            <form method="dialog">
              <!-- if there is a button in form, it will close the modal -->
              <button class="btn">Close</button>
            </form>
          </div>
        </div>
      </dialog>
</x-app-layout>