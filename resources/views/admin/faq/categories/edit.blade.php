<x-admin-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="flex items-center text-sm mb-6">
                <a href="{{ route('admin.dashboard') }}" class="text-stone-400 hover:text-amber-500 transition-colors">Admin</a>
                <span class="text-stone-600 mx-2">/</span>
                <a href="{{ route('admin.faq.categories.index') }}" class="text-stone-400 hover:text-amber-500 transition-colors">FAQ Management</a>
                <span class="text-stone-600 mx-2">/</span>
                <span class="text-stone-100 font-medium">Edit Category</span>
            </div>

            <div class="bg-stone-900 rounded-xl shadow-lg border border-stone-800 overflow-hidden">
                <div class="p-8">
                    <h1 class="text-2xl font-serif font-bold text-stone-100 mb-2">Edit FAQ Category</h1>
                    <p class="text-stone-400 mb-8">Update the category name. Changes will be reflected immediately.</p>

                    <form action="{{ route('admin.faq.categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold text-stone-300 mb-2">
                                Category Name
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $category->name) }}"
                                   placeholder="e.g., Account & Profile"
                                   class="w-full px-4 py-3 bg-stone-950 rounded-lg border border-stone-700 text-stone-100 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition placeholder-stone-600 @error('name') border-red-500 @enderror"
                                   required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Slug (Read-only) -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-stone-300 mb-2">
                                Current Slug
                            </label>
                            <div class="px-4 py-3 bg-stone-950/50 rounded-lg text-amber-500/80 font-mono text-sm border border-stone-800">
                                {{ $category->slug }}
                            </div>
                            <p class="mt-2 text-sm text-stone-500">The slug will be automatically updated based on the category name.</p>
                        </div>

                        <!-- Stats -->
                        <div class="mb-8 p-4 bg-stone-800/50 rounded-lg border border-stone-700/50">
                            <h3 class="text-sm font-semibold text-stone-200 mb-1">Category Information</h3>
                            <p class="text-sm text-stone-400">
                                This category contains <strong class="text-stone-200">{{ $category->faqItems->count() }}</strong> FAQ {{ Str::plural('item', $category->faqItems->count()) }}.
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-stone-800">
                            <a href="{{ route('admin.faq.categories.index') }}" 
                               class="px-5 py-2.5 text-stone-300 bg-stone-800 border border-stone-700 rounded-lg hover:bg-stone-700 hover:text-white transition-colors text-sm font-medium">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-5 py-2.5 bg-amber-600 text-white rounded-lg hover:bg-amber-500 transition-colors text-sm font-medium shadow-lg shadow-amber-900/20">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
