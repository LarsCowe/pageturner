<x-app-layout>
    {{-- Hero Section --}}
    <section class="relative bg-indigo-700 overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="hero-pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 20h40M20 0v40" stroke="white" stroke-width="1" fill="none"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#hero-pattern)"/>
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight">
                    Your Reading Journey
                    <span class="block text-indigo-200">Starts Here</span>
                </h1>
                <p class="mt-6 max-w-2xl mx-auto text-xl text-indigo-100">
                    Track your books, discover new reads based on your mood, join book clubs, and connect with fellow readers. The modern way to organize your reading life.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('books.index') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold rounded-xl text-indigo-600 bg-white hover:bg-gray-100 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Browse Books
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold rounded-xl text-white bg-indigo-500 bg-opacity-30 border-2 border-white border-opacity-50 hover:bg-opacity-40 hover:border-opacity-75 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Create Free Account
                        </a>
                    @endguest
                </div>
            </div>
        </div>

        {{-- Wave Decoration --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-16 text-gray-100" viewBox="0 0 1440 100" preserveAspectRatio="none">
                <path fill="currentColor" d="M0,50 C150,100 350,0 500,50 C650,100 800,20 1000,50 C1200,80 1350,30 1440,50 L1440,100 L0,100 Z"/>
            </svg>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="py-20 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Everything You Need to Track Your Reading</h2>
                <p class="mt-4 text-xl text-gray-600">Simple, beautiful, and powerful tools for book lovers</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Feature 1: Book Tracking --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-lg transition-shadow duration-300">
                    <div class="w-14 h-14 bg-indigo-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Track Your Books</h3>
                    <p class="text-gray-600">Organize your reading with shelves: Currently Reading, Read, and Want to Read. Never lose track of a book again.</p>
                </div>

                {{-- Feature 2: Mood Discovery --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-lg transition-shadow duration-300">
                    <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Mood-Based Discovery</h3>
                    <p class="text-gray-600">Find your next read based on how you're feeling. Adventurous? Cozy? We've got the perfect book for every mood.</p>
                </div>

                {{-- Feature 3: Book Clubs --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-lg transition-shadow duration-300">
                    <div class="w-14 h-14 bg-pink-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Join Book Clubs</h3>
                    <p class="text-gray-600">Connect with fellow readers, share recommendations, and discuss your favorite books in community groups.</p>
                </div>

                {{-- Feature 4: Reviews & Ratings --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-lg transition-shadow duration-300">
                    <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-yellow-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Reviews & Ratings</h3>
                    <p class="text-gray-600">Share your thoughts and read honest reviews from other readers. Help others discover their next great read.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Mood Discovery Section --}}
    @if($featuredMoods->count() > 0)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">What Are You in the Mood For?</h2>
                <p class="mt-4 text-xl text-gray-600">Discover books that match your current vibe</p>
            </div>

            <div class="flex flex-wrap justify-center gap-4">
                @foreach($featuredMoods as $mood)
                    <a href="{{ route('books.index', ['mood' => $mood->slug]) }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-50 hover:bg-indigo-100 rounded-full text-gray-700 font-medium transition-all duration-200 hover:scale-105 hover:shadow-md">
                        @if($mood->emoji)
                            <span class="text-xl">{{ $mood->emoji }}</span>
                        @endif
                        <span>{{ $mood->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Featured Books Section --}}
    @if($featuredBooks->count() > 0)
    <section class="py-20 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Featured Books</h2>
                    <p class="mt-2 text-xl text-gray-600">Recently added to our collection</p>
                </div>
                <a href="{{ route('books.index') }}" class="hidden sm:inline-flex items-center text-indigo-600 hover:text-indigo-700 font-semibold">
                    View All Books
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($featuredBooks as $book)
                    <a href="{{ route('books.show', $book) }}" class="group">
                        <div class="aspect-[2/3] rounded-xl overflow-hidden shadow-md group-hover:shadow-xl transition-all duration-300 group-hover:-translate-y-1">
                            @if($book->cover_image)
                                <img src="{{ Storage::url($book->cover_image) }}" 
                                     alt="{{ $book->title }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-indigo-400 flex items-center justify-center p-4">
                                    <span class="text-white text-center font-semibold text-sm line-clamp-3">{{ $book->title }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="mt-3">
                            <h3 class="font-semibold text-gray-900 line-clamp-1 group-hover:text-indigo-600 transition-colors">{{ $book->title }}</h3>
                            <p class="text-sm text-gray-500 line-clamp-1">{{ $book->author }}</p>
                            @if($book->average_rating > 0)
                                <div class="flex items-center mt-1">
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="text-sm text-gray-600 ml-1">{{ number_format($book->average_rating, 1) }}</span>
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8 text-center sm:hidden">
                <a href="{{ route('books.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-semibold">
                    View All Books
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- Book Clubs Section --}}
    @if($popularClubs->count() > 0)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Popular Book Clubs</h2>
                    <p class="mt-2 text-xl text-gray-600">Join the conversation with fellow readers</p>
                </div>
                <a href="{{ route('book-clubs.index') }}" class="hidden sm:inline-flex items-center text-indigo-600 hover:text-indigo-700 font-semibold">
                    View All Clubs
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($popularClubs as $club)
                    <a href="{{ route('book-clubs.show', $club) }}" class="group bg-gray-50 rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300">
                        <div class="aspect-video relative">
                            @if($club->image)
                                <img src="{{ Storage::url($club->image) }}" 
                                     alt="{{ $club->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-purple-400 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute bottom-3 right-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/90 text-gray-700">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    {{ $club->members_count }} {{ Str::plural('member', $club->members_count) }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $club->name }}</h3>
                            @if($club->description)
                                <p class="mt-2 text-gray-600 line-clamp-2">{{ $club->description }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8 text-center sm:hidden">
                <a href="{{ route('book-clubs.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-semibold">
                    View All Clubs
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- Latest News Section --}}
    @if($latestNews->count() > 0)
    <section class="py-20 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Latest News</h2>
                    <p class="mt-2 text-xl text-gray-600">Stay updated with our community</p>
                </div>
                <a href="{{ route('news.index') }}" class="hidden sm:inline-flex items-center text-indigo-600 hover:text-indigo-700 font-semibold">
                    View All News
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($latestNews as $news)
                    <a href="{{ route('news.show', $news) }}" class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="aspect-video relative">
                            @if($news->image)
                                <img src="{{ Storage::url($news->image) }}" 
                                     alt="{{ $news->title }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-indigo-500 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="text-sm text-indigo-600 font-medium mb-2">
                                {{ $news->published_at->format('M d, Y') }}
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors line-clamp-2">{{ $news->title }}</h3>
                            @if($news->content)
                                <p class="mt-2 text-gray-600 line-clamp-2">{{ Str::limit(strip_tags($news->content), 120) }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8 text-center sm:hidden">
                <a href="{{ route('news.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-semibold">
                    View All News
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- Stats Section --}}
    <section class="py-16 bg-indigo-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <div class="text-5xl font-bold text-white">{{ number_format($stats['books']) }}</div>
                    <div class="mt-2 text-xl text-indigo-200">Books in Library</div>
                </div>
                <div>
                    <div class="text-5xl font-bold text-white">{{ number_format($stats['users']) }}</div>
                    <div class="mt-2 text-xl text-indigo-200">Active Readers</div>
                </div>
                <div>
                    <div class="text-5xl font-bold text-white">{{ number_format($stats['clubs']) }}</div>
                    <div class="mt-2 text-xl text-indigo-200">Book Clubs</div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section (Guest only) --}}
    @guest
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Ready to Start Your Reading Journey?</h2>
            <p class="mt-4 text-xl text-gray-600">Join thousands of readers who track their books, discover new favorites, and connect with book clubs on PageTurner.</p>
            <div class="mt-8">
                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 text-lg font-semibold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    Create Your Free Account
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endguest

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                {{-- Brand --}}
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 text-2xl font-bold text-white mb-4">
                        <svg class="w-7 h-7 text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        PageTurner
                    </div>
                    <p class="text-gray-400 max-w-md">The modern way to track your reading journey. Discover new books, join book clubs, and connect with fellow readers.</p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h3 class="text-white font-semibold mb-4">Explore</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('books.index') }}" class="hover:text-white transition-colors">Books</a></li>
                        <li><a href="{{ route('book-clubs.index') }}" class="hover:text-white transition-colors">Book Clubs</a></li>
                        <li><a href="{{ route('news.index') }}" class="hover:text-white transition-colors">News</a></li>
                    </ul>
                </div>

                {{-- Support --}}
                <div>
                    <h3 class="text-white font-semibold mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('faq.index') }}" class="hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="{{ route('contact.create') }}" class="hover:text-white transition-colors">Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                <p>&copy; {{ date('Y') }} PageTurner. All rights reserved.</p>
            </div>
        </div>
    </footer>
</x-app-layout>
