<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('applications.index') }}" class="p-6 bg-white border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
                            <h3 class="text-lg font-semibold text-blue-600">Applications Module</h3>
                            <p class="text-gray-600 mt-2">Manage student applications and documents</p>
                        </a>
                        
                        <a href="{{ route('admissions.index') }}" class="p-6 bg-white border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
                            <h3 class="text-lg font-semibold text-green-600">Admissions Module</h3>
                            <p class="text-gray-600 mt-2">Review applications and manage admissions</p>
                        </a>
                    </div>
                    
                    <div class="mt-8 text-center text-gray-500">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
