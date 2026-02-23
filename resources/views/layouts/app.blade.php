<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Complaint Management System' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white font-sans">
    <!-- Header -->
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="text-2xl font-bold text-sky-900 flex items-center space-x-2">
                <span class="text-3xl"></span>
                <span>ComplaintSys</span>
            </div>
            <nav class="space-x-6 hidden md:block">
                <a href="#home" class="text-gray-700 hover:text-sky-600">Home</a>
                <a href="#about" class="text-gray-700 hover:text-sky-600">About</a>
                <a href="#gallery" class="text-gray-700 hover:text-sky-600">Gallery</a>
                <a href="#contact" class="text-gray-700 hover:text-sky-600">Contact</a>
            </nav>
            <div class="space-x-2">
                <a href="/login" class="px-4 py-2 bg-sky-900 text-white rounded hover:bg-sky-600">Login</a>
                <a href="/register" class="px-4 py-2 bg-sky-900 text-white rounded hover:bg-sky-600">Register</a>
            </div>
        </div>
    </header>

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-white border-t py-6 text-center text-sm text-gray-500">
        <div class="max-w-7xl mx-auto px-6">
            <p>&copy; 2025 ComplaintSys. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
