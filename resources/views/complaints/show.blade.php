<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Complaint Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('complaints.index') }}" class="text-indigo-600 hover:text-indigo-900">
                            ← Back to Complaints
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Complaint Information</h3>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Title</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $complaint->title }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Description</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $complaint->description }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Category</label>
                                    <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                        @if($complaint->category === 'service') bg-blue-100 text-blue-800
                                        @elseif($complaint->category === 'billing') bg-yellow-100 text-yellow-800
                                        @elseif($complaint->category === 'product') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($complaint->category) }}
                                    </span>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Status</label>
                                    <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                        @if($complaint->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($complaint->status === 'in-progress') bg-blue-100 text-blue-800
                                        @elseif($complaint->status === 'resolved') bg-green-100 text-green-800
                                        @endif">
                                        {{ ucfirst(str_replace('-', ' ', $complaint->status)) }}
                                    </span>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Created By</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $complaint->user->name }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Created At</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $complaint->created_at->format('F d, Y \a\t
                                        g:i A') }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $complaint->updated_at->format('F d, Y \a\t
                                        g:i A') }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">AI Analysis</h3>

                            @if(isset($complaint->ai_analysis) && !isset($complaint->ai_analysis['error']))
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Sentiment</label>
                                    <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($complaint->ai_analysis['sentiment'] === 'positive') bg-green-100 text-green-800
                                            @elseif($complaint->ai_analysis['sentiment'] === 'negative') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                        {{ ucfirst($complaint->ai_analysis['sentiment'] ?? 'N/A') }}
                                    </span>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Confidence</label>
                                    <p class="mt-1 text-sm text-gray-900">{{
                                        number_format(($complaint->ai_analysis['confidence'] ?? 0) * 100, 1) }}%</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Urgency</label>
                                    <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($complaint->ai_analysis['urgency'] === 'high') bg-red-100 text-red-800
                                            @else bg-green-100 text-green-800
                                            @endif">
                                        {{ ucfirst($complaint->ai_analysis['urgency'] ?? 'N/A') }}
                                    </span>
                                </div>
                            </div>
                            @else
                            <p class="text-sm text-gray-500">AI analysis not available</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 flex space-x-3">
                        @if(auth()->user()->hasRole(['Admin', 'Manager']))
                        <a href="{{ route('complaints.edit', $complaint) }}"
                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Edit Complaint
                        </a>
                        @endif

                        @if(auth()->user()->hasRole('Admin'))
                        <form action="{{ route('complaints.destroy', $complaint) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                onclick="return confirm('Are you sure you want to delete this complaint?')">
                                Delete Complaint
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>