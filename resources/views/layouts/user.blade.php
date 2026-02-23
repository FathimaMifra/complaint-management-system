<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Dashboard - Complaint Management System</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="min-h-screen flex flex-col bg-gray-100 font-sans">
        <!-- Header -->
        <header class="bg-white shadow sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <div class="text-2xl font-bold text-sky-900 flex items-center space-x-2">
                    <span class="text-3xl"></span>
                    <span>ComplaintSys</span>
                </div>
                <nav class="space-x-6 hidden md:block">
                    <a href="{{ route('complaints.index') }}" class="text-gray-700 hover:text-sky-600">Home</a>
                    <a href="{{ route('complaints.create') }}" class="text-gray-700 hover:text-sky-600">Submit Complaint</a>
                    <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:text-sky-600">Profile</a>
                </nav>
                <div class="space-x-2">
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-sky-900 text-white rounded hover:bg-sky-600">Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="max-w-7xl mx-auto w-full flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t py-6 text-center text-sm text-gray-500">
            <div class="max-w-7xl mx-auto px-6">
                <p>&copy; 2025 ComplaintSys. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
