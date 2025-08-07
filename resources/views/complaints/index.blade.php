@extends('layouts.user')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">All Complaints</h3>
                        @can('create complaints')
                        <a href="{{ route('complaints.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create New Complaint
                        </a>
                        @endcan
                    </div>

                    @if($complaints->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Title</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Category</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Status</th>
                                    @if(auth()->user()->hasRole(['Admin', 'Manager']))
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        User</th>
                                    @endif
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Created</th>
                                    <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach($complaints as $complaint)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-gray-900">{{ $complaint->title }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if($complaint->category === 'service') bg-blue-100 text-blue-800
                                                    @elseif($complaint->category === 'billing') bg-yellow-100 text-yellow-800
                                                    @elseif($complaint->category === 'product') bg-green-100 text-green-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif">
                                            {{ ucfirst($complaint->category) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if($complaint->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($complaint->status === 'in-progress') bg-blue-100 text-blue-800
                                                    @elseif($complaint->status === 'resolved') bg-green-100 text-green-800
                                                    @endif">
                                            {{ ucfirst(str_replace('-', ' ', $complaint->status)) }}
                                        </span>
                                    </td>
                                    @if(auth()->user()->hasRole(['Admin', 'Manager']))
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-gray-900">{{ $complaint->user->name }}</div>
                                    </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-gray-900">{{
                                            $complaint->created_at->format('M d, Y') }}</div>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm font-medium">
                                        <a href="{{ route('complaints.show', $complaint) }}"
                                            class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                                        @if(auth()->user()->hasRole(['Admin', 'Manager']))
                                        <a href="{{ route('complaints.edit', $complaint) }}"
                                            class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</a>
                                        @endif
                                        @if(auth()->user()->hasRole('Admin'))
                                        <form action="{{ route('complaints.destroy', $complaint) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $complaints->links() }}
                    </div>
                    @else
                    <div class="text-center py-8">
                        <p class="text-gray-500">No complaints found.</p>
                        @can('create complaints')
                        <a href="{{ route('complaints.create') }}"
                            class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create Your First Complaint
                        </a>
                        @endcan
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
