<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <title>@yield('title','App store')</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{route('home.index')}}">Catalogue</a></li>
            <li><a href="{{route('categories.index')}}">Gestion des categories</a></li>
            <li><a href="#">Gestion des produits</a></li>
            <li><a href="{{route('home.panier')}}">Mon panier</a></li>
        </ul>
    </nav>
    <div class="main">
        @yield('content')
    </div>
    <footer>
        &copy;OFPPT 2024
    </footer>
</body>
</html>
