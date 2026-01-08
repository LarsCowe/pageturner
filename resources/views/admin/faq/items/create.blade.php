<x-admin-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-serif font-bold text-stone-100">Create FAQ Item</h1>
                <nav class="flex mt-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2 text-sm text-stone-400">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-amber-500 transition-colors">Admin</a>
                        </li>
                        <li>/</li>
                        <li>
                            <a href="{{ route('admin.faq.items.index') }}" class="hover:text-amber-500 transition-colors">FAQ Items</a>
                        </li>
                        <li>/</li>
                        <li class="text-stone-100">Create</li>
                    </ol>
                </nav>
            </div>

            <!-- Form -->
            <div class="bg-stone-900 rounded-xl shadow-lg border border-stone-800 overflow-hidden">
                <form action="{{ route('admin.faq.items.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <!-- Category Selection -->
                    <div>
                        <label for="faq_category_id" class="block text-sm font-medium text-stone-400 mb-2">
                            Category <span class="text-amber-500">*</span>
                        </label>
                        <select id="faq_category_id" 
                                name="faq_category_id" 
                                required
                                class="w-full px-4 py-2 bg-stone-950 border border-stone-700 rounded-lg text-stone-100 focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-colors @error('faq_category_id') border-red-500 @enderror">
                            <option value="">Select a category...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('faq_category_id', $selectedCategory) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('faq_category_id')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Question -->
                    <div>
                        <label for="question" class="block text-sm font-medium text-stone-400 mb-2">
                            Question <span class="text-amber-500">*</span>
                        </label>
                        <input type="text" 
                               id="question" 
                               name="question" 
                               value="{{ old('question') }}"
                               required
                               maxlength="255"
                               placeholder="e.g., How do I create a book club?"
                               class="w-full px-4 py-2 bg-stone-950 border border-stone-700 rounded-lg text-stone-100 focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-colors placeholder-stone-600 @error('question') border-red-500 @enderror">
                        @error('question')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Answer -->
                    <div>
                        <label for="answer" class="block text-sm font-medium text-stone-400 mb-2">
                            Answer <span class="text-amber-500">*</span>
                        </label>
                        <textarea id="answer" 
                                  name="answer" 
                                  rows="8"
                                  required
                                  minlength="10"
                                  placeholder="Provide a detailed answer to the question..."
                                  class="w-full px-4 py-2 bg-stone-950 border border-stone-700 rounded-lg text-stone-100 focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-colors placeholder-stone-600 @error('answer') border-red-500 @enderror">{{ old('answer') }}</textarea>
                        @error('answer')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-stone-500">
                            You can use markdown formatting for better readability. Minimum 10 characters.
                        </p>
                    </div>

                    <!-- Order (Optional) -->
                    <div>
                        <label for="order" class="block text-sm font-medium text-stone-400 mb-2">
                            Order (Optional)
                        </label>
                        <input type="number" 
                               id="order" 
                               name="order" 
                               value="{{ old('order') }}"
                               min="0"
                               placeholder="Leave empty to add at the end"
                               class="w-full px-4 py-2 bg-stone-950 border border-stone-700 rounded-lg text-stone-100 focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-colors placeholder-stone-600 @error('order') border-red-500 @enderror">
                        @error('order')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-stone-500">
                            If not specified, the item will be added at the end of the category.
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-stone-800">
                        <a href="{{ route('admin.faq.items.index') }}" 
                           class="px-6 py-2 bg-stone-800 text-stone-300 font-medium rounded-lg hover:bg-stone-700 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-amber-600 text-white font-medium rounded-lg hover:bg-amber-500 transition-colors shadow-lg shadow-amber-900/20">
                            Create FAQ Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
