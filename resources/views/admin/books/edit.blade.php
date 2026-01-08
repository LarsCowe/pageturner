<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-stone-100 leading-tight font-serif">
            {{ __('Edit Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-900 border border-stone-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Title -->
                            <div class="md:col-span-2">
                                <label for="title" class="block text-sm font-medium text-stone-300 mb-2">
                                    Title <span class="text-amber-500">*</span>
                                </label>
                                <input type="text" 
                                       name="title" 
                                       id="title" 
                                       value="{{ old('title', $book->title) }}"
                                       required
                                       class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 focus:border-amber-500 focus:ring-amber-500">
                                @error('title')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Author -->
                            <div>
                                <label for="author" class="block text-sm font-medium text-stone-300 mb-2">
                                    Author <span class="text-amber-500">*</span>
                                </label>
                                <input type="text" 
                                       name="author" 
                                       id="author" 
                                       value="{{ old('author', $book->author) }}"
                                       required
                                       class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 focus:border-amber-500 focus:ring-amber-500">
                                @error('author')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ISBN -->
                            <div>
                                <label for="isbn" class="block text-sm font-medium text-stone-300 mb-2">
                                    ISBN
                                </label>
                                <input type="text" 
                                       name="isbn" 
                                       id="isbn" 
                                       value="{{ old('isbn', $book->isbn) }}"
                                       class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 focus:border-amber-500 focus:ring-amber-500">
                                @error('isbn')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Publisher -->
                            <div>
                                <label for="publisher" class="block text-sm font-medium text-stone-300 mb-2">
                                    Publisher
                                </label>
                                <input type="text" 
                                       name="publisher" 
                                       id="publisher" 
                                       value="{{ old('publisher', $book->publisher) }}"
                                       class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 focus:border-amber-500 focus:ring-amber-500">
                                @error('publisher')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Published Date -->
                            <div>
                                <label for="published_date" class="block text-sm font-medium text-stone-300 mb-2">
                                    Published Date
                                </label>
                                <input type="date" 
                                       name="published_date" 
                                       id="published_date" 
                                       value="{{ old('published_date', $book->published_date?->format('Y-m-d')) }}"
                                       class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 focus:border-amber-500 focus:ring-amber-500">
                                @error('published_date')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pages -->
                            <div>
                                <label for="pages" class="block text-sm font-medium text-stone-300 mb-2">
                                    Number of Pages
                                </label>
                                <input type="number" 
                                       name="pages" 
                                       id="pages" 
                                       value="{{ old('pages', $book->pages) }}"
                                       min="1"
                                       class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 focus:border-amber-500 focus:ring-amber-500">
                                @error('pages')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Current Cover Image -->
                            @if($book->cover_image)
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-stone-300 mb-2">
                                        Current Cover Image
                                    </label>
                                    <img src="{{ Storage::url($book->cover_image) }}" 
                                         alt="{{ $book->title }}"
                                         class="w-32 h-48 object-cover rounded shadow-md shadow-black/40">
                                </div>
                            @endif

                            <!-- Cover Image -->
                            <div class="md:col-span-2">
                                <label for="cover_image" class="block text-sm font-medium text-stone-300 mb-2">
                                    {{ $book->cover_image ? 'Replace Cover Image' : 'Cover Image' }}
                                </label>
                                <input type="file" 
                                       name="cover_image" 
                                       id="cover_image" 
                                       accept="image/jpeg,image/jpg,image/png,image/webp"
                                       class="w-full text-stone-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-stone-800 file:text-amber-500 hover:file:bg-stone-700">
                                <p class="mt-1 text-sm text-stone-500">Max 2MB. Accepted formats: JPEG, PNG, WebP</p>
                                @error('cover_image')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-stone-300 mb-2">
                                    Description
                                </label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="5"
                                          class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 focus:border-amber-500 focus:ring-amber-500">{{ old('description', $book->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Genres -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-stone-300 mb-2">
                                    Genres
                                </label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-2 bg-stone-950 p-4 rounded-lg border border-stone-800">
                                    @foreach($genres as $genre)
                                        <label class="flex items-center">
                                            <input type="checkbox" 
                                                   name="genres[]" 
                                                   value="{{ $genre->id }}"
                                                   {{ in_array($genre->id, old('genres', $book->genres->pluck('id')->toArray())) ? 'checked' : '' }}
                                                   class="rounded border-stone-700 bg-stone-900 text-amber-600 focus:ring-amber-500">
                                            <span class="ml-2 text-sm text-stone-300 hover:text-amber-500 transition-colors">{{ $genre->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('genres')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Moods -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-stone-300 mb-2">
                                    Moods
                                </label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-2 bg-stone-950 p-4 rounded-lg border border-stone-800">
                                    @foreach($moods as $mood)
                                        <label class="flex items-center">
                                            <input type="checkbox" 
                                                   name="moods[]" 
                                                   value="{{ $mood->id }}"
                                                   {{ in_array($mood->id, old('moods', $book->moods->pluck('id')->toArray())) ? 'checked' : '' }}
                                                   class="rounded border-stone-700 bg-stone-900 text-amber-600 focus:ring-amber-500">
                                            <span class="ml-2 text-sm text-stone-300 hover:text-amber-500 transition-colors">{{ $mood->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('moods')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between mt-6 pt-6 border-t border-stone-800">
                            <a href="{{ route('admin.books.index') }}" 
                               class="px-4 py-2 text-stone-400 hover:bg-stone-800 hover:text-stone-100 rounded-lg transition">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-500 transition shadow-lg shadow-amber-900/20">
                                Update Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
