<x-app-layout>
    <div class="py-12 bg-stone-950">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filters -->
            <div class="mb-8 bg-stone-900 rounded-2xl shadow-lg border border-stone-800 p-6">
                <form method="GET" action="{{ route('books.index') }}" class="space-y-4">
                    <div class="flex flex-col md:flex-row gap-4">
                        <!-- Search -->
                        <div class="flex-1">
                            <input type="text" 
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Search by title, author, or description..."
                                   class="w-full rounded-lg bg-stone-800 border-stone-700 text-stone-100 placeholder-stone-500 focus:border-amber-500 focus:ring-amber-500">
                        </div>

                        <!-- Genre -->
                        <div class="w-full md:w-48">
                            <select name="genre" class="w-full rounded-lg bg-stone-800 border-stone-700 text-stone-100 focus:border-amber-500 focus:ring-amber-500">
                                <option value="">All Genres</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->slug }}" {{ request('genre') == $genre->slug ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Mood -->
                        <div class="w-full md:w-48">
                            <select name="mood" class="w-full rounded-lg bg-stone-800 border-stone-700 text-stone-100 focus:border-amber-500 focus:ring-amber-500">
                                <option value="">All Moods</option>
                                @foreach($moods as $mood)
                                    <option value="{{ $mood->slug }}" {{ request('mood') == $mood->slug ? 'selected' : '' }}>
                                        {{ $mood->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sort -->
                        <div class="w-full md:w-48">
                            <select name="sort" class="w-full rounded-lg bg-stone-800 border-stone-700 text-stone-100 focus:border-amber-500 focus:ring-amber-500">
                                <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Newest</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                                <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title A-Z</option>
                                <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title Z-A</option>
                            </select>
                        </div>
                        
                        <button type="submit" 
                                class="px-6 py-2 bg-amber-600 text-stone-900 font-bold rounded-lg hover:bg-amber-500 transition whitespace-nowrap shadow-md">
                            Search
                        </button>
                        
                        @if(request()->hasAny(['search', 'genre', 'mood', 'sort']))
                            <a href="{{ route('books.index') }}" 
                               class="px-6 py-2 bg-stone-700 text-stone-300 rounded-lg hover:bg-stone-600 transition whitespace-nowrap flex items-center justify-center">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Books Grid -->
            <div class="bg-stone-900 rounded-2xl shadow-lg border border-stone-800 p-6">
                @if($books->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                        @foreach($books as $book)
                            <div class="group">
                                <a href="{{ route('books.show', $book) }}" class="block">
                                    <!-- Book Cover -->
                                    <div class="aspect-[2/3] bg-stone-800 rounded-lg overflow-hidden mb-3 shadow-md group-hover:shadow-2xl transition duration-300 transform group-hover:scale-105 border border-stone-800 relative">
                                        @if($book->cover_image)
                                            <img src="{{ Storage::url($book->cover_image) }}" 
                                                 alt="{{ $book->title }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-stone-800">
                                                <svg class="w-12 h-12 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-stone-950/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                    
                                    <!-- Book Info -->
                                    <h3 class="font-bold text-stone-100 text-sm mb-1 line-clamp-2 group-hover:text-amber-500 transition font-serif">
                                        {{ $book->title }}
                                    </h3>
                                    <p class="text-xs text-stone-400 line-clamp-1 italic">
                                        {{ $book->author }}
                                    </p>
                                    
                                    <!-- Rating -->
                                    @if($book->reviews_count > 0)
                                        <div class="flex items-center mt-2">
                                            <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span class="ml-1 text-xs text-stone-400">
                                                {{ $book->calculated_rating }}
                                            </span>
                                        </div>
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($books->hasPages())
                        <div class="mt-8">
                            {{ $books->links() }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-12 border-2 border-dashed border-stone-800 rounded-xl">
                        <div class="inline-block p-4 bg-stone-800 rounded-full mb-4">
                            <svg class="h-8 w-8 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="mt-2 text-lg font-medium text-stone-200 font-serif">No books found</h3>
                        <p class="mt-1 text-stone-500">Try adjusting your search or filter criteria.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
