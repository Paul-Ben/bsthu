<x-app-layout>
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="text-center mb-8">
        <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <h1 class="mt-4 text-3xl font-bold text-gray-900">Application Submitted Successfully!</h1>
        <p class="mt-2 text-gray-600">Your application ID is #{{ $application->id }}</p>
    </div>

    <div class="bg-gray-50 p-6 rounded-lg">
        <h2 class="text-lg font-semibold mb-4">Next Steps</h2>
        <ul class="list-disc pl-6 space-y-2 text-gray-700">
            <li>Check your email for confirmation</li>
            <li>Application review typically takes 3-5 business days</li>
            <li>Contact admissions@example.com with questions</li>
        </ul>
    </div>

    <div class="mt-8 text-center">
        <a href="/" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
            Return to Homepage
        </a>
    </div>
</div>
</x-app-layout>