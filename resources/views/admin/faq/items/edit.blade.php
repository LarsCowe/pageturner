<x-admin-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-serif font-bold text-stone-100">Edit FAQ Item</h1>
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
                        <li class="text-stone-100">Edit</li>
                    </ol>
                </nav>
            </div>

            <!-- Form -->
            <div class="bg-stone-900 rounded-xl shadow-lg border border-stone-800 overflow-hidden">
                <form action="{{ route('admin.faq.items.update', $item->id) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Current Category Info -->
                    <div class="bg-stone-800/50 border border-stone-700/50 rounded-lg p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-amber-500 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-stone-200">Currently in category:</p>
                                <p class="text-sm text-amber-500 mt-1">{{ $item->category->name }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Category Selection -->
                    <div>
                        <label for="faq_category_id" class="block text-sm font-medium text-stone-400 mb-2">
                            Category <span class="text-amber-500">*</span>
                        </label>
                        <select id="faq_category_id" 
                                name="faq_category_id" 
                                required
                                class="w-full px-4 py-2 bg-stone-950 border border-stone-700 rounded-lg text-stone-100 focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-colors @error('faq_category_id') border-red-500 @enderror">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('faq_category_id', $item->faq_category_id) == $category->id ? 'selected' : '' }}>
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
                               value="{{ old('question', $item->question) }}"
                               required
                               maxlength="255"
                               class="w-full px-4 py-2 bg-stone-950 border border-stone-700 rounded-lg text-stone-100 focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-colors @error('question') border-red-500 @enderror">
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
                                  class="w-full px-4 py-2 bg-stone-950 border border-stone-700 rounded-lg text-stone-100 focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-colors @error('answer') border-red-500 @enderror">{{ old('answer', $item->answer) }}</textarea>
                        @error('answer')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-stone-500">
                            You can use markdown formatting for better readability. Minimum 10 characters.
                        </p>
                    </div>

                    <!-- Order -->
                    <div>
                        <label for="order" class="block text-sm font-medium text-stone-400 mb-2">
                            Order <span class="text-amber-500">*</span>
                        </label>
                        <input type="number" 
                               id="order" 
                               name="order" 
                               value="{{ old('order', $item->order) }}"
                               required
                               min="0"
                               class="w-full px-4 py-2 bg-stone-950 border border-stone-700 rounded-lg text-stone-100 focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-colors @error('order') border-red-500 @enderror">
                        @error('order')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-stone-500">
                            Lower numbers appear first. Items are ordered within their category.
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
                            Save Changes
                        </button>
                    </div>
                </form>

                <!-- Delete Form (separate) -->
                <div class="border-t border-stone-800">
                    <form action="{{ route('admin.faq.items.destroy', $item->id) }}" 
                          method="POST"
                          class="p-6 bg-red-900/10"
                          onsubmit="return confirm('Are you sure you want to delete this FAQ item? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <div class="flex-1">
                                <h3 class="text-sm font-medium text-red-400">Delete this FAQ item</h3>
                                <p class="mt-1 text-sm text-red-300/70">This action cannot be undone.</p>
                            </div>
                            <button type="submit" 
                                    class="ml-4 px-4 py-2 bg-red-900/50 border border-red-800 text-red-200 text-sm font-medium rounded-lg hover:bg-red-900 hover:text-white transition-colors">
                                Delete Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
