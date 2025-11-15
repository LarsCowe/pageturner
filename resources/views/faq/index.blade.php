<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-gray-900 mb-3">Frequently Asked Questions</h1>
                <p class="text-gray-500 text-lg">Find answers to common questions and get support.</p>
            </div>

            @forelse($categories as $category)
                <!-- Category Card -->
                <a href="{{ route('faq.show', $category->slug) }}" 
                   class="block bg-white rounded-xl p-6 mb-4 hover:shadow-md transition-shadow border border-gray-200 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 mb-1">{{ $category->name }}</h2>
                            <p class="text-gray-500 text-sm">
                                @if($category->faq_items_count > 0)
                                    {{ $category->faq_items_count }} {{ Str::plural('question', $category->faq_items_count) }} available
                                @else
                                    Learn about {{ strtolower($category->name) }}
                                @endif
                            </p>
                        </div>
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
            @empty
                <div class="bg-white rounded-xl p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No FAQ items yet</h3>
                    <p class="mt-1 text-sm text-gray-500">Check back later for frequently asked questions.</p>
                </div>
            @endforelse

            <!-- Contact CTA -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-8 text-center border border-blue-100 mt-8">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Still need help?</h3>
                <p class="text-gray-600 mb-6">If you can't find the answer you are looking for, please feel free to reach out to our support team.</p>
                <a href="#" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                    Contact Support
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
