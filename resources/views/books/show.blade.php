<x-app-layout>
    <!-- Hero Banner Section -->
    <div class="relative h-[400px] bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 overflow-hidden">
        <!-- Background Cover with Blur -->
        @if($book->cover_image)
            <div class="absolute inset-0 opacity-20">
                <img src="{{ Storage::url($book->cover_image) }}" 
                     alt="" 
                     class="w-full h-full object-cover blur-sm scale-110">
            </div>
        @endif
        
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
        
        <!-- Content -->
        <div class="relative h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end h-full pb-12">
                <div class="flex gap-8 items-end w-full">
                    <!-- Book Cover -->
                    <div class="flex-shrink-0 hidden md:block">
                        @if($book->cover_image)
                            <img src="{{ Storage::url($book->cover_image) }}" 
                                 alt="{{ $book->title }}"
                                 class="w-48 h-72 object-cover rounded-lg shadow-2xl ring-4 ring-white/10">
                        @else
                            <div class="w-48 h-72 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg shadow-2xl ring-4 ring-white/10 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Info -->
                    <div class="flex-1 min-w-0">
                        <a href="{{ route('books.index') }}" class="inline-flex items-center text-gray-400 hover:text-white mb-4 text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Books
                        </a>
                        
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-2 tracking-tight">{{ $book->title }}</h1>
                        <p class="text-xl text-gray-300 mb-4">by {{ $book->author }}</p>
                        
                        <!-- Meta Info -->
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-300 mb-6">
                            @if($book->published_date)
                                <span>{{ $book->published_date->format('Y') }}</span>
                            @endif
                            @if($book->pages)
                                <span>•</span>
                                <span>{{ $book->pages }} pages</span>
                            @endif
                            @if($book->average_rating > 0)
                                <span>•</span>
                                <div class="flex items-center gap-1">
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="font-semibold text-white">{{ number_format($book->average_rating, 1) }}</span>
                                    <span class="text-gray-400">({{ $book->ratings_count }})</span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach($book->genres->take(3) as $genre)
                                <span class="px-3 py-1 bg-white/10 backdrop-blur-sm text-white text-sm rounded-full border border-white/20">
                                    {{ $genre->name }}
                                </span>
                            @endforeach
                            @foreach($book->moods->take(2) as $mood)
                                <span class="px-3 py-1 bg-white/10 backdrop-blur-sm text-gray-300 text-sm rounded-full border border-white/20">
                                    {{ $mood->name }}
                                </span>
                            @endforeach
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-3">
                            @auth
                                @if($userShelf)
                                    <button class="px-6 py-3 bg-white text-gray-900 rounded-lg font-semibold hover:bg-gray-100 transition flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        On {{ ucwords(str_replace('-', ' ', $userShelf->shelf)) }}
                                    </button>
                                @else
                                    <button class="px-6 py-3 bg-white text-gray-900 rounded-lg font-semibold hover:bg-gray-100 transition">
                                        Add to Shelf
                                    </button>
                                @endif
                                <button class="px-6 py-3 bg-white/10 backdrop-blur-sm text-white rounded-lg font-semibold hover:bg-white/20 transition border border-white/20">
                                    Write a Review
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="px-6 py-3 bg-white text-gray-900 rounded-lg font-semibold hover:bg-gray-100 transition">
                                    Sign in to Track
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Main Content Column -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Description Card -->
                    @if($book->description)
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">About this book</h2>
                            <p class="text-gray-700 leading-relaxed">{{ $book->description }}</p>
                        </div>
                    @endif

                    <!-- Reviews Card -->
                    @if($book->reviews->count() > 0)
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-xl font-bold text-gray-900">
                                    Reader Reviews
                                    <span class="text-gray-500 font-normal text-lg">({{ $book->reviews->count() }})</span>
                                </h2>
                            </div>
                            
                            <div class="space-y-6">
                                @foreach($book->reviews->take(5) as $review)
                                    <div class="flex gap-4">
                                        <!-- Avatar -->
                                        <div class="flex-shrink-0">
                                            @if($review->user->avatar)
                                                <img src="{{ Storage::url($review->user->avatar) }}" 
                                                     alt="{{ $review->user->name }}"
                                                     class="w-10 h-10 rounded-full object-cover">
                                            @else
                                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                                    <span class="text-sm font-semibold text-white">
                                                        {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Review Content -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-semibold text-gray-900">{{ $review->user->name }}</span>
                                                <div class="flex items-center gap-1">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                                                             fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class="text-sm text-gray-500 mb-2">{{ $review->created_at->diffForHumans() }}</p>
                                            <p class="text-gray-700 leading-relaxed">{{ $review->review }}</p>
                                        </div>
                                    </div>
                                    @if(!$loop->last)
                                        <hr class="border-gray-200">
                                    @endif
                                @endforeach
                            </div>
                            
                            @if($book->reviews->count() > 5)
                                <button class="mt-6 w-full py-3 text-center text-indigo-600 font-semibold hover:text-indigo-700 transition">
                                    View all {{ $book->reviews->count() }} reviews
                                </button>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Book Details Card -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-bold text-gray-900 mb-4">Book Details</h3>
                        <div class="space-y-3 text-sm">
                            @if($book->publisher)
                                <div>
                                    <span class="text-gray-500">Publisher</span>
                                    <p class="font-medium text-gray-900">{{ $book->publisher }}</p>
                                </div>
                            @endif
                            @if($book->published_date)
                                <div>
                                    <span class="text-gray-500">Published</span>
                                    <p class="font-medium text-gray-900">{{ $book->published_date->format('F d, Y') }}</p>
                                </div>
                            @endif
                            @if($book->pages)
                                <div>
                                    <span class="text-gray-500">Pages</span>
                                    <p class="font-medium text-gray-900">{{ number_format($book->pages) }}</p>
                                </div>
                            @endif
                            @if($book->isbn)
                                <div>
                                    <span class="text-gray-500">ISBN</span>
                                    <p class="font-medium text-gray-900 font-mono text-xs">{{ $book->isbn }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Genres Card -->
                    @if($book->genres->count() > 0)
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h3 class="font-bold text-gray-900 mb-4">Genres</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($book->genres as $genre)
                                    <span class="px-3 py-1.5 bg-indigo-50 text-indigo-700 text-sm font-medium rounded-lg">
                                        {{ $genre->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Moods Card -->
                    @if($book->moods->count() > 0)
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h3 class="font-bold text-gray-900 mb-4">Moods</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($book->moods as $mood)
                                    <span class="px-3 py-1.5 bg-purple-50 text-purple-700 text-sm font-medium rounded-lg">
                                        {{ $mood->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Progress Card (if user has book) -->
                    @auth
                        @if($userShelf && $userShelf->shelf === 'currently-reading')
                            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-sm p-6 text-white">
                                <h3 class="font-bold mb-3">Your Reading Progress</h3>
                                @if($userShelf->current_page && $book->pages)
                                    <div class="mb-3">
                                        <div class="flex justify-between text-sm mb-2">
                                            <span>Page {{ $userShelf->current_page }} of {{ $book->pages }}</span>
                                            <span>{{ round(($userShelf->current_page / $book->pages) * 100) }}%</span>
                                        </div>
                                        <div class="w-full bg-white/20 rounded-full h-2">
                                            <div class="bg-white rounded-full h-2 transition-all" 
                                                 style="width: {{ ($userShelf->current_page / $book->pages) * 100 }}%"></div>
                                        </div>
                                    </div>
                                @endif
                                @if($userShelf->started_at)
                                    <p class="text-sm text-white/80">
                                        Started {{ $userShelf->started_at->format('M d, Y') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
