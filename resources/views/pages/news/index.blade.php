<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-semibold leading-tight text-gray-800">
            {{ __('News') }}
        </h2>
    </x-slot>

    @if ($newses->isNotEmpty())
        <div class="pb-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col items-center p-6 text-gray-900">
                    @if (session('success'))
                        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('dashboard.news.create') }}" class="mt-2 mb-3 main-button">
                        <x-heroicon-c-plus class="w-5" />
                        Create New News
                    </a>
                    <div class="flex flex-wrap justify-center w-full mt-3">
                        @foreach ($newses as $news)
                            <div
                                class="relative overflow-hidden flex flex-col h-[26rem] m-3 group transition-all duration-500 bg-white w-80 rounded-3xl hover:drop-shadow-2xl drop-shadow-lg hover:scale-110">

                                <div class="relative flex items-center justify-center w-full h-full overflow-hidden transition-all duration-500 bg-center bg-cover group-hover:h-1/2"
                                    style="background-image: url({{ $news->img }})">
                                    <div class="w-full h-full bg-gradient-to-t from-black/70 to-black/10"></div>
                                </div>


                                <div
                                    class="absolute h-1/2 w-full top-[21rem] group-hover:top-[13.5rem] transition-all duration-500">
                                    <div class="relative flex flex-col justify-between w-full h-full">
                                        <div class="w-full">
                                            <h1
                                                class="px-5 mt-2 font-sans text-xl font-bold tracking-wide text-white transition-colors duration-500 group-hover:text-black">
                                                {{ Str::limit($news->title, 100) }}</h1>
                                            <p
                                                class="px-5 mt-2 text-sm tracking-wide break-words whitespace-normal transition-all duration-700 opacity-0 group-hover:opacity-100 h-max text-neutral-500">
                                                {{ Str::limit($news->body, 60) }}</p>

                                        </div>

                                        <div
                                            class="flex flex-col justify-between w-full mt-10 text-neutral-400 text-[10px] ">
                                            <div class="flex items-center px-5 space-x-2 text-xs">
                                                <div class="w-3">
                                                    @svg('antdesign-clock-circle')
                                                </div>
                                                <p>{{ $news->read_time }}</p>
                                            </div>

                                            <div class="flex items-center px-5 pb-5 space-x-2 text-xs">
                                                <div class="w-3">
                                                    @svg('antdesign-calendar')
                                                </div>
                                                <p>{{ \Carbon\Carbon::parse($news->created_at)->format('M-d-Y') }}
                                                </p>
                                            </div>

                                            <a href="{{ route('dashboard.news.show', $news) }}"
                                                class="absolute see-button-rounded right-[5.2rem] bottom-5">
                                                <div class="w-4">
                                                    @svg('heroicon-c-eye')
                                                </div>
                                            </a>

                                            <a href="{{ route('dashboard.news.edit', $news) }}"
                                                class="absolute edit-button-rounded right-12 bottom-5">
                                                <div class="w-4">
                                                    @svg('heroicon-c-pencil')
                                                </div>
                                            </a>

                                            <button onclick="delete{{ $news->id }}.showModal()"
                                                class="absolute delete-button-rounded right-3 bottom-5">
                                                <div class="w-4">
                                                    @svg('heroicon-s-trash')
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- modal --}}
                            <dialog id="delete{{ $news->id }}" class="modal modal-bottom sm:modal-middle">
                                <div class="flex flex-col items-center justify-center modal-box">
                                    <img src="/assets/images/alert.png" class="object-cover w-40 aspect-square" alt="">
                                    <h3 class="w-full text-2xl font-bold text-center">Are you sure?</h3>
                                    <div class="flex items-center justify-center w-full mt-5 space-x-4 modal-action">
                                        <form action="{{ route('dashboard.news.destroy', $news) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white error-button">
                                                Delete This News
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
            <h1 class="mt-2 title">No News Yet</h1>
            <p class="mt-1 desc">Let's create your first news to send</p>

            <a class="mt-5 main-button" href="{{ route('dashboard.newses.create') }}">Create Event</a>
        </div>
    @endif

</x-app-layout>
