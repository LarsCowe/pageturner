<x-admin-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="flex items-center text-sm mb-6">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700">Admin</a>
                <span class="text-gray-400 mx-2">/</span>
                <a href="{{ route('admin.faq.categories.index') }}" class="text-gray-500 hover:text-gray-700">FAQ Management</a>
                <span class="text-gray-400 mx-2">/</span>
                <span class="text-gray-900 font-medium">Edit Category</span>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-8">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Edit FAQ Category</h1>
                    <p class="text-gray-600 mb-8">Update the category name. Changes will be reflected immediately.</p>

                    <form action="{{ route('admin.faq.categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Category Name
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $category->name) }}"
                                   placeholder="e.g., Account & Profile"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition @error('name') border-red-500 @enderror"
                                   required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Slug (Read-only) -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Current Slug
                            </label>
                            <div class="px-4 py-3 bg-gray-50 rounded-lg text-gray-700 font-mono text-sm border border-gray-200">
                                {{ $category->slug }}
                            </div>
                            <p class="mt-2 text-sm text-gray-500">The slug will be automatically updated based on the category name.</p>
                        </div>

                        <!-- Stats -->
                        <div class="mb-8 p-4 bg-blue-50 rounded-lg border border-blue-100">
                            <h3 class="text-sm font-semibold text-gray-900 mb-1">Category Information</h3>
                            <p class="text-sm text-gray-600">
                                This category contains <strong class="text-gray-900">{{ $category->faqItems->count() }}</strong> FAQ {{ Str::plural('item', $category->faqItems->count()) }}.
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.faq.categories.index') }}" 
                               class="px-5 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm font-medium">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
