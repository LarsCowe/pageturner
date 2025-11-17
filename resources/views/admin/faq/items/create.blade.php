<x-admin-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Create FAQ Item</h1>
                <nav class="flex mt-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2 text-sm text-gray-600">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Admin</a>
                        </li>
                        <li>/</li>
                        <li>
                            <a href="{{ route('admin.faq.items.index') }}" class="hover:text-blue-600">FAQ Items</a>
                        </li>
                        <li>/</li>
                        <li>Create</li>
                    </ol>
                </nav>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <form action="{{ route('admin.faq.items.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <!-- Category Selection -->
                    <div>
                        <label for="faq_category_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select id="faq_category_id" 
                                name="faq_category_id" 
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('faq_category_id') border-red-500 @enderror">
                            <option value="">Select a category...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('faq_category_id', $selectedCategory) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('faq_category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Question -->
                    <div>
                        <label for="question" class="block text-sm font-medium text-gray-700 mb-2">
                            Question <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="question" 
                               name="question" 
                               value="{{ old('question') }}"
                               required
                               maxlength="255"
                               placeholder="e.g., How do I create a book club?"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('question') border-red-500 @enderror">
                        @error('question')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Answer -->
                    <div>
                        <label for="answer" class="block text-sm font-medium text-gray-700 mb-2">
                            Answer <span class="text-red-500">*</span>
                        </label>
                        <textarea id="answer" 
                                  name="answer" 
                                  rows="8"
                                  required
                                  placeholder="Provide a detailed answer to the question..."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('answer') border-red-500 @enderror">{{ old('answer') }}</textarea>
                        @error('answer')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500">
                            You can use markdown formatting for better readability.
                        </p>
                    </div>

                    <!-- Order (Optional) -->
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                            Order (Optional)
                        </label>
                        <input type="number" 
                               id="order" 
                               name="order" 
                               value="{{ old('order') }}"
                               min="0"
                               placeholder="Leave empty to add at the end"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('order') border-red-500 @enderror">
                        @error('order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500">
                            If not specified, the item will be added at the end of the category.
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.faq.items.index') }}" 
                           class="px-6 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                            Create FAQ Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
