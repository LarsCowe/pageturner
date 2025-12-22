<x-app-layout>
    <!-- Hero Banner Section -->
    <div class="relative h-[400px] bg-gray-900 overflow-hidden">
        <!-- Background Cover with Blur -->
        @if($book->cover_image)
            <div class="absolute inset-0 opacity-20">
                <img src="{{ Storage::url($book->cover_image) }}" 
                     alt="" 
                     class="w-full h-full object-cover blur-sm scale-110">
            </div>
        @endif
        
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/50"></div>
        
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
                            <div class="w-48 h-72 bg-indigo-600 rounded-lg shadow-2xl ring-4 ring-white/10 flex items-center justify-center">
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
                            @if($book->reviews_count > 0)
                                <span>•</span>
                                <div class="flex items-center gap-1">
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="font-semibold text-white">{{ $book->calculated_rating }}</span>
                                    <span class="text-gray-400">({{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }})</span>
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
                                    <!-- Book is on shelf - show status with modal -->
                                    <div x-data="{ open: false }">
                                        <button @click="open = true" class="px-6 py-3 bg-white text-gray-900 rounded-lg font-semibold hover:bg-gray-100 transition flex items-center gap-2">
                                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            <span>On {{ ucwords(str_replace('-', ' ', $userShelf->shelf)) }}</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div x-show="open" @click.self="open = false" x-cloak
                                             class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4">
                                            <div @click.away="open = false" class="bg-white rounded-xl shadow-2xl max-w-xs w-full p-5">
                                                <div class="flex items-center justify-between mb-4">
                                                    <h3 class="text-lg font-bold text-gray-900">Manage Shelf</h3>
                                                    <button @click="open = false" class="text-gray-400 hover:text-gray-600 transition">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                
                                                <!-- Update Reading Progress (for Currently Reading books) -->
                                                @if($userShelf->shelf === 'currently-reading' && $book->pages)
                                                    <form action="{{ route('books.shelf.update', $book) }}" method="POST" class="mb-4 p-4 bg-indigo-50 rounded-lg">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="shelf" value="currently-reading">
                                                        
                                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                            Update Current Page
                                                        </label>
                                                        
                                                        <div class="flex gap-2">
                                                            <input type="number" 
                                                                   name="current_page" 
                                                                   min="0" 
                                                                   max="{{ $book->pages }}"
                                                                   value="{{ $userShelf->current_page ?? 0 }}"
                                                                   placeholder="Page number"
                                                                   class="flex-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                                            <button type="submit" 
                                                                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition">
                                                                Update
                                                            </button>
                                                        </div>
                                                        
                                                        <p class="text-xs text-gray-500 mt-2">
                                                            Book has {{ $book->pages }} pages
                                                        </p>
                                                    </form>
                                                @endif

                                                <div class="space-y-2 mb-4">
                                                    @foreach(['currently-reading' => 'Currently Reading', 'want-to-read' => 'Want to Read', 'read' => 'Read'] as $shelfKey => $shelfLabel)
                                                        <form action="{{ route('books.shelf.update', $book) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="shelf" value="{{ $shelfKey }}">
                                                            <button type="submit" class="w-full text-left px-4 py-2.5 rounded-lg text-sm transition {{ $userShelf->shelf === $shelfKey ? 'bg-indigo-600 text-white font-medium' : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
                                                                {{ $shelfLabel }}
                                                            </button>
                                                        </form>
                                                    @endforeach
                                                </div>
                                                
                                                <form action="{{ route('books.shelf.remove', $book) }}" method="POST" class="pt-3 border-t border-gray-200">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-full px-4 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 text-sm font-medium rounded-lg transition">
                                                        Remove from Shelf
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- Book not on shelf - show modal with options -->
                                    <div x-data="{ open: false }">
                                        <button @click="open = true" class="px-6 py-3 bg-white text-gray-900 rounded-lg font-semibold hover:bg-gray-100 transition flex items-center gap-2">
                                            <span>Add to Shelf</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div x-show="open" @click.self="open = false" x-cloak
                                             class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4">
                                            <div @click.away="open = false" class="bg-white rounded-xl shadow-2xl max-w-xs w-full p-5">
                                                <div class="flex items-center justify-between mb-4">
                                                    <h3 class="text-lg font-bold text-gray-900">Add to Shelf</h3>
                                                    <button @click="open = false" class="text-gray-400 hover:text-gray-600 transition">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                
                                                <div class="space-y-2">
                                                    @foreach(['currently-reading' => 'Currently Reading', 'want-to-read' => 'Want to Read', 'read' => 'Read'] as $shelfKey => $shelfLabel)
                                                        <form action="{{ route('books.shelf.add', $book) }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="shelf" value="{{ $shelfKey }}">
                                                            <button type="submit" class="w-full text-left px-4 py-2.5 bg-gray-100 hover:bg-indigo-600 hover:text-white text-gray-700 rounded-lg text-sm transition font-medium">
                                                                {{ $shelfLabel }}
                                                            </button>
                                                        </form>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <!-- Write Review Modal -->
                                <div x-data="{ open: false, rating: 0, hoverRating: 0 }">
                                    <button @click="open = true" class="px-6 py-3 bg-white/10 backdrop-blur-sm text-white rounded-lg font-semibold hover:bg-white/20 transition border border-white/20">
                                        Write a Review
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div x-show="open" @click.self="open = false" x-cloak
                                         class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4">
                                        <div @click.away="open = false" class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6">
                                            <div class="flex items-center justify-between mb-6">
                                                <h3 class="text-xl font-bold text-gray-900">Write a Review</h3>
                                                <button @click="open = false" class="text-gray-400 hover:text-gray-600 transition">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            
                                            <form action="{{ route('reviews.store', $book) }}" method="POST">
                                                @csrf
                                                
                                                <!-- Star Rating -->
                                                <div class="mb-6">
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Your Rating <span class="text-red-500">*</span></label>
                                                    <div class="flex items-center gap-1">
                                                        <template x-for="star in 5" :key="star">
                                                            <button type="button" 
                                                                    @click="rating = star" 
                                                                    @mouseenter="hoverRating = star" 
                                                                    @mouseleave="hoverRating = 0"
                                                                    class="focus:outline-none transition-transform hover:scale-110">
                                                                <svg class="w-8 h-8 transition-colors" 
                                                                     :class="(hoverRating || rating) >= star ? 'text-yellow-400' : 'text-gray-300'"
                                                                     fill="currentColor" viewBox="0 0 20 20">
                                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                                </svg>
                                                            </button>
                                                        </template>
                                                        <span class="ml-2 text-sm text-gray-600" x-text="rating ? rating + ' star' + (rating > 1 ? 's' : '') : 'Select rating'"></span>
                                                    </div>
                                                    <input type="hidden" name="rating" x-model="rating" required>
                                                </div>
                                                
                                                <!-- Review Text -->
                                                <div class="mb-6">
                                                    <label for="review_text" class="block text-sm font-medium text-gray-700 mb-2">Your Review (optional)</label>
                                                    <textarea name="review_text" id="review_text" rows="5" 
                                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none"
                                                              placeholder="Share your thoughts about this book..."></textarea>
                                                </div>
                                                
                                                <!-- Submit Button -->
                                                <div class="flex justify-end gap-3">
                                                    <button type="button" @click="open = false" class="px-5 py-2.5 text-gray-700 font-medium hover:bg-gray-100 rounded-lg transition">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" 
                                                            :disabled="!rating"
                                                            :class="rating ? 'bg-indigo-600 hover:bg-indigo-700' : 'bg-gray-300 cursor-not-allowed'"
                                                            class="px-5 py-2.5 text-white font-medium rounded-lg transition">
                                                        Post Review
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                    <div class="flex gap-4" x-data="{ editing: false, editRating: {{ $review->rating }}, editHoverRating: 0 }">
                                        <!-- Avatar -->
                                        <div class="flex-shrink-0">
                                            @if($review->user->avatar)
                                                <img src="{{ Storage::url($review->user->avatar) }}" 
                                                     alt="{{ $review->user->name }}"
                                                     class="w-10 h-10 rounded-full object-cover">
                                            @else
                                                <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center">
                                                    <span class="text-sm font-semibold text-white">
                                                        {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Review Content -->
                                        <div class="flex-1 min-w-0">
                                            <!-- View Mode -->
                                            <div x-show="!editing">
                                                <div class="flex items-center justify-between mb-1">
                                                    <div class="flex items-center gap-2">
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
                                                    
                                                    <!-- Edit/Delete buttons (only for owner or admin) -->
                                                    @auth
                                                        @if(auth()->id() === $review->user_id || auth()->user()->is_admin)
                                                            <div class="flex items-center gap-2">
                                                                @if(auth()->id() === $review->user_id)
                                                                    <button @click="editing = true" class="text-gray-400 hover:text-indigo-600 transition" title="Edit review">
                                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                        </svg>
                                                                    </button>
                                                                @endif
                                                                <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this review?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-gray-400 hover:text-red-600 transition" title="Delete review">
                                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    @endauth
                                                </div>
                                                <p class="text-sm text-gray-500 mb-2">{{ $review->created_at->diffForHumans() }}</p>
                                                @if($review->review_text)
                                                    <p class="text-gray-700 leading-relaxed">{{ $review->review_text }}</p>
                                                @endif
                                            </div>
                                            
                                            <!-- Edit Mode -->
                                            <div x-show="editing" x-cloak>
                                                <form action="{{ route('reviews.update', $review) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    
                                                    <!-- Star Rating -->
                                                    <div class="mb-3">
                                                        <div class="flex items-center gap-1">
                                                            <template x-for="star in 5" :key="star">
                                                                <button type="button" 
                                                                        @click="editRating = star" 
                                                                        @mouseenter="editHoverRating = star" 
                                                                        @mouseleave="editHoverRating = 0"
                                                                        class="focus:outline-none transition-transform hover:scale-110">
                                                                    <svg class="w-6 h-6 transition-colors" 
                                                                         :class="(editHoverRating || editRating) >= star ? 'text-yellow-400' : 'text-gray-300'"
                                                                         fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                                    </svg>
                                                                </button>
                                                            </template>
                                                        </div>
                                                        <input type="hidden" name="rating" x-model="editRating">
                                                    </div>
                                                    
                                                    <!-- Review Text -->
                                                    <textarea name="review_text" rows="3" 
                                                              class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none mb-3">{{ $review->review_text }}</textarea>
                                                    
                                                    <!-- Buttons -->
                                                    <div class="flex gap-2">
                                                        <button type="submit" class="px-3 py-1.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                                                            Save
                                                        </button>
                                                        <button type="button" @click="editing = false; editRating = {{ $review->rating }}" class="px-3 py-1.5 text-gray-600 text-sm font-medium hover:bg-gray-100 rounded-lg transition">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
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
                            <div class="bg-indigo-600 rounded-xl shadow-sm p-6 text-white">
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
                                @else
                                    <div class="mb-3">
                                        <p class="text-sm text-white/80 mb-3">No progress recorded yet</p>
                                    </div>
                                @endif
                                
                                <!-- Quick Update Progress Form -->
                                <form action="{{ route('books.shelf.update', $book) }}" method="POST" class="mb-3" x-data="{ updating: false }">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="shelf" value="currently-reading">
                                    
                                    <div x-show="!updating" class="flex gap-2">
                                        <button type="button" 
                                                @click="updating = true"
                                                class="flex-1 px-3 py-2 bg-white/10 hover:bg-white/20 backdrop-blur text-white text-sm font-medium rounded-lg transition border border-white/20">
                                            📖 Update Page
                                        </button>
                                    </div>
                                    
                                    <div x-show="updating" x-cloak class="flex gap-2">
                                        <input type="number" 
                                               name="current_page" 
                                               min="0" 
                                               max="{{ $book->pages }}"
                                               value="{{ $userShelf->current_page ?? 0 }}"
                                               placeholder="Page #"
                                               class="flex-1 rounded-lg border-white/20 bg-white/10 backdrop-blur text-white placeholder-white/50 focus:border-white focus:ring-white text-sm">
                                        <button type="submit" 
                                                class="px-4 py-2 bg-white text-indigo-600 hover:bg-white/90 text-sm font-medium rounded-lg transition">
                                            Save
                                        </button>
                                        <button type="button" 
                                                @click="updating = false"
                                                class="px-3 py-2 bg-white/10 hover:bg-white/20 text-white text-sm rounded-lg transition">
                                            ✕
                                        </button>
                                    </div>
                                </form>
                                
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
