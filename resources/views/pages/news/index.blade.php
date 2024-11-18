<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-semibold leading-tight text-gray-800">
            {{ __('News') }}
        </h2>
    </x-slot>

    @if ($newses->isNotEmpty())
        <div class="pb-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('dashboard.news.create') }}" class="mt-2 mb-5 main-button">
                        <x-heroicon-c-plus class="w-5" />
                        Create New News
                    </a>

                    <table class="w-full mt-3 border border-gray-300 rounded-lg">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 border-b">Image</th>
                                <th class="px-4 py-2 border-b">Title</th>
                                <th class="px-4 py-2 border-b">Content</th>
                                <th class="px-4 py-2 border-b">Read Time</th>
                                <th class="px-4 py-2 border-b">Date</th>
                                <th class="px-4 py-2 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($newses as $news)
                                <tr class="text-center">
                                    <td class="px-4 py-2 border-b">
                                        <img src="{{ $news->img }}" alt="News Image" class="w-20 h-20 object-cover rounded-lg">
                                    </td>
                                    <td class="px-4 py-2 border-b">{{ Str::limit($news->title, 50) }}</td>
                                    <td class="px-4 py-2 border-b">{{ Str::limit($news->body, 80) }}</td>
                                    <td class="px-4 py-2 border-b">{{ $news->read_time }}</td>
                                    <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($news->created_at)->format('M-d-Y') }}</td>
                                    <td class="px-4 py-2 border-b">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('dashboard.news.show', $news) }}" class="see-button-rounded">
                                                @svg('heroicon-c-eye', 'w-5')
                                            </a>
                                            <a href="{{ route('dashboard.news.edit', $news) }}" class="edit-button-rounded">
                                                @svg('heroicon-c-pencil', 'w-5')
                                            </a>
                                            <button onclick="delete{{ $news->id }}.showModal()" class="delete-button-rounded">
                                                @svg('heroicon-s-trash', 'w-5')
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                {{-- modal --}}
                                <dialog id="delete{{ $news->id }}" class="modal modal-bottom sm:modal-middle">
                                    <div class="flex flex-col items-center justify-center modal-box">
                                        <h3 class="w-full text-2xl font-bold text-center">Delete This News?</h3>
                                        <div class="flex items-center justify-center w-full mt-5 space-x-4 modal-action">
                                            <form action="{{ route('dashboard.news.destroy', $news) }}" method="POST">
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
            <h1 class="mt-2 title">No News Yet</h1>
            <p class="mt-1 desc">Let's create your first news to send</p>

            <a class="mt-5 main-button" href="{{ route('dashboard.newses.create') }}">Create Event</a>
        </div>
    @endif

</x-app-layout>
