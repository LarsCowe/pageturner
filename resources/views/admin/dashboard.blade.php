<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Section -->
            <div class="bg-stone-900 border border-stone-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-stone-100">
                    <h3 class="text-2xl font-bold font-serif text-stone-100">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p class="mt-2 text-stone-400">Here's what's happening in PageTurner today.</p>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Users -->
                <div class="bg-stone-900 border border-stone-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-l-indigo-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-stone-800 text-indigo-400">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-stone-400">Total Users</p>
                            <p class="text-2xl font-semibold text-stone-100">{{ $stats['users'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Books -->
                <div class="bg-stone-900 border border-stone-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-l-emerald-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-stone-800 text-emerald-400">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-stone-400">Books</p>
                            <p class="text-2xl font-semibold text-stone-100">{{ $stats['books'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Reviews -->
                <div class="bg-stone-900 border border-stone-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-l-amber-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-stone-800 text-amber-500">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-stone-400">Reviews</p>
                            <p class="text-2xl font-semibold text-stone-100">{{ $stats['reviews'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Book Clubs -->
                <div class="bg-stone-900 border border-stone-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-l-purple-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-stone-800 text-purple-400">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-stone-400">Book Clubs</p>
                            <p class="text-2xl font-semibold text-stone-100">{{ $stats['book_clubs'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <h3 class="text-lg font-semibold text-stone-100 mb-4 font-serif">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('admin.news.create') }}" class="block p-6 bg-stone-900 border border-stone-800 rounded-lg shadow hover:bg-stone-800 transition group">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-stone-100 group-hover:text-amber-500 transition-colors">Write News</h5>
                    <p class="font-normal text-stone-400">Publish a new update or announcement for the community.</p>
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="block p-6 bg-stone-900 border border-stone-800 rounded-lg shadow hover:bg-stone-800 transition group">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-stone-100 group-hover:text-amber-500 transition-colors">Manage Users</h5>
                    <p class="font-normal text-stone-400">View user list, promote admins, or manage accounts.</p>
                </a>

                <a href="{{ route('admin.books.create') }}" class="block p-6 bg-stone-900 border border-stone-800 rounded-lg shadow hover:bg-stone-800 transition group">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-stone-100 group-hover:text-amber-500 transition-colors">Add Book</h5>
                    <p class="font-normal text-stone-400">Add a new book to the PageTurner library.</p>
                </a>
            </div>

        </div>
    </div>
</x-admin-layout>
