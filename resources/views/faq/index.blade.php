<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <!-- Header -->
                    <div class="mb-8">
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">Frequently Asked Questions</h1>
                        <p class="text-gray-600">Find answers to common questions about PageTurner</p>
                    </div>

                    @forelse($categories as $category)
                        <!-- Category Section -->
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-indigo-600 mb-4">{{ $category->name }}</h2>
                            
                            <div class="space-y-4">
                                @foreach($category->faqItems as $item)
                                    <!-- FAQ Item with Accordion -->
                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <button 
                                            type="button"
                                            onclick="toggleAccordion(this)"
                                            class="w-full text-left px-6 py-4 bg-gray-50 hover:bg-gray-100 transition flex items-center justify-between"
                                        >
                                            <span class="font-semibold text-gray-900">{{ $item->question }}</span>
                                            <svg class="w-5 h-5 text-gray-500 transform transition-transform accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        <div class="accordion-content hidden px-6 py-4 bg-white">
                                            <p class="text-gray-700">{{ $item->answer }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @if(!$loop->last)
                            <hr class="my-8">
                        @endif
                    @empty
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No FAQ items yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Check back later for frequently asked questions.</p>
                        </div>
                    @endforelse

                    <!-- Contact CTA -->
                    <div class="mt-12 p-6 bg-indigo-50 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Still have questions?</h3>
                        <p class="text-gray-600 mb-4">Can't find the answer you're looking for? We're here to help!</p>
                        <a href="#" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                            Contact Support
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Accordion Toggle Script -->
    <script>
        function toggleAccordion(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('.accordion-icon');
            
            // Toggle content visibility
            content.classList.toggle('hidden');
            
            // Rotate icon
            icon.classList.toggle('rotate-180');
        }
    </script>
</x-app-layout>
