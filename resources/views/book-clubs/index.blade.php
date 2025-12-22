<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Find Your Reading Community</h1>
                        <p class="text-gray-600">Join a book club and connect with fellow readers who share your interests.</p>
                    </div>
                    @auth
                        <a href="{{ route('book-clubs.create') }}" 
                           class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Create Book Club
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Book Clubs Grid -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                @if($bookClubs->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($bookClubs as $club)
                            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition {{ in_array($club->id, $userClubIds) ? 'ring-2 ring-green-500' : '' }} flex flex-col">
                                <!-- Member Badge (always reserve space) -->
                                <div class="mb-3 h-6">
                                    @if(in_array($club->id, $userClubIds))
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            Member
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- Club Image/Icon -->
                                <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center mb-4">
                                    @if($club->image)
                                        <img src="{{ Storage::url($club->image) }}" 
                                             alt="{{ $club->name }}"
                                             class="w-full h-full object-cover rounded-full">
                                    @else
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    @endif
                                </div>

                                <!-- Club Info -->
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $club->name }}</h3>
                                <p class="text-sm text-gray-600 mb-4 line-clamp-3 h-[60px]">{{ $club->description }}</p>

                                <!-- Spacer to push meta and button to bottom -->
                                <div class="flex-grow"></div>

                                <!-- Meta Info -->
                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        {{ $club->members_count }} {{ Str::plural('member', $club->members_count) }}
                                    </span>
                                    <span>by {{ $club->creator->name }}</span>
                                </div>

                                <!-- Action Button -->
                                <a href="{{ route('book-clubs.show', $club) }}" 
                                   class="block w-full text-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
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
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No book clubs yet</h3>
                        <p class="mt-1 text-sm text-gray-500">Be the first to start a reading community!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
