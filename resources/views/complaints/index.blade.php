@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Your Complaints</h1>
        @if (auth()->user()->complaints->isEmpty())
            <p class="text-gray-600 text-center">No complaints found.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sentiment</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urgency</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach (auth()->user()->complaints as $complaint)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $complaint->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($complaint->category) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($complaint->status) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $complaint->ai_analysis['sentiment'] ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $complaint->ai_analysis['urgency'] ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <a href="{{ route('complaints.create') }}" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Submit New Complaint</a>
    </div>
@endsection
