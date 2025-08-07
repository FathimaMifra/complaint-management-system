<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Dashboard - Complaint Management System</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 font-sans">
        <!-- Header -->
        <header class="bg-white shadow sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <div class="text-2xl font-bold text-blue-500 flex items-center space-x-2">
                    <span class="text-3xl"></span>
                    <span>ComplaintSys</span>
                </div>
                <nav class="space-x-6 hidden md:block">
                    <a href="#" class="text-gray-700 hover:text-blue-500">Home</a>
                    <a href="{{ route('complaints.create') }}" class="text-gray-700 hover:text-blue-500">Submit Complaint</a>
                    <a href="{{ route('complaints.index') }}" class="text-gray-700 hover:text-blue-500">My Complaints</a>
                    <a href="#" class="text-gray-700 hover:text-blue-500">Profile</a>
                    <a href="#" class="text-gray-700 hover:text-blue-500">About</a>
                    <a href="#" class="text-gray-700 hover:text-blue-500">Contact</a>
                </nav>
                <div class="space-x-2">
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="max-w-7xl mx-auto p-6">
            @yield('content')
        </main>
    </body>
</html>
