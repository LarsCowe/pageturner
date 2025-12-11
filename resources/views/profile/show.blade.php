<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Profile Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-start gap-6">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" 
                                     alt="{{ $user->username ?? $user->name }}" 
                                     class="w-32 h-32 rounded-full object-cover border-4 border-indigo-100">
                            @else
                                <div class="w-32 h-32 rounded-full bg-indigo-100 flex items-center justify-center border-4 border-indigo-200">
                                    <span class="text-4xl font-bold text-indigo-600">
                                        {{ strtoupper(substr($user->username ?? $user->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Profile Info -->
                        <div class="flex-grow">
                            <div class="flex items-center justify-between mb-2">
                                <h1 class="text-3xl font-bold text-gray-900">{{ $user->username ?? $user->name }}</h1>
                                
                                @auth
                                    @if(Auth::id() === $user->id)
                                        <a href="{{ route('profile.edit') }}" 
                                           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                            Edit Profile
                                        </a>
                                    @endif
                                @endauth
                            </div>

                            @if($user->birthday)
                                <p class="text-gray-600 mb-2">
                                    🎂 {{ $user->birthday->format('F j, Y') }} 
                                    ({{ $user->birthday->age }} years old)
                                </p>
                            @endif

                            @if($user->bio)
                                <p class="text-gray-700 mt-4">{{ $user->bio }}</p>
                            @endif

                            @if($user->favorite_genres && count($user->favorite_genres) > 0)
                                <div class="mt-4">
                                    <span class="text-sm font-semibold text-gray-600">Favorite Genres:</span>
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        @foreach($user->favorite_genres as $genreId)
                                            @php
                                                $genre = \App\Models\Genre::find($genreId);
                                            @endphp
                                            @if($genre)
                                                <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-sm">
                                                    {{ $genre->name }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-2 md:grid-cols-7 gap-4 mb-6">
                <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                    <div class="text-2xl font-bold text-indigo-600">{{ $stats['books_read'] }}</div>
                    <div class="text-sm text-gray-600">Books Read</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                    <div class="text-2xl font-bold text-green-600">{{ $stats['currently_reading'] }}</div>
                    <div class="text-sm text-gray-600">Currently Reading</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                    <div class="text-2xl font-bold text-yellow-600">{{ $stats['want_to_read'] }}</div>
                    <div class="text-sm text-gray-600">Want to Read</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                    <div class="text-2xl font-bold text-purple-600">{{ $stats['reviews_written'] }}</div>
                    <div class="text-sm text-gray-600">Reviews</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                    <div class="text-2xl font-bold text-pink-600">{{ $stats['book_clubs'] }}</div>
                    <div class="text-sm text-gray-600">Book Clubs</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm text-center border-2 border-orange-200">
                    <div class="text-2xl font-bold text-orange-600">🔥 {{ $user->current_streak }}</div>
                    <div class="text-sm text-gray-600">Day Streak</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                    <div class="text-2xl font-bold text-blue-600">🏆 {{ $user->longest_streak }}</div>
                    <div class="text-sm text-gray-600">Best Streak</div>
                </div>
            </div>

            <!-- Reading Shelves -->
            @foreach(['currently_reading' => 'Currently Reading', 'read' => 'Read', 'want_to_read' => 'Want to Read'] as $shelf => $title)
                @if($shelves[$shelf]->count() > 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">{{ $title }}</h2>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                                @foreach($shelves[$shelf] as $book)
                                    <div class="group">
                                        <a href="#" class="block">
                                            @if($book->cover_image)
                                                <img src="{{ Storage::url($book->cover_image) }}" 
                                                     alt="{{ $book->title }}" 
                                                     class="w-full h-48 object-cover rounded-lg shadow-md group-hover:shadow-xl transition">
                                            @else
                                                <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                                    <span class="text-gray-400 text-xs text-center px-2">{{ $book->title }}</span>
                                                </div>
                                            @endif
                                            <p class="mt-2 text-sm font-medium text-gray-900 line-clamp-2">{{ $book->title }}</p>
                                            <p class="text-xs text-gray-600">{{ $book->author }}</p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            @if($shelves['currently_reading']->count() === 0 && $shelves['read']->count() === 0 && $shelves['want_to_read']->count() === 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No books yet</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ Auth::check() && Auth::id() === $user->id ? 'Start adding books to your shelves!' : 'This user hasn\'t added any books yet.' }}
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
