<x-admin-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-stone-900 rounded-lg shadow-lg border border-stone-800 overflow-hidden">
                <div class="flex" style="min-height: 600px;">
                    <!-- Left Sidebar: Categories -->
                    <div class="w-1/3 border-r border-stone-800 bg-stone-900">
                        <div class="p-6 border-b border-stone-800 bg-stone-900">
                            <div class="flex justify-between items-center mb-1">
                                <h2 class="text-xl font-serif font-bold text-stone-100">Categories</h2>
                                <a href="{{ route('admin.faq.categories.create') }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-amber-600 text-white text-sm font-medium rounded-lg hover:bg-amber-500 transition-colors shadow-lg shadow-amber-900/20">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    New Category
                                </a>
                            </div>
                        </div>
                        
                        <div class="p-4 space-y-1">
                            @forelse($categories as $category)
                                <button 
                                    onclick="selectCategory({{ $category->id }})"
                                    data-category-id="{{ $category->id }}"
                                    class="category-item w-full text-left p-3 rounded-lg transition-all duration-200 group {{ $loop->first ? 'bg-stone-800/80 border border-amber-500/20 shadow-sm' : 'hover:bg-stone-800/50 border border-transparent hover:border-stone-700' }}">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-3 {{ $loop->first ? 'text-amber-500' : 'text-stone-600 group-hover:text-amber-500/70' }} transition-colors category-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                        </svg>
                                        <span class="font-medium {{ $loop->first ? 'text-amber-500' : 'text-stone-400 group-hover:text-stone-200' }} transition-colors category-text">{{ $category->name }}</span>
                                    </div>
                                </button>
                            @empty
                                <p class="text-stone-500 text-sm text-center py-8">No categories yet</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Right Content: Selected Category Details -->
                    <div class="flex-1 bg-stone-900">
                        @forelse($categories as $category)
                            <div id="category-{{ $category->id }}" class="category-content {{ $loop->first ? '' : 'hidden' }}">
                                <div class="p-6 border-b border-stone-800">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h1 class="text-3xl font-serif font-bold text-stone-100 mb-2">{{ $category->name }}</h1>
                                            <p class="text-sm text-stone-500">Slug: <span class="font-mono text-amber-500/70">{{ $category->slug }}</span> • Order: <span class="text-stone-300">{{ $category->order }}</span></p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.faq.categories.edit', $category) }}" 
                                               class="inline-flex items-center px-3 py-2 bg-stone-800 text-stone-300 rounded-lg hover:bg-stone-700 hover:text-white transition-colors text-sm border border-stone-700">
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
                                                        class="inline-flex items-center px-3 py-2 bg-red-900/20 text-red-400 border border-red-900/30 rounded-lg hover:bg-red-900/40 hover:text-red-300 transition-colors text-sm">
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
                                    <div class="flex justify-between items-center mb-6">
                                        <h3 class="text-lg font-serif font-medium text-stone-200">Questions in this category</h3>
                                        <a href="{{ route('admin.faq.items.create', ['category' => $category->id]) }}" 
                                           class="inline-flex items-center px-4 py-2 bg-stone-800 text-stone-300 text-sm font-medium rounded-lg hover:bg-stone-700 hover:text-white transition-colors border border-stone-700">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                            New Question
                                        </a>
                                    </div>

                                    <div class="space-y-3">
                                        @forelse($category->faqItems as $item)
                                            <div class="border border-stone-800 rounded-lg overflow-hidden bg-stone-950/50">
                                                <button 
                                                    type="button"
                                                    onclick="toggleFaqItem(this)"
                                                    class="w-full text-left px-4 py-3 hover:bg-stone-900 transition flex items-start justify-between group"
                                                >
                                                    <div class="flex items-start flex-1">
                                                        <svg class="w-5 h-5 text-stone-600 group-hover:text-amber-500 mr-3 mt-0.5 flex-shrink-0 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span class="font-medium text-stone-300 group-hover:text-stone-100 pr-4 transition-colors">{{ $item->question }}</span>
                                                    </div>
                                                    <svg class="w-5 h-5 text-stone-600 group-hover:text-stone-400 faq-icon flex-shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </button>
                                                <div class="faq-content hidden bg-stone-900/50 border-t border-stone-800" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                                                    <div class="px-4 py-4 pl-12">
                                                        <p class="text-stone-400 text-sm leading-relaxed mb-4 whitespace-pre-line">{{ $item->answer }}</p>
                                                        <div class="flex items-center space-x-3 pt-2">
                                                            <a href="{{ route('admin.faq.items.edit', $item->id) }}" 
                                                               class="text-xs font-medium text-amber-600 hover:text-amber-500 transition-colors uppercase tracking-wider">Edit</a>
                                                            <span class="text-stone-700">|</span>
                                                            <form action="{{ route('admin.faq.items.destroy', $item->id) }}" 
                                                                  method="POST" 
                                                                  class="inline"
                                                                  onsubmit="return confirm('Are you sure you want to delete this FAQ item?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-xs font-medium text-red-500 hover:text-red-400 transition-colors uppercase tracking-wider">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center py-12 bg-stone-900/50 rounded-lg border-2 border-dashed border-stone-800">
                                                <svg class="mx-auto h-12 w-12 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <h3 class="mt-2 text-sm font-medium text-stone-300">No questions yet</h3>
                                                <p class="mt-1 text-sm text-stone-500">Get started by creating a new question.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-stone-300">No categories</h3>
                                <p class="mt-1 text-sm text-stone-500">Get started by creating a new FAQ category.</p>
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
            const items = document.querySelectorAll('.category-item');
            items.forEach(el => {
                // Reset to inactive state
                el.classList.remove('bg-stone-800/80', 'border-amber-500/20', 'shadow-sm');
                el.classList.add('hover:bg-stone-800/50', 'border-transparent', 'hover:border-stone-700');
                
                // Reset text colors
                const textSpan = el.querySelector('.category-text');
                textSpan.classList.remove('text-amber-500');
                textSpan.classList.add('text-stone-400');
                
                // Reset icon colors
                const icon = el.querySelector('.category-icon');
                icon.classList.remove('text-amber-500');
                icon.classList.add('text-stone-600');
            });

            // Activate current item
            const categoryBtn = document.querySelector('[data-category-id="' + id + '"]');
            categoryBtn.classList.remove('hover:bg-stone-800/50', 'border-transparent', 'hover:border-stone-700');
            categoryBtn.classList.add('bg-stone-800/80', 'border-amber-500/20', 'shadow-sm', 'border');
            
            // Activate text color
            const activeText = categoryBtn.querySelector('.category-text');
            activeText.classList.remove('text-stone-400');
            activeText.classList.add('text-amber-500');
            
            // Activate icon color
            const activeIcon = categoryBtn.querySelector('.category-icon');
            activeIcon.classList.remove('text-stone-600');
            activeIcon.classList.add('text-amber-500');
        }

        function toggleFaqItem(button) {
            const container = button.parentElement;
            const content = button.nextElementSibling;
            const icon = button.querySelector('.faq-icon');
            const isHidden = content.classList.contains('hidden');
            
            if (isHidden) {
                content.classList.remove('hidden');
                // Trigger reflow for smooth animation
                content.offsetHeight;
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.style.transform = 'rotate(180deg)';
                button.classList.add('bg-stone-900');
            } else {
                content.style.maxHeight = '0';
                icon.style.transform = 'rotate(0deg)';
                setTimeout(() => {
                    content.classList.add('hidden');
                    button.classList.remove('bg-stone-900');
                }, 300);
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
