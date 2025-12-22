<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="flex items-center mb-6">
                <a href="{{ route('faq.index') }}" 
                   class="text-blue-600 hover:text-blue-700 text-sm font-medium mr-2">Frequently Asked Questions</a>
                <span class="text-gray-400 mr-2">/</span>
                <span class="text-gray-600 text-sm font-medium">{{ $category->name }}</span>
            </div>
            
            <!-- Category Title -->
            <h1 class="text-4xl font-bold text-gray-900 mb-8">{{ $category->name }}</h1>
            
            <!-- FAQ Items -->
            <div class="space-y-4 mb-8">
                @forelse($category->faqItems as $item)
                    <div class="border border-gray-200 rounded-lg overflow-hidden bg-white">
                        <button 
                            type="button"
                            onclick="toggleAccordion(this)"
                            class="w-full text-left px-6 py-4 hover:bg-gray-50 transition flex items-center justify-between group"
                        >
                            <span class="font-semibold text-gray-900 pr-8">{{ $item->question }}</span>
                            <svg class="w-5 h-5 text-gray-400 transform transition-transform accordion-icon flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="accordion-content hidden px-6 pb-4 bg-white">
                            <p class="text-gray-600 leading-relaxed">{{ $item->answer }}</p>
                        </div>
                    </div>
                @empty
                    <div class="border border-gray-200 rounded-lg p-12 text-center bg-white">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No questions yet</h3>
                        <p class="mt-1 text-sm text-gray-500">This category doesn't have any FAQ items yet.</p>
                    </div>
                @endforelse
            </div>

            <!-- Contact CTA -->
            <div class="bg-blue-50 rounded-xl p-8 text-center border border-blue-100">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Still need help?</h3>
                <p class="text-gray-600 mb-6">If you can't find the answer you are looking for, please feel free to reach out to our support team.</p>
                <a href="{{ route('contact.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                    Contact Support
                </a>
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
