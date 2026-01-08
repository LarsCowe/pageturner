<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Back Link -->
            <div class="mb-6">
                <a href="{{ route('book-clubs.show', $bookClub) }}" 
                   class="inline-flex items-center text-stone-400 hover:text-amber-500 font-medium transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to {{ $bookClub->name }}
                </a>
            </div>

            <div class="bg-stone-900 rounded-lg shadow-sm overflow-hidden border border-stone-800">
                <!-- Post Header -->
                <div class="p-6 border-b border-stone-800">
                    <h1 class="text-3xl font-bold font-serif text-stone-100 mb-3">{{ $post->title }}</h1>
                    <div class="flex items-center text-sm text-stone-500 space-x-4">
                        <a href="{{ route('profile.show', $post->user) }}" class="flex items-center hover:text-amber-500 transition group">
                            <div class="w-6 h-6 rounded-full bg-stone-800 flex items-center justify-center mr-2 ring-1 ring-stone-700 group-hover:ring-amber-500/50">
                                @if($post->user->avatar)
                                    <img src="{{ Storage::url($post->user->avatar) }}" class="w-full h-full rounded-full object-cover">
                                @else 
                                    <span class="text-xs font-bold text-stone-400 group-hover:text-amber-500">
                                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                    </span>
                                @endif
                            </div>
                            <span class="font-medium text-stone-300 group-hover:text-amber-500">{{ $post->user->name }}</span>
                        </a>
                        <span class="text-stone-600">•</span>
                        <span>{{ $post->created_at->format('M d, Y H:i') }}</span>
                    </div>
                </div>

                <!-- Post Body -->
                <div class="p-8 prose prose-invert max-w-none text-stone-300 leading-relaxed">
                    {!! nl2br(e($post->body)) !!}
                </div>

                <!-- Comments Section -->
                <div class="bg-black/20 p-6 border-t border-stone-800">
                    <h3 class="text-lg font-bold font-serif text-stone-100 mb-6 flex items-center gap-2">
                        <span>Comments</span>
                        <span class="bg-stone-800 text-stone-400 px-2 py-0.5 rounded-full text-xs">{{ $post->comments->count() }}</span>
                    </h3>

                    <!-- Comment List -->
                    <div class="space-y-6 mb-8">
                        @foreach($post->comments as $comment)
                            <div class="flex space-x-4">
                                <div class="flex-shrink-0">
                                    <a href="{{ route('profile.show', $comment->user) }}" class="block hover:opacity-80 transition">
                                        <div class="w-10 h-10 rounded-full bg-stone-800 flex items-center justify-center ring-1 ring-stone-700">
                                            @if($comment->user->avatar)
                                                <img src="{{ Storage::url($comment->user->avatar) }}" class="w-full h-full rounded-full object-cover">
                                            @else
                                                <span class="text-xs font-bold text-stone-400">
                                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                                </span>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                                <div class="flex-1">
                                    <div class="bg-stone-800 rounded-lg p-5 border border-stone-700/50 shadow-sm relative group">
                                        <div class="absolute top-4 left-[-8px] w-2 h-2 bg-stone-800 transform rotate-45 border-l border-b border-stone-700/50"></div>
                                        <div class="flex items-center justify-between mb-2">
                                            <a href="{{ route('profile.show', $comment->user) }}" class="font-bold text-stone-200 hover:text-amber-500 transition">
                                                {{ $comment->user->name }}
                                            </a>
                                            <span class="text-xs text-stone-500 font-medium">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="text-stone-300/90 leading-relaxed">
                                            {!! nl2br(e($comment->body)) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Reply Form -->
                    <div class="flex space-x-4 pt-4 border-t border-stone-800/50">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-stone-800 flex items-center justify-center ring-1 ring-stone-700">
                                @if(auth()->user()->avatar)
                                    <img src="{{ Storage::url(auth()->user()->avatar) }}" class="w-full h-full rounded-full object-cover">
                                @else
                                    <span class="text-xs font-bold text-stone-400">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1">
                            <form action="{{ route('book-clubs.comments.store', $post) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <textarea name="body" rows="3" required
                                              class="block w-full rounded-lg bg-stone-900 border-stone-700 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-stone-100 placeholder-stone-600 sm:text-sm p-3 resize-none"
                                              placeholder="Write a comment..."></textarea>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="px-5 py-2 bg-amber-600 text-stone-900 rounded-lg hover:bg-amber-500 transition text-sm font-bold shadow-lg">
                                        Post Comment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
