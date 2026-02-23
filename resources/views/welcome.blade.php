@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center justify-center bg-sky-50">
        <!-- Content -->
        <div class="relative z-10 max-w-4xl mx-auto text-center px-6">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 leading-tight">
                <span class="text-sky-600">Welcome to</span> <span class="text-sky-900">Institute Complaint Management</span>
            </h1>
            <p class="mt-6 text-lg md:text-xl text-gray-700 max-w-2xl mx-auto">
                Easily report, track, and receive updates on your complaints.
                Built for students, faculty, and staff to ensure transparency,
                timely resolution, and institutional accountability.
            </p>

            <!-- CTA Buttons -->
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a href="/register"
                class="bg-sky-900 hover:bg-sky-600 text-white px-8 py-3 rounded-full shadow-lg transition duration-300">
                Get Started
                </a>
                <a href="/login"
                class="border-2 border-sky-900 text-sky-900 px-8 py-3 rounded-full hover:bg-blue-50 transition duration-300">
                Login
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-14 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-sky-900">An Academic Community Powered by AI-Driven Fairness and Responsiveness</h2>
                    <p class="mt-6 text-lg text-gray-700 leading-relaxed">
                        Educational Institute is dedicated to fostering an inclusive academic 
                        community where every voice is valued and grievances are addressed equitably. 
                        Our AI-powered Complaint Management System leverages advanced NLP for sentiment 
                        detection and priority classification to uphold fairness, accountability, and institutional 
                        responsiveness across all faculties.
                    </p>
                    <div class="mt-8 grid sm:grid-cols-2 gap-6">
                        <div class="p-6 rounded-xl border border-sky-100 bg-sky-50">
                            <h3 class="text-xl font-semibold text-sky-900">Student Empowerment</h3>
                            <p class="mt-2 text-gray-600">Confidential channels and guided workflows safeguard student dignity.</p>
                        </div>
                        <div class="p-6 rounded-xl border border-emerald-100 bg-emerald-50">
                            <h3 class="text-xl font-semibold text-emerald-900">Data-Driven Governance</h3>
                            <p class="mt-2 text-gray-600">Interactive dashboards with sentiment analytics and priority trends.</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1526657782461-9fe13402a841?auto=format&fit=crop&w=1300&q=80" alt="Modern Sri Lankan campus building" class="rounded-3xl shadow-xl w-full object-cover">
                    <div class="absolute -bottom-10 -left-6 bg-white rounded-2xl shadow-lg p-6 border border-sky-100 max-w-xs">
                        <p class="text-sm uppercase text-sky-700 tracking-widest">Our Vision 2030</p>
                        <p class="mt-2 text-gray-700 leading-relaxed">
                            To pioneer AI-enhanced complaint resolution as the leading digital ally for student welfare in higher education ecosystem.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Capabilities -->
    <section id="capabilities" class="py-24 bg-sky-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
                <div>
                    <p class="text-sm font-semibold tracking-[0.25em] text-sky-600 uppercase">What Sets Us Apart</p>
                    <h2 class="mt-3 text-3xl md:text-4xl font-bold text-sky-900">AI that Understands Educational Institutes</h2>
                </div>
                <a href="/complaints/create" class="inline-flex items-center gap-2 text-sky-700 font-semibold hover:gap-3 transition">
                    Lodge a Complaint
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.5 12h15m0 0-6-6m6 6-6 6" />
                    </svg>
                </a>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-sky-100 hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center text-xl font-bold">AI</div>
                    <h3 class="mt-6 text-xl font-semibold text-sky-900">NLP Support</h3>
                    <p class="mt-3 text-gray-600 leading-relaxed">Advanced context-aware models process diverse linguistic expressions and cultural subtleties in English and other languages.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-sky-100 hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center text-xl font-bold">BI</div>
                    <h3 class="mt-6 text-xl font-semibold text-sky-900">Risk Heatmaps</h3>
                    <p class="mt-3 text-gray-600 leading-relaxed">Predictive dashboards highlight grievance hotspots across departments, institutions, and student groups, enabling data-driven interventions.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-sky-100 hover:-translate-y-1 transition">
                    <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl font-bold">CX</div>
                    <h3 class="mt-6 text-xl font-semibold text-sky-900">Resolution Playbooks</h3>
                    <p class="mt-3 text-gray-600 leading-relaxed">Automated best-practice workflows align student counselors, academic heads, and security teams around shared outcomes.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="mt-3 text-3xl md:text-4xl font-bold text-sky-900">A Glimpse Into Our AI-Enhanced Community</h2>
                <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                    From automated sentiment analysis to priority-driven resolutions, explore how our system integrates technology, empathy, and collaboration to nurture a responsive, inclusive institutional environment.
                </p>
            </div>
            <div class="mt-12 grid md:grid-cols-3 gap-6">
                <div class="group relative h-72 rounded-3xl overflow-hidden shadow-lg">
                    <img src="{{ asset('image/graduation.avif') }}" alt="AI innovation lab at Sri Lankan institute" class="w-full h-full object-cover transition-transform group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                </div>
                <div class="group relative h-72 rounded-3xl overflow-hidden shadow-lg">
                    <img src="{{ asset('image/0M8A4735-2.jpg') }}" alt="Student wellbeing lounge" class="w-full h-full object-cover transition-transform group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                </div>
                <div class="group relative h-72 rounded-3xl overflow-hidden shadow-lg">
                    <img src="{{ asset('image/IMG_9576.jpg') }}" alt="Sri Lankan cultural night on campus" class="w-full h-full object-cover transition-transform group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                </div>
                <div class="group relative h-72 rounded-3xl overflow-hidden shadow-lg">
                    <img src="{{ asset('image/Institute18.jpg') }}" alt="Complaint response team workshop" class="w-full h-full object-cover transition-transform group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                </div>
                <div class="group relative h-72 rounded-3xl overflow-hidden shadow-lg">
                    <img src="{{ asset('image/economics-dept.jpg') }}" alt="Students collaborating on projects" class="w-full h-full object-cover transition-transform group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                </div>
                <div class="group relative h-72 rounded-3xl overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=900&q=80" alt="Lecture hall at Sri Lankan institute" class="w-full h-full object-cover transition-transform group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-sky-900">
        <div class="max-w-5xl mx-auto px-6 text-white">
            <div class="text-center">
                <p class="text-sm font-semibold tracking-[0.35em] uppercase text-sky-200">Connect With Us</p>
                <h2 class="mt-3 text-3xl md:text-4xl font-bold">Let’s Foster a Fairer, More Responsive Institute Together</h2>
                <p class="mt-4 text-lg text-sky-100 leading-relaxed">
                    Our Student Affairs and AI Ethics teams at Educational Institute are ready to assist with system onboarding, training, and custom sentiment analytics tailored to your faculty.
                </p>
            </div>
            <div class="mt-12 grid md:grid-cols-3 gap-8">
                <div class="bg-white/10 border border-white/20 rounded-2xl p-6 backdrop-blur">
                    <h3 class="text-lg font-semibold">Email</h3>
                    <p class="mt-2 text-sky-100">support@edu.ac.lk</p>
                    <p class="text-sm text-sky-200 mt-1">Response within 1 business day</p>
                </div>
                <div class="bg-white/10 border border-white/20 rounded-2xl p-6 backdrop-blur">
                    <h3 class="text-lg font-semibold">Hotline</h3>
                    <p class="mt-2 text-sky-100">+94 11 456 7890</p>
                    <p class="text-sm text-sky-200 mt-1">Available 08:00 – 20:00</p>
                </div>
                <div class="bg-white/10 border border-white/20 rounded-2xl p-6 backdrop-blur">
                    <h3 class="text-lg font-semibold">Institute HQ</h3>
                    <p class="mt-2 text-sky-100">Centre, 45 Fernando Mawatha, Colombo 07, Sri Lanka</p>
                </div>
            </div>
            
        </div>
    </section>

@endsection
