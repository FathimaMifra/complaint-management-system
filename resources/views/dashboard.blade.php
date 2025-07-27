<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">Welcome, {{ auth()->user()->name }}!</h3>
                        <p class="text-gray-600">Role: {{ auth()->user()->roles->first()->name ?? 'No Role Assigned' }}
                        </p>
                    </div>

                    @if(auth()->user()->hasRole(['Admin', 'Manager']))
                    <!-- Admin/Manager Dashboard -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-blue-100 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-blue-800">Total Complaints</h4>
                            <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Complaint::count() }}</p>
                        </div>
                        <div class="bg-yellow-100 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-yellow-800">Pending Complaints</h4>
                            <p class="text-3xl font-bold text-yellow-600">{{ \App\Models\Complaint::where('status',
                                'pending')->count() }}</p>
                        </div>
                        <div class="bg-green-100 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-green-800">Resolved Complaints</h4>
                            <p class="text-3xl font-bold text-green-600">{{ \App\Models\Complaint::where('status',
                                'resolved')->count() }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white border rounded-lg p-6">
                            <h4 class="text-lg font-semibold mb-4">Recent Complaints</h4>
                            @php
                            $recentComplaints = \App\Models\Complaint::with('user')->latest()->take(5)->get();
                            @endphp
                            @if($recentComplaints->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentComplaints as $complaint)
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                                    <div>
                                        <p class="font-medium">{{ $complaint->title }}</p>
                                        <p class="text-sm text-gray-600">by {{ $complaint->user->name }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                                    @if($complaint->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($complaint->status === 'in-progress') bg-blue-100 text-blue-800
                                                    @elseif($complaint->status === 'resolved') bg-green-100 text-green-800
                                                    @endif">
                                        {{ ucfirst(str_replace('-', ' ', $complaint->status)) }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p class="text-gray-500">No complaints found.</p>
                            @endif
                        </div>

                        <div class="bg-white border rounded-lg p-6">
                            <h4 class="text-lg font-semibold mb-4">Quick Actions</h4>
                            <div class="space-y-3">
                                <a href="{{ route('complaints.index') }}"
                                    class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                                    View All Complaints
                                </a>
                                @if(auth()->user()->hasRole('Admin'))
                                <a href="{{ route('filament.admin.pages.dashboard') }}"
                                    class="block w-full bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-center">
                                    Admin Panel
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- Regular User Dashboard -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-blue-100 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-blue-800">My Complaints</h4>
                            <p class="text-3xl font-bold text-blue-600">{{ auth()->user()->complaints()->count() }}</p>
                        </div>
                        <div class="bg-yellow-100 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-yellow-800">Pending</h4>
                            <p class="text-3xl font-bold text-yellow-600">{{
                                auth()->user()->complaints()->where('status', 'pending')->count() }}</p>
                        </div>
                        <div class="bg-green-100 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-green-800">Resolved</h4>
                            <p class="text-3xl font-bold text-green-600">{{
                                auth()->user()->complaints()->where('status', 'resolved')->count() }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white border rounded-lg p-6">
                            <h4 class="text-lg font-semibold mb-4">My Recent Complaints</h4>
                            @php
                            $myComplaints = auth()->user()->complaints()->latest()->take(5)->get();
                            @endphp
                            @if($myComplaints->count() > 0)
                            <div class="space-y-3">
                                @foreach($myComplaints as $complaint)
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                                    <div>
                                        <p class="font-medium">{{ $complaint->title }}</p>
                                        <p class="text-sm text-gray-600">{{ $complaint->created_at->format('M d, Y') }}
                                        </p>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                                    @if($complaint->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($complaint->status === 'in-progress') bg-blue-100 text-blue-800
                                                    @elseif($complaint->status === 'resolved') bg-green-100 text-green-800
                                                    @endif">
                                        {{ ucfirst(str_replace('-', ' ', $complaint->status)) }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p class="text-gray-500">No complaints found.</p>
                            @endif
                        </div>

                        <div class="bg-white border rounded-lg p-6">
                            <h4 class="text-lg font-semibold mb-4">Quick Actions</h4>
                            <div class="space-y-3">
                                <a href="{{ route('complaints.create') }}"
                                    class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                                    Submit New Complaint
                                </a>
                                <a href="{{ route('complaints.index') }}"
                                    class="block w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-center">
                                    View My Complaints
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>