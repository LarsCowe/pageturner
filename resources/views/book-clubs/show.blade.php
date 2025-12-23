<x-app-layout>
    <div class="py-12" x-data>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Back Link -->
            <div class="mb-6">
                <a href="{{ route('book-clubs.index') }}" 
                   class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to all Book Clubs
                </a>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <!-- Club Header -->
                        <div class="flex items-start justify-between mb-6">
                            <div class="flex items-start space-x-4 flex-1">
                                <div class="w-20 h-20 bg-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    @if($bookClub->image)
                                        <img src="{{ Storage::url($bookClub->image) }}" 
                                             alt="{{ $bookClub->name }}"
                                             class="w-full h-full object-cover rounded-full">
                                    @else
                                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h1 class="text-2xl font-bold text-gray-900">{{ $bookClub->name }}</h1>
                                    <p class="text-gray-600">
                                        Created by 
                                        <a href="{{ route('profile.show', $bookClub->creator->username) }}" class="text-indigo-600 hover:underline">
                                            {{ $bookClub->creator->name }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Creator Actions -->
                            @auth
                                @if($bookClub->creator_id === auth()->id())
                                    <div class="flex gap-3">
                                        <a href="{{ route('book-clubs.edit', $bookClub) }}" 
                                           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm">
                                            Edit Club
                                        </a>
                                        <form action="{{ route('book-clubs.destroy', $bookClub) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm"
                                                    x-data
                                                    @click.prevent="if(confirm('Are you sure you want to delete this book club? This action cannot be undone.')) { $el.closest('form').submit(); }">
                                                Delete Club
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>

                        <!-- Description -->
                        <div class="prose max-w-none mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">About this Club</h3>
                            <p class="text-gray-600">{{ $bookClub->description }}</p>
                        </div>

                        <!-- Join/Leave Actions -->
                        @auth
                            <div class="border-t pt-6">
                                @if($isMember)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Member
                                            </span>
                                            @if($userRole === 'moderator')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                                    Moderator
                                                </span>
                                            @endif
                                        </div>
                                        @if($bookClub->creator_id !== auth()->id())
                                            <form action="{{ route('book-clubs.leave', $bookClub) }}" method="POST">
                                                @csrf
                                                <button type="submit" 
                                                        class="px-4 py-2 border border-red-300 text-red-600 rounded-lg hover:bg-red-50 transition"
                                                        x-data
                                                        @click.prevent="if(confirm('Are you sure you want to leave this book club?')) { $el.closest('form').submit(); }">
                                                    Leave Club
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @else
                                    <form action="{{ route('book-clubs.join', $bookClub) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                                            Join This Book Club
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @else
                            <div class="border-t pt-6 text-center">
                                <p class="text-gray-600 mb-4">Want to join this book club?</p>
                                <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                    Login to Join
                                </a>
                            </div>
                        @endauth
                    </div>

                    <!-- Discussions Section -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mt-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Discussions</h3>
                            @auth
                                @if($isMember)
                                    <button @click="$dispatch('open-modal', 'new-post-modal')" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                                        + Start Discussion
                                    </button>
                                @endif
                            @endauth
                        </div>

                        @if($bookClub->posts->count() > 0)
                            <div class="space-y-4">
                                @foreach($bookClub->posts as $post)
                                    <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                        <a href="{{ route('book-clubs.posts.show', [$bookClub, $post]) }}" class="block">
                                            <h4 class="font-medium text-gray-900 mb-1">{{ $post->title }}</h4>
                                            <div class="flex items-center text-sm text-gray-500 space-x-4">
                                                <span>By {{ $post->user->name }}</span>
                                                <span>{{ $post->created_at->diffForHumans() }}</span>
                                                <span>{{ $post->comments->count() }} comments</span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">No discussions yet. Be the first to start one!</p>
                        @endif
                    </div>
                </div>

                <!-- Sidebar - Members -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Members ({{ $bookClub->members->count() }})
                        </h3>
                        
                        <div class="space-y-3">
                            @foreach($bookClub->members as $member)
                                <a href="{{ route('profile.show', $member->username) }}" 
                                   class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 transition">
                                    <!-- Avatar -->
                                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0">
                                        @if($member->avatar)
                                            <img src="{{ Storage::url($member->avatar) }}" 
                                                 alt="{{ $member->name }}"
                                                 class="w-full h-full object-cover rounded-full">
                                        @else
                                            <span class="text-indigo-600 font-semibold text-sm">
                                                {{ strtoupper(substr($member->name, 0, 2)) }}
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <!-- Name & Role -->
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $member->name }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            @if($member->id === $bookClub->creator_id)
                                                Creator
                                            @elseif($member->pivot->role === 'moderator')
                                                Moderator
                                            @else
                                                Member
                                            @endif
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Post Modal -->
        <x-modal name="new-post-modal" focusable>
            <form action="{{ route('book-clubs.posts.store', $bookClub) }}" method="POST" class="p-6">
                @csrf
                
                <h2 class="text-lg font-medium text-gray-900">
                    Start a New Discussion
                </h2>

                <div class="mt-6">
                    <x-input-label for="title" value="Title" />
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                </div>

                <div class="mt-6">
                    <x-input-label for="body" value="Content" />
                    <textarea id="body" name="body" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required></textarea>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Cancel
                    </x-secondary-button>

                    <x-primary-button class="ml-3">
                        Post Discussion
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
