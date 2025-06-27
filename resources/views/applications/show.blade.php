<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Application Details') }} - {{ $application->application_no }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('applications.index') }}" class="text-blue-600 hover:text-blue-900">&larr; Back to Applications</a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->full_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->email }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->phone }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Gender</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($application->gender) }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Date of Birth</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->dob->format('F j, Y') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">Location Information</h3>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Country</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->country }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">State</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->state }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">LGA</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->lga }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div class="md:col-span-2">
                            <h3 class="text-lg font-semibold mb-4">Application Details</h3>
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Application Number</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->application_no }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Program Applied</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->department->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $application->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $application->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Submitted At</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $application->created_at->format('F j, Y H:i:s') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    @if($application->document_path)
                        <div class="mt-8 flex justify-end">
                            <a href="{{ route('applications.download', $application) }}" 
                               class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Download Documents
                            </a>
                        </div>
                    @endif

                    @if(auth()->user()->is_admin && $application->status === 'pending')
                        <div class="mt-8 border-t pt-6">
                            <h3 class="text-lg font-semibold mb-4">Update Application Status</h3>
                            <form action="{{ route('applications.update', $application) }}" method="POST" class="flex items-center space-x-4">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="approved">Approve</option>
                                    <option value="rejected">Reject</option>
                                </select>
                                <x-primary-button>Update Status</x-primary-button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>