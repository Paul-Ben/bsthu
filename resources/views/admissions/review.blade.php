<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Application Review') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-6">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div>
                            <x-input-label for="min_score" :value="__('Minimum Score')" />
                            <x-text-input id="min_score" name="min_score" type="number" class="mt-1 block w-full" 
                                :value="request('min_score')" placeholder="Enter minimum qualification score" />
                        </div>
                        
                        <div>
                            <x-input-label for="program_id" :value="__('Program')" />
                            <select id="program_id" name="program_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">All Programs</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" {{ request('program_id') == $program->id ? 'selected' : '' }}>
                                        {{ $program->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex gap-2">
                            <x-primary-button type="submit">
                                Filter Applications
                            </x-primary-button>
                            <x-secondary-button href="{{ route('admissions.review') }}">
                                Clear Filters
                            </x-secondary-button>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Application #</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qualification Score</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($applications as $application)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $application->application_no }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $application->full_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $application->qualification_score }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $application->department->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($application->qualification_score >= 70)
                                                <form method="POST" action="{{ route('admissions.create-student', $application) }}" class="inline">
                                                    @csrf
                                                    <x-primary-button type="submit">
                                                        Admit Student
                                                    </x-primary-button>
                                                </form>
                                            @else
                                                <span class="text-gray-500">Doesn't meet score requirements</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    // Add empty state for filters
                                    @if($applications->isEmpty() && $request->anyFilled(['min_score', 'program_id']))
                                      <div class="bg-yellow-50 p-4 rounded-lg">
                                        No applications match the current filters
                                      </div>
                                    @endif
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $applications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>