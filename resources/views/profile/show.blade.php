<x-app-layout>
    <div class="py-12 bg-stone-950">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Profile Header -->
            <div class="bg-stone-900 overflow-hidden shadow-lg border border-stone-800 rounded-2xl mb-6">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" 
                                     alt="{{ $user->username ?? $user->name }}" 
                                     class="w-32 h-32 rounded-full object-cover border-4 border-stone-700 shadow-md">
                            @else
                                <div class="w-32 h-32 rounded-full bg-stone-800 flex items-center justify-center border-4 border-stone-700 shadow-md">
                                    <span class="text-4xl font-bold font-serif text-amber-500">
                                        {{ strtoupper(substr($user->username ?? $user->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Profile Info -->
                        <div class="flex-grow text-center md:text-left">
                            <div class="flex flex-col md:flex-row items-center justify-between mb-2 gap-4">
                                <h1 class="text-3xl font-black font-serif text-stone-100">{{ $user->username ?? $user->name }}</h1>
                                
                                @auth
                                    @if(Auth::id() === $user->id)
                                        <a href="{{ route('profile.edit') }}" 
                                           class="px-5 py-2 bg-stone-800 text-stone-200 border border-stone-600 rounded-full hover:bg-stone-700 transition shadow-sm font-medium">
                                            Edit Profile
                                        </a>
                                    @endif
                                @endauth
                            </div>

                            @if($user->birthday)
                                <p class="text-stone-400 mb-2">
                                    🎂 {{ $user->birthday->format('F j, Y') }} 
                                    ({{ $user->birthday->age }} years old)
                                </p>
                            @endif

                            @if($user->bio)
                                <p class="text-stone-300 mt-4 leading-relaxed max-w-2xl mx-auto md:mx-0">{{ $user->bio }}</p>
                            @endif

                            @if($favoriteGenres->count() > 0)
                                <div class="mt-6">
                                    <span class="text-xs font-bold uppercase tracking-wider text-stone-500">Favorite Genres</span>
                                    <div class="flex flex-wrap justify-center md:justify-start gap-2 mt-2">
                                        @foreach($favoriteGenres as $genre)
                                            <span class="px-3 py-1 bg-stone-800 text-amber-500 border border-stone-700 rounded-full text-sm font-medium">
                                                {{ $genre->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4 mb-6">
                <div class="bg-stone-900 p-4 rounded-xl shadow-md border border-stone-800 text-center">
                    <div class="text-2xl font-black text-stone-100">{{ $stats['books_read'] }}</div>
                    <div class="text-xs font-bold text-stone-500 uppercase tracking-widest mt-1">Read</div>
                </div>
                <div class="bg-stone-900 p-4 rounded-xl shadow-md border border-stone-800 text-center">
                    <div class="text-2xl font-black text-amber-500">{{ $stats['currently_reading'] }}</div>
                    <div class="text-xs font-bold text-stone-500 uppercase tracking-widest mt-1">Reading</div>
                </div>
                <div class="bg-stone-900 p-4 rounded-xl shadow-md border border-stone-800 text-center">
                    <div class="text-2xl font-black text-stone-300">{{ $stats['want_to_read'] }}</div>
                    <div class="text-xs font-bold text-stone-500 uppercase tracking-widest mt-1">Wishlist</div>
                </div>
                <div class="bg-stone-900 p-4 rounded-xl shadow-md border border-stone-800 text-center">
                    <div class="text-2xl font-black text-stone-300">{{ $stats['reviews_written'] }}</div>
                    <div class="text-xs font-bold text-stone-500 uppercase tracking-widest mt-1">Reviews</div>
                </div>
                <div class="bg-stone-900 p-4 rounded-xl shadow-md border border-stone-800 text-center">
                    <div class="text-2xl font-black text-stone-300">{{ $stats['book_clubs'] }}</div>
                    <div class="text-xs font-bold text-stone-500 uppercase tracking-widest mt-1">Clubs</div>
                </div>
                <div class="bg-stone-900 p-4 rounded-xl shadow-lg border border-amber-900/50 text-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-amber-500/5"></div>
                    <div class="relative z-10">
                        <div class="text-2xl font-black text-amber-600">🔥 {{ $user->current_streak }}</div>
                        <div class="text-xs font-bold text-stone-500 uppercase tracking-widest mt-1">Streak</div>
                    </div>
                </div>
                <div class="bg-stone-900 p-4 rounded-xl shadow-md border border-stone-800 text-center">
                    <div class="text-2xl font-black text-amber-700/80">🏆 {{ $user->longest_streak }}</div>
                    <div class="text-xs font-bold text-stone-500 uppercase tracking-widest mt-1">Best</div>
                </div>
            </div>

            <!-- Reading Shelves -->
            @foreach(['currently_reading' => 'Currently Reading', 'read' => 'Read', 'want_to_read' => 'Want to Read'] as $shelf => $title)
                @if($shelves[$shelf]->count() > 0)
                    <div class="bg-stone-900 overflow-hidden shadow-lg border border-stone-800 rounded-2xl mb-6">
                        <div class="p-6">
                            <h2 class="text-2xl font-black font-serif text-stone-100 mb-6 flex items-center gap-3">
                                @if($shelf === 'currently_reading')
                                    <span class="text-amber-500">📖</span>
                                @elseif($shelf === 'want_to_read')
                                    <span class="text-stone-400">✨</span>
                                @else
                                    <span class="text-stone-600">✓</span>
                                @endif
                                {{ $title }}
                            </h2>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                                @foreach($shelves[$shelf] as $book)
                                    <div class="group relative">
                                        <a href="{{ route('books.show', $book) }}" class="block">
                                            <!-- Book Cover -->
                                            <div class="aspect-[2/3] bg-stone-800 rounded-lg overflow-hidden mb-3 shadow-md group-hover:shadow-2xl transition duration-300 transform group-hover:-translate-y-1">
                                                @if($book->cover_image)
                                                    <img src="{{ Storage::url($book->cover_image) }}" 
                                                         alt="{{ $book->title }}"
                                                         class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-stone-800 border border-stone-700">
                                                        <svg class="w-12 h-12 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            <!-- Book Info -->
                                            <h3 class="font-bold text-stone-200 text-sm mb-1 line-clamp-2 group-hover:text-amber-500 transition font-serif">
                                                {{ $book->title }}
                                            </h3>
                                            <p class="text-xs text-stone-500 line-clamp-1 italic">
                                                {{ $book->author }}
                                            </p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            @if($shelves['currently_reading']->count() === 0 && $shelves['read']->count() === 0 && $shelves['want_to_read']->count() === 0)
                <div class="bg-stone-900 overflow-hidden shadow-lg border border-stone-800 rounded-2xl">
                    <div class="p-12 text-center">
                        <div class="inline-block p-4 bg-stone-800 rounded-full mb-4">
                            <svg class="h-12 w-12 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="mt-2 text-xl font-bold font-serif text-stone-200">No books yet</h3>
                        <p class="mt-2 text-stone-500">
                            {{ Auth::check() && Auth::id() === $user->id ? 'Start adding books to your shelves!' : 'This user hasn\'t added any books yet.' }}
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
