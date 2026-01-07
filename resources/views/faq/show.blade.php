<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="flex items-center mb-6">
                <a href="{{ route('faq.index') }}" 
                   class="text-amber-500 hover:text-amber-400 text-sm font-medium mr-2 transition">Frequently Asked Questions</a>
                <span class="text-stone-600 mr-2">/</span>
                <span class="text-stone-400 text-sm font-medium">{{ $category->name }}</span>
            </div>
            
            <!-- Category Title -->
            <h1 class="text-4xl font-bold text-stone-100 mb-8 font-serif">{{ $category->name }}</h1>
            
            <!-- FAQ Items -->
            <div class="space-y-4 mb-8">
                @forelse($category->faqItems as $item)
                    <div class="border border-stone-800 rounded-lg overflow-hidden bg-stone-900">
                        <button 
                            type="button"
                            onclick="toggleAccordion(this)"
                            class="w-full text-left px-6 py-4 hover:bg-stone-800 transition flex items-center justify-between group"
                        >
                            <span class="font-semibold text-stone-100 pr-8 font-serif">{{ $item->question }}</span>
                            <svg class="w-5 h-5 text-stone-500 group-hover:text-amber-500 transform transition-all accordion-icon flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="accordion-content hidden px-6 pb-4 bg-stone-900 border-t border-stone-800">
                            <div class="pt-4 text-stone-400 leading-relaxed prose prose-stone prose-invert max-w-none">
                                {!! nl2br(e($item->answer)) !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="border border-stone-800 rounded-lg p-12 text-center bg-stone-900">
                        <svg class="mx-auto h-12 w-12 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-stone-200">No questions yet</h3>
                        <p class="mt-1 text-sm text-stone-500">This category doesn't have any FAQ items yet.</p>
                    </div>
                @endforelse
            </div>

            <!-- Contact CTA -->
            <div class="bg-stone-900 rounded-xl p-8 text-center border border-stone-800 shadow-sm">
                <h3 class="text-xl font-bold text-stone-100 mb-2 font-serif">Still need help?</h3>
                <p class="text-stone-400 mb-6">If you can't find the answer you are looking for, please feel free to reach out to our support team.</p>
                <a href="{{ route('contact.create') }}" class="inline-flex items-center px-6 py-3 bg-amber-600 text-stone-100 font-semibold rounded-lg hover:bg-amber-500 transition shadow-lg shadow-amber-900/20">
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
