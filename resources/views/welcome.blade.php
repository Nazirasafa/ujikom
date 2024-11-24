<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 4 Mars</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-purple': {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95'
                        }
                    }
                }
            }
        }
    </script>
     <style>
        .bg-bubble {
            position: absolute;
            border-radius: 50%;
            opacity: 0.5;
            filter: blur(100px);
            z-index: -1;
            animation: float 5s infinite alternate ease-in-out;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(50px, 50px) scale(1.1); }
        }

        body {
            position: relative;
            overflow-x: hidden;
        }
    </style>
</head>
<body class="relative text-gray-800 bg-gray-50">

    <div class="absolute inset-0 overflow-hidden pointer-events-none -z-50">
        <!-- Scattered Background Balls -->
        <div class="bg-purple-500 bg-bubble" style="top: 5%; left: 2%; width: 250px; height: 250px;"></div>
        <div class="bg-purple-500 bg-bubble" style="top: 15%; right: 5%; width: 300px; height: 300px;"></div>
        <div class="bg-purple-500 bg-bubble" style="top: 30%; left: 10%; width: 200px; height: 200px;"></div>
        <div class="bg-purple-500 bg-bubble" style="top: 45%; right: 15%; width: 280px; height: 280px;"></div>
        <div class="bg-purple-500 bg-bubble" style="top: 60%; left: 5%; width: 220px; height: 220px;"></div>
        <div class="bg-purple-500 bg-bubble" style="top: 75%; right: 8%; width: 260px; height: 260px;"></div>
        <div class="bg-purple-500 bg-bubble" style="top: 85%; left: 15%; width: 180px; height: 180px;"></div>
        <div class="bg-purple-500 bg-bubble" style="top: 90%; right: 20%; width: 240px; height: 240px;"></div>
    </div>
    <!-- Navigation -->
    <nav class="relative z-10 bg-white shadow-md">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex justify-between w-full">
                    <div class="flex items-center flex-shrink-0">
                        <a href="{{ route('homepage') }}">
                            <x-logo-purple/>
                        </a>
                    </div>
                    <div class="items-center hidden sm:flex sm:space-x-4">
                        <a href="#profile" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-brand-purple-600">School Profile</a>
                        <a href="#gallery" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-brand-purple-600">Gallery</a>
                        <a href="#news" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-brand-purple-600">School News</a>
                        <a href="#events" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-brand-purple-600">School Events</a>
                        <a href="#location" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-brand-purple-600">Location</a>
                        <a href="{{route('login')}}" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-brand-purple-600">Login</a>
                    
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative h-[75vh] flex items-center justify-center text-center bg-cover bg-center" style="background-image: url('assets/images/upacara.jpg')">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 px-4 text-white">
            <h1 class="mb-4 font-serif text-5xl font-bold">SMKN 4 Mars</h1>
            <p class="text-lg italic">Empowering Future Generations</p>
        </div>
    </section>

    <!-- School Profile Section -->
    <section class="max-w-6xl px-4 py-16 mx-auto" id="profile">
        <h2 class="mb-12 text-3xl font-bold text-center text-brand-purple-600">School Profile</h2>
        <div class="grid items-center gap-12 md:grid-cols-2">
            <div>
                <img src="assets/images/drone.jpg" alt="School Building" class="w-full rounded-lg shadow-lg">
            </div>
            <div>
                <h3 class="mb-4 text-2xl font-semibold text-brand-purple-600">Our Vision & Mission</h3>
                <p class="mb-6 text-gray-700">Visi kami adalah Terwujudnya SMK Pusat Keunggulan melalui terciptanya pelajar pancasila yang berbasis teknologi, berwawasan lingkungan dan berkewirausahaan.</p>
                
                <h3 class="mb-4 text-2xl font-semibold text-brand-purple-600">History</h3>
                <p class="text-gray-700">Merupakan sekolah kejuruan berbasis Teknologi Informasi dan Komunikasi. Sekolah ini didirikan dan dirintis pada tahun 2008 kemudian dibuka pada tahun 2009 yang saat ini terakreditasi A</p>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-16" id="gallery">
        <div class="max-w-6xl px-4 mx-auto">
            <h2 class="mb-12 text-3xl font-bold text-center text-brand-purple-600">Gallery</h2>
            <div class="grid gap-6 md:grid-cols-3">
                @foreach ($galleries as $gallery)
                    <a href="{{route('show.gallery', $gallery)}}" class="overflow-hidden transition-transform duration-500 rounded-lg shadow-md hover:scale-105">
                        <img src="{{ $gallery->img }}" class="object-cover w-full h-64">
                    </a>
                @endforeach
            </div>
            <div class="w-full mt-10 text-lg font-semibold text-center text-purple-600 underline">
                <a href={{route('galleries')}} >See More Galleries</a>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-16" id="news">
        <div class="max-w-6xl px-4 mx-auto">
            <h2 class="mb-12 text-3xl font-bold text-center text-brand-purple-600">School News</h2>
            <div class="grid gap-6 md:grid-cols-3">
                @foreach ($newses as $news)
                    <div class="overflow-hidden bg-white rounded-lg shadow-md">
                        <img src="{{ $news->img }}" class="object-cover w-full h-48">
                        <div class="p-6">
                            <h5 class="mb-3 text-xl font-semibold text-brand-purple-600">{{ Str::limit($news->title, 100) }}</h5>
                            <p class="mb-4 text-gray-600">{{ Str::limit($news->body, 80) }}</p>
                            <a href="{{route('show.news', $news)}}" class="inline-block px-4 py-2 text-white transition rounded-md bg-brand-purple-500 hover:bg-brand-purple-600">Read More</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="w-full mt-10 text-lg font-semibold text-center text-purple-600 underline">
                <a href={{route('news')}} >See More News</a>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="py-16" id="events">
        <div class="max-w-6xl px-4 mx-auto">
            <h2 class="mb-12 text-3xl font-bold text-center text-brand-purple-600">Upcoming Events</h2>
            <div class="grid gap-6 md:grid-cols-3">
                @foreach ($events as $event)
                    <div class="flex flex-col overflow-hidden bg-white rounded-lg shadow-md">
                        <img src="{{ $event->img }}" class="object-contain w-full h-48">
                        <div class="flex flex-col flex-grow p-6">
                            <h5 class="mb-3 text-xl font-semibold text-brand-purple-600">{{ Str::limit($event->name, 25) }}</h5>
                            <p class="flex-grow mb-4 text-gray-600">{{ Str::limit($event->description, 100) }}</p>
                            <small class="mb-4 text-gray-500">Date: {{ date('d F Y', strtotime($event->date)) }}</small>
                            <a href="{{route('show.event', $event)}}" class="inline-block px-4 py-2 transition border rounded-md border-brand-purple-500 text-brand-purple-500 hover:bg-brand-purple-500 hover:text-white">Learn More</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="w-full mt-10 text-lg font-semibold text-center text-purple-600 underline">
                <a href={{route('events')}} >See More Events</a>
            </div>
        </div>
    </section>

    <!-- Location Section -->
    <section class="py-16" id="location">
        <div class="max-w-6xl px-4 mx-auto">
            <h2 class="mb-12 text-3xl font-bold text-center text-brand-purple-600">Our Location</h2>
            <div class="flex justify-center">
                <div class="w-full md:w-3/4 aspect-w-16 aspect-h-9">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3169.664621825812!2d-122.0838514!3d37.3874741!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb9a6b906fce5%3A0x35df83f0be9310f8!2sGoogleplex!5e0!3m2!1sen!2sus!4v1614519350369!5m2!1sen!2sus" 
                        class="w-full h-full rounded-lg shadow-md"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 text-white bg-brand-purple-600">
        <div class="max-w-6xl px-4 mx-auto text-center">
            <p>&copy; 2024 SMKN 4 Mars. All Rights Reserved.</p>
            <p class="mt-2 text-sm">Education is your key to endless possibilities.</p>
        </div>
    </footer>
</body>
</html>