<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-semibold leading-tight text-gray-800">
            {{ __('Events') }}
        </h2>
    </x-slot>

    @if ($events->isNotEmpty())
        <div class="pb-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('dashboard.events.create') }}" class="mt-2 mb-5 main-button">
                        <x-heroicon-c-plus class="w-5"/>
                        Create New Event
                    </a>

                    <table class="w-full mt-3 border border-gray-300 rounded-lg">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 border-b">Image</th>
                                <th class="px-4 py-2 border-b">Event Name</th>
                                <th class="px-4 py-2 border-b">Description</th>
                                <th class="px-4 py-2 border-b">Time</th>
                                <th class="px-4 py-2 border-b">Date</th>
                                <th class="px-4 py-2 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr class="text-center">
                                    <td class="px-4 py-2 border-b">
                                        <img src="{{ $event->img }}" alt="Event Image" class="object-cover w-20 h-20 rounded-lg">
                                    </td>
                                    <td class="px-4 py-2 border-b">{{ Str::limit($event->name, 50) }}</td>
                                    <td class="px-4 py-2 border-b">{{ Str::limit($event->short_desc, 80) }}</td>
                                    <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($event->time_start)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->time_end)->format('H:i') }}</td>
                                    <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($event->date)->format('M-d-Y') }}</td>
                                    <td class="px-4 py-2 border-b">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('dashboard.events.edit', $event) }}" class="edit-button-rounded">
                                                @svg('heroicon-c-pencil', 'w-5')
                                            </a>
                                            <button onclick="delete{{ $event->id }}.showModal()" class="delete-button-rounded">
                                                @svg('heroicon-s-trash', 'w-5')
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                {{-- modal --}}
                                <dialog id="delete{{ $event->id }}" class="modal modal-bottom sm:modal-middle">
                                    <div class="flex flex-col items-center justify-center modal-box">
                                        <h3 class="w-full text-2xl font-bold text-center">Delete This Event?</h3>
                                        <div class="flex items-center justify-center w-full mt-5 space-x-4 modal-action">
                                            <form action="{{ route('dashboard.events.destroy', $event) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-white error-button">
                                                    Delete
                                                </button>
                                            </form>
                                            <form method="dialog">
                                                <button class="secondary-button">Close</button>
                                            </form>
                                        </div>
                                    </div>
                                </dialog>
                            @endforeach
                        </tbody>
                    </table>
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
