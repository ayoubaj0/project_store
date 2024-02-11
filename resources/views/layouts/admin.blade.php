<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
        
    
    <title>@yield('title', 'App store')</title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        
        <div class="container-fluid">
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">Gestion des categories</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">Gestion des produits</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('produits.index')}}">Gestion des produits</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.index') }}">Gestion de commandes</a>
                    </li>
                </ul>
                
            </div>
        </div>
        @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif 
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                       
                    @endauth
                </div>
            @endif
    </nav>
    
    <div class="container mt-3">
        @yield('content')
    </div>

    <footer class="mt-5 text-center">
        &copy; OFPPT 2024
    </footer>
</body>
</html>
