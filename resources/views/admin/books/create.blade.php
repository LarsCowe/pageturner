<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Title -->
                            <div class="md:col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                    Title <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="title" 
                                       id="title" 
                                       value="{{ old('title') }}"
                                       required
                                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Author -->
                            <div>
                                <label for="author" class="block text-sm font-medium text-gray-700 mb-2">
                                    Author <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="author" 
                                       id="author" 
                                       value="{{ old('author') }}"
                                       required
                                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                @error('author')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ISBN -->
                            <div>
                                <label for="isbn" class="block text-sm font-medium text-gray-700 mb-2">
                                    ISBN
                                </label>
                                <input type="text" 
                                       name="isbn" 
                                       id="isbn" 
                                       value="{{ old('isbn') }}"
                                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                @error('isbn')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Publisher -->
                            <div>
                                <label for="publisher" class="block text-sm font-medium text-gray-700 mb-2">
                                    Publisher
                                </label>
                                <input type="text" 
                                       name="publisher" 
                                       id="publisher" 
                                       value="{{ old('publisher') }}"
                                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                @error('publisher')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Published Date -->
                            <div>
                                <label for="published_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    Published Date
                                </label>
                                <input type="date" 
                                       name="published_date" 
                                       id="published_date" 
                                       value="{{ old('published_date') }}"
                                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                @error('published_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pages -->
                            <div>
                                <label for="pages" class="block text-sm font-medium text-gray-700 mb-2">
                                    Number of Pages
                                </label>
                                <input type="number" 
                                       name="pages" 
                                       id="pages" 
                                       value="{{ old('pages') }}"
                                       min="1"
                                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                @error('pages')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Cover Image -->
                            <div class="md:col-span-2">
                                <label for="cover_image" class="block text-sm font-medium text-gray-700 mb-2">
                                    Cover Image
                                </label>
                                <input type="file" 
                                       name="cover_image" 
                                       id="cover_image" 
                                       accept="image/jpeg,image/jpg,image/png,image/webp"
                                       class="w-full">
                                <p class="mt-1 text-sm text-gray-500">Max 2MB. Accepted formats: JPEG, PNG, WebP</p>
                                @error('cover_image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Description
                                </label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="5"
                                          class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Genres -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Genres
                                </label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                    @foreach($genres as $genre)
                                        <label class="flex items-center">
                                            <input type="checkbox" 
                                                   name="genres[]" 
                                                   value="{{ $genre->id }}"
                                                   {{ in_array($genre->id, old('genres', [])) ? 'checked' : '' }}
                                                   class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <span class="ml-2 text-sm text-gray-700">{{ $genre->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('genres')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Moods -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Moods
                                </label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                    @foreach($moods as $mood)
                                        <label class="flex items-center">
                                            <input type="checkbox" 
                                                   name="moods[]" 
                                                   value="{{ $mood->id }}"
                                                   {{ in_array($mood->id, old('moods', [])) ? 'checked' : '' }}
                                                   class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <span class="ml-2 text-sm text-gray-700">{{ $mood->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('moods')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between mt-6 pt-6 border-t">
                            <a href="{{ route('admin.books.index') }}" 
                               class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                Create Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
