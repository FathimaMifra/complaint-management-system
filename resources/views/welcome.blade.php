@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <section id="home" class="relative h-screen bg-blue-50 flex items-center justify-center">
        <div class="text-center px-6 z-10">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800">Welcome to Complaint Management</h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Easily report, track, and receive updates on your complaints within the institute.
                Designed for students, faculty, and staff to ensure transparency, timely resolution, and institutional accountability.
            </p>
            <div class="mt-6 space-x-4">
                <a href="/register" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">Get Start</a>
                <a href="/login" class="border border-blue-500 text-blue-500 px-6 py-3 rounded hover:bg-blue-100">Login</a>
            </div>
        </div>
        <div class="absolute inset-0 -z-10">
            <img src="/images/complaint-banner.jpg" alt="Banner" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-white opacity-80"></div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-white text-center">
        <div class="max-w-5xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">About ComplaintSys</h2>
            <p class="text-gray-600 text-lg mb-10">
                ComplaintSys is a dedicated platform developed for institutional environments. It empowers students, faculty,
                and administrative staff to report issues related to infrastructure, academics, or campus services in a structured manner.
                Our mission is to create a transparent and efficient resolution system that promotes trust and communication between stakeholders.
            </p>
            <div class="grid md:grid-cols-3 gap-8 text-left">
                <div class="bg-blue-50 p-6 rounded shadow">
                    <h3 class="text-xl font-semibold text-blue-700 mb-2">Why Use ComplaintSys?</h3>
                    <p class="text-gray-600">Centralized and transparent complaint management that ensures timely resolutions with full traceability.</p>
                </div>
                <div class="bg-blue-50 p-6 rounded shadow">
                    <h3 class="text-xl font-semibold text-blue-700 mb-2">Who Can Use It?</h3>
                    <p class="text-gray-600">Students, faculty members, and staff members can report issues and receive updates within the system.</p>
                </div>
                <div class="bg-blue-50 p-6 rounded shadow">
                    <h3 class="text-xl font-semibold text-blue-700 mb-2">What We Aim For</h3>
                    <p class="text-gray-600">Improving communication, resolving complaints faster, and making the campus experience better for all.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-gray-100 text-center">
        <div class="max-w-3xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Contact Us</h2>
            <p class="text-gray-600 text-lg mb-10">
                Have questions, suggestions, or need support? Reach out to our administrative team.
            </p>
            <div class="text-left bg-white rounded-lg p-6 shadow-md space-y-4">
                <div>
                    <h4 class="text-lg font-semibold text-blue-600">📧 Email</h4>
                    <p class="text-gray-700">support@complaintsys.in</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-blue-600">📞 Phone</h4>
                    <p class="text-gray-700">+91 98765 43210</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-blue-600">🏫 Address</h4>
                    <p class="text-gray-700">Room 101, Admin Block, Your Institute, India</p>
                </div>
            </div>
        </div>
    </section>

@endsection
