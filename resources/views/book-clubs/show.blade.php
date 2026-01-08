<x-app-layout>
    <div class="py-12" x-data>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Back Link -->
            <div class="mb-6">
                <a href="{{ route('book-clubs.index') }}" 
                   class="inline-flex items-center text-stone-400 hover:text-amber-500 font-medium transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to all Book Clubs
                </a>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="bg-stone-900 rounded-lg shadow-sm p-6 border border-stone-800">
                        <!-- Club Header -->
                        <div class="flex items-start justify-between mb-6">
                            <div class="flex items-start space-x-4 flex-1">
                                <div class="w-20 h-20 bg-stone-800 rounded-full flex items-center justify-center flex-shrink-0 ring-4 ring-stone-800 overflow-hidden">
                                    @if($bookClub->image)
                                        <img src="{{ Storage::url($bookClub->image) }}" 
                                             alt="{{ $bookClub->name }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-10 h-10 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1 pt-2">
                                    <h1 class="text-3xl font-bold font-serif text-stone-100">{{ $bookClub->name }}</h1>
                                    <p class="text-stone-400 mt-1">
                                        Created by 
                                        <a href="{{ route('profile.show', $bookClub->creator->username) }}" class="text-amber-500 hover:text-amber-400 font-medium">
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
                                           class="px-4 py-2 bg-stone-800 text-stone-300 border border-stone-700 rounded-lg hover:bg-stone-700 hover:text-white transition text-sm font-bold">
                                            Edit Club
                                        </a>
                                        <form action="{{ route('book-clubs.destroy', $bookClub) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-4 py-2 bg-red-900/30 text-red-400 border border-red-900/50 rounded-lg hover:bg-red-900/50 hover:text-red-300 transition text-sm font-bold"
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
                        <div class="prose prose-invert max-w-none mb-8 bg-stone-950/50 p-6 rounded-lg border border-stone-800">
                            <h3 class="text-xl font-bold font-serif text-stone-100 mb-3 mt-0">About this Club</h3>
                            <p class="text-stone-300 leading-relaxed">{{ $bookClub->description }}</p>
                        </div>

                        <!-- Join/Leave Actions -->
                        @auth
                            <div class="border-t border-stone-800 pt-6">
                                @if($isMember)
                                    <div class="flex items-center justify-between bg-stone-800/50 p-4 rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-amber-900/30 text-amber-500 border border-amber-900/50">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Member
                                            </span>
                                            @if($userRole === 'moderator')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-purple-900/30 text-purple-400 border border-purple-900/50">
                                                    Moderator
                                                </span>
                                            @endif
                                        </div>
                                        @if($bookClub->creator_id !== auth()->id())
                                            <form action="{{ route('book-clubs.leave', $bookClub) }}" method="POST">
                                                @csrf
                                                <button type="submit" 
                                                        class="px-4 py-2 text-stone-400 hover:text-red-400 hover:bg-red-900/10 rounded-lg transition text-sm font-medium"
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
                                                class="w-full px-6 py-4 bg-amber-600 text-stone-900 rounded-lg hover:bg-amber-500 transition font-bold text-lg shadow-lg shadow-amber-900/20">
                                            Join This Book Club
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @else
                            <div class="border-t border-stone-800 pt-6 text-center">
                                <p class="text-stone-400 mb-4 font-serif italic text-lg">Want to join this book club?</p>
                                <a href="{{ route('login') }}" class="inline-block px-8 py-3 bg-amber-600 text-stone-900 font-bold rounded-lg hover:bg-amber-500 transition shadow-lg">
                                    Login to Join
                                </a>
                            </div>
                        @endauth
                    </div>

                    <!-- Discussions Section -->
                    <div class="bg-stone-900 rounded-lg shadow-sm p-6 mt-6 border border-stone-800">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold font-serif text-stone-100">Discussions</h3>
                            @auth
                                @if($isMember)
                                    <button @click="$dispatch('open-modal', 'new-post-modal')" class="px-4 py-2 bg-stone-800 hover:bg-stone-700 text-amber-500 font-bold rounded-lg transition text-sm border border-stone-700">
                                        + Start Discussion
                                    </button>
                                @endif
                            @endauth
                        </div>

                        @if($bookClub->posts->count() > 0)
                            <div class="space-y-4">
                                @foreach($bookClub->posts as $post)
                                    <div class="group border border-stone-800 rounded-lg p-5 hover:bg-stone-800/80 hover:border-amber-500/30 transition bg-stone-950/30">
                                        <a href="{{ route('book-clubs.posts.show', [$bookClub, $post]) }}" class="block">
                                            <h4 class="text-lg font-bold text-stone-200 mb-2 group-hover:text-amber-500 transition">{{ $post->title }}</h4>
                                            <div class="flex items-center text-sm text-stone-500 space-x-4">
                                                <span class="flex items-center">
                                                    @if($post->user->avatar)
                                                        <img src="{{ Storage::url($post->user->avatar) }}" class="w-5 h-5 rounded-full mr-2 object-cover">
                                                    @else
                                                        <div class="w-5 h-5 rounded-full bg-stone-700 mr-2"></div>
                                                    @endif
                                                    {{ $post->user->name }}
                                                </span>
                                                <span>{{ $post->created_at->diffForHumans() }}</span>
                                                <span class="flex items-center text-stone-400">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                    </svg>
                                                    {{ $post->comments->count() }}
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 border-2 border-dashed border-stone-800 rounded-lg">
                                <p class="text-stone-500 italic">No discussions yet. Be the first to start one!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar - Members -->
                <div class="lg:col-span-1">
                    <div class="bg-stone-900 rounded-lg shadow-sm p-6 border border-stone-800 sticky top-8">
                        <h3 class="text-lg font-bold font-serif text-stone-100 mb-4 pb-4 border-b border-stone-800">
                            Members ({{ $bookClub->members->count() }})
                        </h3>
                        
                        <div class="space-y-3 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">
                            @foreach($bookClub->members as $member)
                                <a href="{{ route('profile.show', $member->username) }}" 
                                   class="flex items-center space-x-3 p-3 rounded-lg hover:bg-stone-800 transition group">
                                    <!-- Avatar -->
                                    <div class="w-10 h-10 rounded-full bg-stone-800 flex items-center justify-center flex-shrink-0 ring-2 ring-stone-800 group-hover:ring-amber-500/50 transition">
                                        @if($member->avatar)
                                            <img src="{{ Storage::url($member->avatar) }}" 
                                                 alt="{{ $member->name }}"
                                                 class="w-full h-full object-cover rounded-full">
                                        @else
                                            <span class="text-stone-500 font-bold text-xs group-hover:text-amber-500">
                                                {{ strtoupper(substr($member->name, 0, 2)) }}
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <!-- Name & Role -->
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-stone-300 group-hover:text-stone-100 truncate transition">
                                            {{ $member->name }}
                                        </p>
                                        <p class="text-xs text-stone-500 group-hover:text-stone-400">
                                            @if($member->id === $bookClub->creator_id)
                                                <span class="text-amber-500 font-medium">Creator</span>
                                            @elseif($member->pivot->role === 'moderator')
                                                <span class="text-purple-400 font-medium">Moderator</span>
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
            <div class="bg-stone-900 p-6 border border-stone-800">
                <form action="{{ route('book-clubs.posts.store', $bookClub) }}" method="POST">
                    @csrf
                    
                    <h2 class="text-xl font-bold font-serif text-stone-100 mb-6">
                        Start a New Discussion
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <x-input-label for="title" value="Discussion Title" class="text-stone-300" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full bg-stone-950 border-stone-700 text-stone-100 focus:border-amber-500 focus:ring-amber-500" placeholder="What's on your mind?" required />
                        </div>

                        <div>
                            <x-input-label for="body" value="Content" class="text-stone-300" />
                            <textarea id="body" name="body" rows="6" 
                                      class="mt-1 block w-full bg-stone-950 border-stone-700 text-stone-100 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm resize-none p-3" 
                                      placeholder="Share your thoughts with the club..."
                                      required></textarea>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3">
                        <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 bg-stone-800 text-stone-400 hover:text-stone-200 font-bold rounded-lg transition">
                            Cancel
                        </button>

                        <button type="submit" class="px-6 py-2 bg-amber-600 hover:bg-amber-500 text-stone-900 font-bold rounded-lg transition">
                            Post Discussion
                        </button>
                    </div>
                </form>
            </div>
        </x-modal>
    </div>
</x-app-layout>
