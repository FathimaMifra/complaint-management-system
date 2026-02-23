<x-filament-panels::page>
    <div class="space-y-6">
        <!-- View Mode Toggle -->
        <div class="flex justify-end gap-2 mb-4">
            <button 
                wire:click="$set('viewMode', 'day')"
                class="px-4 py-2 rounded-lg {{ $viewMode === 'day' ? 'bg-primary-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                Day View
            </button>
            <button 
                wire:click="$set('viewMode', 'week')"
                class="px-4 py-2 rounded-lg {{ $viewMode === 'week' ? 'bg-primary-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                Week View
            </button>
        </div>

        <!-- Calendar Display -->
        @if($viewMode === 'week')
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="grid grid-cols-7 gap-0 border-b">
                    @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                        <div class="p-4 text-center font-semibold bg-gray-50 border-r last:border-r-0">
                            {{ $day }}
                        </div>
                    @endforeach
                </div>
                <div class="grid grid-cols-7 gap-0">
                    @php
                        $startOfWeek = now()->startOfWeek();
                        $complaints = $this->complaints;
                        $complaintsByDate = $complaints->groupBy('date');
                    @endphp
                    
                    @for($i = 0; $i < 7; $i++)
                        @php
                            $date = $startOfWeek->copy()->addDays($i);
                            $dateKey = $date->format('Y-m-d');
                            $dayComplaints = $complaintsByDate->get($dateKey, collect());
                        @endphp
                        <div class="min-h-[200px] border-r border-b last:border-r-0 p-2 {{ $date->isToday() ? 'bg-blue-50' : '' }}">
                            <div class="text-sm font-semibold mb-2 {{ $date->isToday() ? 'text-blue-600' : '' }}">
                                {{ $date->format('j') }}
                                @if($date->isToday())
                                    <span class="text-xs text-blue-500">(Today)</span>
                                @endif
                            </div>
                            <div class="space-y-1">
                                @foreach($dayComplaints as $complaint)
                                    <a href="{{ $complaint['url'] }}" 
                                       class="block text-xs p-2 rounded hover:opacity-80 transition
                                              {{ $complaint['status'] === 'resolved' ? 'bg-green-100 text-green-800' : 
                                                 ($complaint['priority'] === 'high' ? 'bg-red-100 text-red-800' : 
                                                 ($complaint['priority'] === 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800')) }}">
                                        <div class="font-semibold truncate">{{ $complaint['title'] }}</div>
                                        <div class="text-xs opacity-75">{{ $complaint['user'] }}</div>
                                        <div class="text-xs opacity-75 capitalize">{{ str_replace('-', ' ', $complaint['status']) }}</div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        @else
            <!-- Day View -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b bg-gray-50">
                    <h3 class="text-lg font-semibold">{{ now()->format('l, F j, Y') }}</h3>
                </div>
                <div class="p-6">
                    @php
                        $today = now()->format('Y-m-d');
                        $dayComplaints = $this->complaints->where('date', $today);
                    @endphp
                    
                    @if($dayComplaints->count() > 0)
                        <div class="space-y-4">
                            @foreach($dayComplaints as $complaint)
                                <div class="border rounded-lg p-4 hover:shadow-md transition">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-semibold text-lg">
                                            <a href="{{ $complaint['url'] }}" class="text-primary-600 hover:underline">
                                                {{ $complaint['title'] }}
                                            </a>
                                        </h4>
                                        <div class="flex gap-2">
                                            <span class="px-2 py-1 text-xs rounded-full capitalize
                                                {{ $complaint['status'] === 'resolved' ? 'bg-green-100 text-green-800' : 
                                                   ($complaint['status'] === 'in-progress' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ $complaint['status'] }}
                                            </span>
                                            <span class="px-2 py-1 text-xs rounded-full capitalize
                                                {{ $complaint['priority'] === 'high' ? 'bg-red-100 text-red-800' : 
                                                   ($complaint['priority'] === 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                {{ $complaint['priority'] }} Priority
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600">User: {{ $complaint['user'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 text-gray-500">
                            <p>No complaints scheduled for today.</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>

