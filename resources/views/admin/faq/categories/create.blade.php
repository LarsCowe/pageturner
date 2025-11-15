<x-admin-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="flex items-center text-sm mb-6">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700">Admin</a>
                <span class="text-gray-400 mx-2">/</span>
                <a href="{{ route('admin.faq.categories.index') }}" class="text-gray-500 hover:text-gray-700">FAQ Management</a>
                <span class="text-gray-400 mx-2">/</span>
                <span class="text-gray-900 font-medium">Create Category</span>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-8">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Create FAQ Category</h1>
                    <p class="text-gray-600 mb-8">This will be the title for a group of related questions.</p>

                    <form action="{{ route('admin.faq.categories.store') }}" method="POST">
                        @csrf

                        <!-- Name -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Category Name
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name') }}"
                                   placeholder="e.g., Account & Profile"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition @error('name') border-red-500 @enderror"
                                   required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.faq.categories.index') }}" 
                               class="px-5 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm font-medium">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                                Save Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
