<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
   
    <div class="container mt-5">
        <ul class="nav flex-column nav-pills">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('categories.index') }}">Gestion des catégories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Gestion des produits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.index') }}">Gestion de commandes</a>
            </li>
        </ul>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
