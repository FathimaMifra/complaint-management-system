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
                            class="bg-sky-900 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded">
                            Create New Complaint
                        </a>
                        @endcan
                    </div>

                    @if($complaints->count() > 0)
                    <div class="overflow-x-auto bg-white shadow-lg rounded-xl">
                        <table class="min-w-full text-sm text-left text-gray-700">
                            <thead class="text-black bg-gray-300">
                                <tr>
                                    <th class="px-6 py-3">
                                        Title
                                    </th>
                                    {{-- <th
                                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Category
                                    </th> --}}
                                    <th class="px-6 py-3">
                                        Status
                                    </th>
                                    @if(auth()->user()->hasRole(['Admin', 'Manager']))
                                        <th class="px-6 py-3">
                                            User
                                        </th>
                                    @endif
                                    <th class="px-6 py-3">
                                        Created
                                    </th>
                                    <th class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($complaints as $complaint)
                                    <tr class="hover:bg-gray-50 border-b transition duration-200">
                                        <td class="px-6 py-4 font-medium text-gray-900"> {{ $complaint->title }} </td>

                                        {{-- <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        @if($complaint->category === 'service') bg-blue-100 text-blue-800
                                                        @elseif($complaint->category === 'billing') bg-yellow-100 text-yellow-800
                                                        @elseif($complaint->category === 'product') bg-green-100 text-green-800
                                                        @else bg-gray-100 text-gray-800
                                                        @endif">
                                                {{ ucfirst($complaint->category) }}
                                            </span>
                                        </td> --}}

                                        <td class="px-6 py-4">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'in-progress' => 'bg-blue-100 text-blue-800',
                                                    'resolved' => 'bg-green-100 text-green-800'
                                                ];
                                            @endphp
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusColors[$complaint->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst(str_replace('-', ' ', $complaint->status)) }}
                                            </span>
                                        </td>

                                        @if(auth()->user()->hasRole(['Admin', 'Manager']))
                                            <td class="px-6 py-4">{{ $complaint->user->name }}</td>
                                        @endif

                                        <td class="px-6 py-4">{{ $complaint->created_at->format('M d, Y') }}</td>

                                        <td class="px-6 py-4 flex space-x-3">
                                            <a href="{{ route('complaints.show', $complaint) }}"
                                                class="text-blue-500 hover:text-blue-700 transition" title="View">
                                                view
                                            </a>

                                            @if(auth()->user()->role === 'Admin')
                                                <a href="{{ route('complaints.edit', $complaint) }}"
                                                    class="text-yellow-500 hover:text-yellow-700 transition" title="Edit">
                                                    ✏️
                                                </a>

                                                <form action="{{ route('complaints.destroy', $complaint) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="return confirm('Are you sure?')"
                                                            class="text-red-500 hover:text-red-700 transition" title="Delete">
                                                        🗑
                                                    </button>
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
