<x-app-layout>
    <!-- Hero Section with Gradient -->
    <div class="relative bg-gradient-to-br from-indigo-600 to-indigo-800 overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-black text-white mb-3">
                    Hey {{ auth()->user()->name }}! 👋
                </h1>
                <p class="text-xl text-white/90 mb-8">Ready to dive into your next adventure?</p>
            </div>
        </div>
        
        <!-- Wave Decoration -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#F9FAFB"/>
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-gray-50 -mt-1 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Quick Stats Bar -->
            <div class="flex flex-wrap justify-center gap-8 mb-6 -mt-8 relative z-10">
                <div class="flex items-center gap-2 bg-white/95 backdrop-blur-sm px-6 py-3 rounded-full shadow-lg">
                    <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                    </svg>
                    <span class="font-bold text-2xl text-gray-900">{{ $stats['total_books'] }}</span>
                    <span class="text-gray-600">books tracked</span>
                </div>
                <div class="flex items-center gap-2 bg-white/95 backdrop-blur-sm px-6 py-3 rounded-full shadow-lg">
                    <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-bold text-2xl text-gray-900">{{ $stats['books_read'] }}</span>
                    <span class="text-gray-600">completed</span>
                </div>
            </div>
            
            <!-- Compact Stats Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-sm font-medium opacity-90">Reading Now</div>
                        <svg class="w-8 h-8 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                        </svg>
                    </div>
                    <div class="text-4xl font-black">{{ $stats['currently_reading'] }}</div>
                </div>

                <div class="bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-sm font-medium opacity-90">Wishlist</div>
                        <svg class="w-8 h-8 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                        </svg>
                    </div>
                    <div class="text-4xl font-black">{{ $stats['want_to_read'] }}</div>
                </div>

                <div class="bg-gradient-to-br from-gray-600 to-gray-800 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-sm font-medium opacity-90">Reviews</div>
                        <svg class="w-8 h-8 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <div class="text-4xl font-black">{{ $stats['reviews_written'] }}</div>
                </div>

                <div class="bg-gradient-to-br from-gray-500 to-gray-700 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-sm font-medium opacity-90">Book Clubs</div>
                        <svg class="w-8 h-8 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                    </div>
                    <div class="text-4xl font-black">{{ $stats['book_clubs'] }}</div>
                </div>
            </div>

            @if($currentlyReading->count() > 0)
                <!-- Currently Reading - Large Featured -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-3xl font-black text-gray-900">Currently Reading</h2>
                            <p class="text-gray-600">Keep the momentum going!</p>
                        </div>
                        <a href="{{ route('books.index') }}" 
                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition font-semibold text-sm">
                            <span>Find More</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($currentlyReading as $book)
                            <a href="{{ route('books.show', $book) }}" 
                               class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                                <div class="flex gap-4 p-4">
                                    @if($book->cover_image)
                                        <img src="{{ Storage::url($book->cover_image) }}" 
                                             alt="{{ $book->title }}"
                                             class="w-24 h-32 object-cover rounded-lg shadow-lg">
                                    @else
                                        <div class="w-24 h-32 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-lg shadow-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-bold text-gray-900 mb-1 line-clamp-2 group-hover:text-indigo-600 transition">
                                            {{ $book->title }}
                                        </h3>
                                        <p class="text-sm text-gray-600 mb-3">{{ $book->author }}</p>
                                        
                                        @if($book->pivot->current_page && $book->pages)
                                            <div>
                                                <div class="flex justify-between text-xs text-gray-600 mb-1">
                                                    <span>Page {{ $book->pivot->current_page }}</span>
                                                    <span>{{ round(($book->pivot->current_page / $book->pages) * 100) }}%</span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                                    <div class="bg-gradient-to-r from-indigo-400 to-indigo-600 h-2 rounded-full transition-all duration-500" 
                                                         style="width: {{ ($book->pivot->current_page / $book->pages) * 100 }}%"></div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-full">
                                                Just Started
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-3xl p-12 text-center mb-8 border-2 border-dashed border-indigo-200">
                    <div class="inline-block p-6 bg-white rounded-full shadow-lg mb-6">
                        <svg class="w-16 h-16 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-3">Your Reading Journey Awaits!</h3>
                    <p class="text-gray-600 mb-8 text-lg">Discover thousands of books and start tracking your progress today.</p>
                    <a href="{{ route('books.index') }}" 
                       class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-full hover:from-indigo-700 hover:to-purple-700 transition font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>Browse Books</span>
                    </a>
                </div>
            @endif

            <!-- Recent Activity -->
            @if($recentBooks->count() > 0)
                <div>
                    <div class="mb-6">
                        <h2 class="text-2xl font-black text-gray-900">Recently Added</h2>
                        <p class="text-gray-600">Your latest additions to the collection</p>
                    </div>
                    
                    <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @foreach($recentBooks as $book)
                            <a href="{{ route('books.show', $book) }}" class="group">
                                <div class="relative">
                                    @if($book->cover_image)
                                        <img src="{{ Storage::url($book->cover_image) }}" 
                                             alt="{{ $book->title }}"
                                             class="w-full aspect-[2/3] object-cover rounded-xl shadow-md group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-105">
                                    @else
                                        <div class="w-full aspect-[2/3] bg-gradient-to-br from-gray-200 to-gray-300 rounded-xl shadow-md group-hover:shadow-2xl transition-all duration-300 transform group-hover:scale-105 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <!-- Shelf Badge -->
                                    <div class="absolute top-2 right-2">
                                        @php
                                            $shelfColors = [
                                                'currently-reading' => 'bg-indigo-500',
                                                'want-to-read' => 'bg-indigo-400',
                                                'read' => 'bg-gray-600'
                                            ];
                                        @endphp
                                        <span class="{{ $shelfColors[$book->pivot->shelf] ?? 'bg-gray-500' }} text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                            @if($book->pivot->shelf === 'currently-reading')
                                                📖
                                            @elseif($book->pivot->shelf === 'want-to-read')
                                                ⭐
                                            @else
                                                ✓
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                
                                <h3 class="mt-3 text-sm font-bold text-gray-900 line-clamp-2 group-hover:text-indigo-600 transition">
                                    {{ $book->title }}
                                </h3>
                                <p class="text-xs text-gray-600 line-clamp-1">{{ $book->author }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
