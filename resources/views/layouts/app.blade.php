<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Complaint Management System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-blue-600 text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ url('/') }}" class="text-2xl font-bold">Complaint System</a>
                <div>
                    @auth
                        <span class="mr-4">Welcome, {{ auth()->user()->name }}</span>
                        <a href="{{ route('complaints.create') }}" class="mr-4">Submit Complaint</a>
                        <a href="{{ route('complaints.index') }}" class="mr-4">My Complaints</a>
                        @if(auth()->user()->hasRole('admin'))
                            <a href="{{ url('/admin') }}" class="mr-4">Admin Panel</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-white">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="mr-4">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Content -->
        <main class="container mx-auto mt-8 px-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
