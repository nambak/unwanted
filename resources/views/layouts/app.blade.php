<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="zCBs9PKVOsp3auMGZ6AuYQDw19pLBwsT4707c1ME7ao" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.min.css" type="text/css">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
<div id="app">
    <nav class="bg-white shadow-lg" role="navigation" aria-label="main navigation">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a class="text-xl font-bold text-gray-800 hover:text-gray-600" href="{{ url('/') }}">
                        unwanted
                    </a>
                </div>

                <!-- Mobile menu button -->
                <button class="md:hidden navbar-burger flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-800 hover:border-gray-300" data-target="navbarMenu">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                    </svg>
                </button>

                <!-- Desktop menu -->
                <div class="hidden md:flex md:items-center md:space-x-4">
                    <!-- Authentication Links -->
                    @guest
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                        Log in
                    </a>
                    @else
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                            {{ Auth::user()->name }}
                            <svg class="ml-1 h-4 w-4 inline" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>

                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10">
                            <div class="py-1">
                                <a href="{{ route('articles.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    글쓰기
                                </a>
                                <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    카테고리 관리
                                </a>
                                <a href="{{ route('logout') }}" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </div>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                    @endguest
                </div>

                <!-- Mobile menu -->
                <div id="navbarMenu" class="hidden md:hidden absolute top-16 left-0 right-0 bg-white shadow-lg">
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        @guest
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                            Log in
                        </a>
                        @else
                        <div class="space-y-1">
                            <div class="px-3 py-2 text-base font-medium text-gray-900">{{ Auth::user()->name }}</div>
                            <a href="{{ route('articles.create') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                                글쓰기
                            </a>
                            <a href="{{ route('categories.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                                카테고리 관리
                            </a>
                            <a href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                                {{ __('Logout') }}
                            </a>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <section class="min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
        </div>
    </section>
    <footer class="bg-gray-50 py-12">
        <div class="text-center">
            <div class="flex justify-center space-x-6 mb-4">
                <a href="mailto:nambak80@gmail.com" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-lg fa-envelope"></i>
                </a>
                <a href="https://www.linkedin.com/in/nambak80/" class="text-gray-600 hover:text-gray-900">
                    <i class="fab fa-lg fa-linkedin"></i>
                </a>
                <a href="https://medium.com/@nambak1980" class="text-gray-600 hover:text-gray-900">
                    <i class="fab fa-lg fa-medium"></i>
                </a>
            </div>
            <p class="text-sm text-gray-500">Since 2019</p>
        </div>
    </footer>
</div>
@yield('script')
</body>
</html>
