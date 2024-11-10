<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-semibold leading-tight text-gray-800">
            {{ __('Events') }}
        </h2>
    </x-slot>

    @if ($events->isNotEmpty())
        <div class="pb-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="flex flex-col items-center p-6 text-gray-900">
                        @if(session('success'))
                        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                            {{ session('success') }}
                        </div>
                        @endif

                        <a href="{{ route('dashboard.events.create') }}" class="mt-2 mb-3 main-button">
                            <x-heroicon-c-plus class="w-5"/>
                            Create New Events
                        </a>
                        <div class="flex flex-wrap mt-3">
                            @foreach ($events as $event)
                            <div class="flex relative flex-col justify-between p-5 m-3 w-72 rounded-3xl hover:drop-shadow-2xl drop-shadow-lg h-[24rem] hover:scale-110 transition-all duration-500 bg-white">
                                <div>
                                    <div class="relative flex items-center justify-center w-full overflow-hidden h-36 rounded-2xl">
                                        <img src='{{ $event->img }}' class='mb-3 max-h-36 ' alt="">  
                                    </div>
                                
                                    <h1 class="mt-2 text-xl tracking-wide">{{ Str::limit($event->name, 100) }}</h1>
                                    <p class="mt-2 text-sm tracking-wide text-neutral-500">{{ Str::limit($event->short_desc, 100) }}</p>
                    
                                    
                                </div>
                                <div class="flex flex-col justify-between w-full mt-10 text-neutral-400 text-[10px]">
                                    <div class="flex items-center space-x-2 text-xs">
                                        <div class="w-3">
                                            @svg('antdesign-clock-circle')
                                        </div>
                                        <p>{{ \Carbon\Carbon::parse($event->time_start)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->time_end)->format('H:i') }}</p>
                                    </div>
                    
                                    <div class="flex items-center space-x-2 text-xs">
                                        <div class="w-3">
                                            @svg('antdesign-calendar')
                                        </div>
                                        <p>{{\Carbon\Carbon::parse($event->date)->format('M-d-Y')}}</p>
                                    </div>
                    


                                    <a href="{{route('dashboard.events.edit', $event )}}" class="absolute edit-button-rounded right-12 bottom-5">
                                        <div class="w-4">
                                            @svg('heroicon-c-pencil')
                                        </div>
                                    </a>

                                    <button onclick="delete{{ $event->id }}.showModal()"
                                        class="absolute delete-button-rounded right-3 bottom-5">
                                        <div class="w-4">
                                            @svg('heroicon-s-trash')
                                        </div>
                                    </button>

                                </div>
                            </div>


                            {{-- modal --}}
                            <dialog id="delete{{ $event->id }}" class="modal modal-bottom sm:modal-middle">
                                <div class="flex flex-col items-center justify-center modal-box">
                                    <img src="/assets/images/alert.png" class="object-cover w-40 aspect-square" alt="">
                                    <h3 class="w-full text-2xl font-bold text-center">Are you sure?</h3>
                                    <div class="flex items-center justify-center w-full mt-5 space-x-4 modal-action">
                                        <form action="{{ route('dashboard.events.destroy', $event) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white error-button">
                                                Delete This Event
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
        <h1 class="mt-2 title">No Events Yet</h1>
        <p class="mt-1 desc">Let's create your first event to send</p>

        <a class="mt-5 main-button" href="{{ route('dashboard.events.create') }}">Create Event</a>
    </div>
    @endif
   
</x-app-layout>
