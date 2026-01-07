<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-stone-100 mb-3 font-serif">Frequently Asked Questions</h1>
                <p class="text-stone-400 text-lg">Find answers to common questions and get support.</p>
            </div>

            @forelse($categories as $category)
                <!-- Category Card -->
                <a href="{{ route('faq.show', $category->slug) }}" 
                   class="block bg-stone-900 rounded-xl p-6 mb-4 hover:bg-stone-800 transition border border-stone-800 group shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-stone-100 mb-1 font-serif">{{ $category->name }}</h2>
                            <p class="text-stone-500 text-sm">
                                @if($category->faq_items_count > 0)
                                    {{ $category->faq_items_count }} {{ Str::plural('question', $category->faq_items_count) }} available
                                @else
                                    Learn about {{ strtolower($category->name) }}
                                @endif
                            </p>
                        </div>
                        <svg class="w-6 h-6 text-stone-600 group-hover:text-amber-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
            @empty
                <div class="bg-stone-900 rounded-xl p-12 text-center border border-stone-800">
                    <svg class="mx-auto h-12 w-12 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-stone-200">No FAQ items yet</h3>
                    <p class="mt-1 text-sm text-stone-500">Check back later for frequently asked questions.</p>
                </div>
            @endforelse

            <!-- Contact CTA -->
            <div class="bg-stone-900 rounded-xl p-8 text-center border border-stone-800 mt-8 shadow-sm">
                <h3 class="text-xl font-bold text-stone-100 mb-2 font-serif">Still need help?</h3>
                <p class="text-stone-400 mb-6">If you can't find the answer you are looking for, please feel free to reach out to our support team.</p>
                <a href="{{ route('contact.create') }}" class="inline-flex items-center px-6 py-3 bg-amber-600 text-stone-100 font-semibold rounded-lg hover:bg-amber-500 transition shadow-lg shadow-amber-900/20">
                    Contact Support
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
