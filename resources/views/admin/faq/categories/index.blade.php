<x-admin-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="flex" style="min-height: 600px;">
                    <!-- Left Sidebar: Categories -->
                    <div class="w-1/3 border-r border-gray-200 bg-gray-50">
                        <div class="p-6 border-b border-gray-200 bg-white">
                            <div class="flex justify-between items-center mb-1">
                                <h2 class="text-lg font-semibold text-gray-900">Categories</h2>
                                <a href="{{ route('admin.faq.categories.create') }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    New Category
                                </a>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            @forelse($categories as $category)
                                <button 
                                    onclick="selectCategory({{ $category->id }})"
                                    data-category-id="{{ $category->id }}"
                                    class="category-item w-full text-left p-3 rounded-lg mb-2 transition hover:bg-white {{ $loop->first ? 'bg-blue-50 border border-blue-200' : 'hover:border hover:border-gray-200' }}">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                        </svg>
                                        <span class="font-medium text-gray-900">{{ $category->name }}</span>
                                    </div>
                                </button>
                            @empty
                                <p class="text-gray-500 text-sm text-center py-8">No categories yet</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Right Content: Selected Category Details -->
                    <div class="flex-1">
                        @forelse($categories as $category)
                            <div id="category-{{ $category->id }}" class="category-content {{ $loop->first ? '' : 'hidden' }}">
                                <div class="p-6 border-b border-gray-200">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $category->name }}</h1>
                                            <p class="text-sm text-gray-500">Slug: <span class="font-mono">{{ $category->slug }}</span> • Order: {{ $category->order }}</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.faq.categories.edit', $category) }}" 
                                               class="inline-flex items-center px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit Category
                                            </a>
                                            <form action="{{ route('admin.faq.categories.destroy', $category) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Are you sure? This will also delete all FAQ items in this category.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition text-sm">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-semibold text-gray-900">Questions in this category</h3>
                                        <a href="{{ route('admin.faq.items.create', ['category' => $category->id]) }}" 
                                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                            New Question
                                        </a>
                                    </div>

                                    <div class="space-y-3">
                                        @forelse($category->faqItems as $item)
                                            <div class="border border-gray-200 rounded-lg overflow-hidden bg-white">
                                                <button 
                                                    type="button"
                                                    onclick="toggleFaqItem(this)"
                                                    class="w-full text-left px-4 py-3 hover:bg-gray-50 transition flex items-start justify-between group"
                                                >
                                                    <div class="flex items-start flex-1">
                                                        <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span class="font-medium text-gray-900 pr-4">{{ $item->question }}</span>
                                                    </div>
                                                    <svg class="w-5 h-5 text-gray-400 faq-icon flex-shrink-0" style="transition: transform 0.3s ease;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </button>
                                                <div class="faq-content hidden px-4 pb-3 bg-gray-50" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                                                    <p class="text-gray-600 text-sm leading-relaxed mb-3 ml-8">{{ $item->answer }}</p>
                                                    <div class="flex space-x-3 ml-8">
                                                        <a href="{{ route('admin.faq.items.edit', $item->id) }}" 
                                                           class="text-sm text-blue-600 hover:text-blue-700">Edit</a>
                                                        <span class="text-gray-300">|</span>
                                                        <form action="{{ route('admin.faq.items.destroy', $item->id) }}" 
                                                              method="POST" 
                                                              class="inline"
                                                              onsubmit="return confirm('Are you sure you want to delete this FAQ item?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-sm text-red-600 hover:text-red-700">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-200">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <h3 class="mt-2 text-sm font-medium text-gray-900">No questions yet</h3>
                                                <p class="mt-1 text-sm text-gray-500">Get started by creating a new question.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No categories</h3>
                                <p class="mt-1 text-sm text-gray-500">Get started by creating a new FAQ category.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectCategory(id) {
            // Hide all category contents with fade
            document.querySelectorAll('.category-content').forEach(el => {
                el.style.opacity = '0';
                setTimeout(() => el.classList.add('hidden'), 150);
            });
            
            // Show selected category with fade
            const selected = document.getElementById('category-' + id);
            setTimeout(() => {
                selected.classList.remove('hidden');
                setTimeout(() => selected.style.opacity = '1', 10);
            }, 150);
            
            // Update category item styling
            document.querySelectorAll('.category-item').forEach(el => {
                el.classList.remove('bg-blue-50', 'border', 'border-blue-200');
                el.classList.add('hover:border', 'hover:border-gray-200');
            });
            const categoryBtn = document.querySelector('[data-category-id="' + id + '"]');
            categoryBtn.classList.add('bg-blue-50', 'border', 'border-blue-200');
            categoryBtn.classList.remove('hover:border', 'hover:border-gray-200');
        }

        function toggleFaqItem(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('.faq-icon');
            const isHidden = content.classList.contains('hidden');
            
            if (isHidden) {
                content.classList.remove('hidden');
                // Trigger reflow for smooth animation
                content.offsetHeight;
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.style.transform = 'rotate(180deg)';
            } else {
                content.style.maxHeight = '0';
                icon.style.transform = 'rotate(0deg)';
                setTimeout(() => content.classList.add('hidden'), 300);
            }
        }

        // Initialize opacity for transitions
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.category-content').forEach(el => {
                el.style.transition = 'opacity 0.15s ease-in-out';
                if (!el.classList.contains('hidden')) {
                    el.style.opacity = '1';
                }
            });
        });
    </script>
</x-admin-layout>
