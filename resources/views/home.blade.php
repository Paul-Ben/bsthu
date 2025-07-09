<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white">
        <!-- Hero Section -->
        <div class="container mx-auto px-4 py-20 text-center">
            <h1 class="text-5xl font-bold text-blue-800 mb-6">Welcome to BSTHU University</h1>
            <p class="text-xl text-gray-600 mb-8">Transform your future through quality education</p>
            <a href="{{ route('applications.create') }}" 
               class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                Apply Now
            </a>
        </div>

        <!-- Features Grid -->
        <div class="container mx-auto px-4 py-16 grid md:grid-cols-3 gap-8">
            <div class="p-6 bg-white rounded-xl shadow-lg">
                <h3 class="text-xl font-semibold mb-3">100+ Programs</h3>
                <p class="text-gray-600">Explore undergraduate and postgraduate programs across various disciplines</p>
            </div>
            <div class="p-6 bg-white rounded-xl shadow-lg">
                <h3 class="text-xl font-semibold mb-3">Online Application</h3>
                <p class="text-gray-600">Simple and secure application process with real-time tracking</p>
            </div>
            <div class="p-6 bg-white rounded-xl shadow-lg">
                <h3 class="text-xl font-semibold mb-3">24/7 Support</h3>
                <p class="text-gray-600">Get assistance anytime through our admission helpdesk</p>
            </div>
        </div>
    </div>
</x-app-layout>