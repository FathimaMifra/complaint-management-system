<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - New Collection</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen w-full">
        <!-- Left: Image -->
        <div class="w-1/2 bg-white flex items-center justify-center">
            <img src="{{ asset('image/complaints-vector.jpg') }}" alt="Shopping" class="w-full max-w-2xl">
        </div>

        <!-- Right: Content -->
        <div class="w-1/2 bg-indigo-400 text-white flex flex-col justify-center items-center px-10 py-12 text-center">
            <h2 class="text-4xl font-bold mb-4">Welcome to the Complaint Management System</h2>
            <p class="text-lg mb-8">
                Please log in to submit, track, and manage complaints efficiently.
                Your feedback matters — we’re here to help resolve your issues promptly and professionally.
            </p>

            <div class="flex space-x-4 mb-8">
                <a href="{{ route('register') }}" class="bg-white text-indigo-700 font-semibold px-6 py-2 rounded hover:bg-gray-200 transition">Register</a>
                <a href="{{ route('login') }}" class="bg-white text-indigo-700 font-semibold px-6 py-2 rounded hover:bg-gray-200 transition">Log In</a>
            </div>

            <!-- Dots -->
            <div class="flex space-x-2">
                <span class="w-3 h-3 bg-white rounded-full"></span>
                <span class="w-3 h-3 bg-white/50 rounded-full"></span>
                <span class="w-3 h-3 bg-white/50 rounded-full"></span>
                <span class="w-3 h-3 bg-white/50 rounded-full"></span>
            </div>
        </div>
    </div>
</body>
</html>
