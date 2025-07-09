<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Admissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Admissions List</h3>
                        <a href="{{ route('admissions.review') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Review Applications
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Application #</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Student Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Program</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($admissions as $admission)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $admission->application_no }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $admission->full_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $admission->program }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $admission->status === 'admitted' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $admission->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $admission->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ ucfirst($admission->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if ($admission->status === 'admitted')
                                                <a href="{{ route('admissions.offer-letter', $admission) }}"
                                                    class="text-green-600 hover:text-green-900 mr-3">Offer Letter</a>
                                            @endif
                                            {{-- @can('admit applications') --}}
                                                <form action="{{ route('admissions.transfer', $admission) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-green-600 hover:text-green-900 ml-2"
                                                        onclick="return confirm('Are you sure you want to admit this student?')">
                                                        Admit
                                                    </button>
                                                </form>
                                            {{-- @endcan --}}
                                            <a href="{{ route('admissions.show', $admission) }}"
                                                class="text-blue-600 hover:text-blue-900">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                            No admissions records found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        @can('admit applications')
                            <form action="{{ route('admissions.bulk') }}">
                                <!-- Bulk selection UI -->
                            </form>
                        @endcan
                        {{-- {{ $admissions->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
