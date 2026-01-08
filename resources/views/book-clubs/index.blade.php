<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold font-serif text-stone-100 mb-2">Find Your Reading Community</h1>
                        <p class="text-stone-400">Join a book club and connect with fellow readers who share your interests.</p>
                    </div>
                    @auth
                        <a href="{{ route('book-clubs.create') }}" 
                           class="px-6 py-3 bg-amber-600 text-stone-900 font-bold rounded-lg hover:bg-amber-500 transition inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Create Book Club
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Book Clubs Grid -->
            <div class="bg-stone-900 rounded-lg shadow-sm p-6 border border-stone-800">
                @if($bookClubs->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($bookClubs as $club)
                            <div class="bg-stone-800 border {{ in_array($club->id, $userClubIds) ? 'border-amber-500/50 ring-1 ring-amber-500/20' : 'border-stone-700' }} rounded-lg p-6 hover:shadow-xl hover:border-amber-500/30 transition flex flex-col group">
                                <!-- Member Badge (always reserve space) -->
                                <div class="mb-3 h-6">
                                    @if(in_array($club->id, $userClubIds))
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-900/40 text-amber-500 border border-amber-900/50">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            Member
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- Club Image/Icon -->
                                <div class="w-16 h-16 bg-stone-700 rounded-full flex items-center justify-center mb-4 ring-4 ring-stone-900 group-hover:ring-amber-900/20 transition">
                                    @if($club->image)
                                        <img src="{{ Storage::url($club->image) }}" 
                                             alt="{{ $club->name }}"
                                             class="w-full h-full object-cover rounded-full">
                                    @else
                                        <svg class="w-8 h-8 text-stone-500 group-hover:text-amber-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    @endif
                                </div>

                                <!-- Club Info -->
                                <h3 class="text-lg font-bold font-serif text-stone-100 mb-2 group-hover:text-amber-500 transition">{{ $club->name }}</h3>
                                <p class="text-sm text-stone-400 mb-4 line-clamp-3 h-[60px]">{{ $club->description }}</p>

                                <!-- Spacer to push meta and button to bottom -->
                                <div class="flex-grow"></div>

                                <!-- Meta Info -->
                                <div class="flex items-center justify-between text-sm text-stone-500 mb-4">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        {{ $club->members_count }} {{ Str::plural('member', $club->members_count) }}
                                    </span>
                                    <span class="text-xs">by {{ $club->creator->name }}</span>
                                </div>

                                <!-- Action Button -->
                                <a href="{{ route('book-clubs.show', $club) }}" 
                                   class="block w-full text-center px-4 py-2 bg-stone-900 border border-stone-700 text-stone-300 font-bold rounded-lg hover:bg-amber-600 hover:text-stone-900 hover:border-amber-600 transition">
                                    View Club
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($bookClubs->hasPages())
                        <div class="mt-8">
                            {{ $bookClubs->links() }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-12 bg-stone-800 rounded-lg border border-stone-700 border-dashed">
                        <svg class="mx-auto h-12 w-12 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-bold text-stone-300">No book clubs yet</h3>
                        <p class="mt-1 text-sm text-stone-500">Be the first to start a reading community!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
