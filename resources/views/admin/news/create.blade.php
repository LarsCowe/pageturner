<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-stone-100 leading-tight font-serif">
            {{ __('Create News Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-900 border border-stone-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-stone-400 mb-6">Fill in the details to publish a new article.</p>

                    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-stone-300 mb-2">
                                Title <span class="text-amber-500">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   value="{{ old('title') }}"
                                   placeholder="Enter news item title"
                                   class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 placeholder-stone-500 focus:border-amber-500 focus:ring-amber-500 @error('title') border-red-500 @enderror"
                                   required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-stone-300 mb-2">
                                Content <span class="text-amber-500">*</span>
                            </label>
                            <textarea name="content" 
                                      id="content" 
                                      rows="15"
                                      placeholder="Write your article content here..."
                                      class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 placeholder-stone-500 focus:border-amber-500 focus:ring-amber-500 @error('content') border-red-500 @enderror"
                                      required>{{ old('content') }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Featured Image -->
                        <div class="mb-6">
                            <label for="image" class="block text-sm font-medium text-stone-300 mb-2">
                                Featured Image
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-stone-700 border-dashed rounded-lg hover:border-amber-500 transition group">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-stone-500 group-hover:text-amber-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-stone-400 justify-center">
                                        <label for="image" class="relative cursor-pointer rounded-md font-medium text-amber-500 hover:text-amber-400 focus-within:outline-none">
                                            <span>Upload a file</span>
                                            <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-stone-500">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Published Date -->
                        <div class="mb-6">
                            <label for="published_at" class="block text-sm font-medium text-stone-300 mb-2">
                                Published Date <span class="text-amber-500">*</span>
                            </label>
                            <input type="date" 
                                   name="published_at" 
                                   id="published_at" 
                                   value="{{ old('published_at', now()->format('Y-m-d')) }}"
                                   class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 focus:border-amber-500 focus:ring-amber-500 @error('published_at') border-red-500 @enderror"
                                   required>
                            @error('published_at')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end gap-4 border-t border-stone-800 pt-6">
                            <a href="{{ route('admin.news.index') }}" 
                               class="px-6 py-2 border border-stone-700 rounded-lg text-stone-400 hover:bg-stone-800 transition">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-500 transition shadow-lg shadow-amber-900/20">
                                Create News Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
