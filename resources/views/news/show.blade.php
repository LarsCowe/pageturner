<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('news.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to News
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <!-- Article Header -->
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $newsItem->title }}</h1>
                    
                    <div class="text-sm text-gray-600 mb-6">
                        By <a href="{{ route('profile.show', $newsItem->author) }}" class="text-indigo-600 hover:underline">{{ $newsItem->author->name }}</a> • Published on {{ $newsItem->published_at->format('F j, Y') }}
                    </div>

                    <!-- Featured Image -->
                    @if($newsItem->image)
                        <div class="mb-8">
                            <img src="{{ Storage::url($newsItem->image) }}" 
                                 alt="{{ $newsItem->title }}"
                                 class="w-full h-96 object-cover rounded-lg">
                        </div>
                    @endif

                    <!-- Article Content -->
                    <div class="prose prose-lg max-w-none">
                        {!! nl2br(e($newsItem->content)) !!}
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">
                        Comments ({{ $newsItem->comments->count() }})
                    </h2>

                    <!-- Comment List -->
                    <div class="space-y-6 mb-8">
                        @forelse($newsItem->comments as $comment)
                            <div class="flex space-x-4">
                                <div class="flex-shrink-0">
                                    <a href="{{ route('profile.show', $comment->user) }}" class="block hover:opacity-80 transition">
                                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-sm font-bold text-gray-600">
                                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="flex-1">
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="flex items-center justify-between mb-2">
                                            <a href="{{ route('profile.show', $comment->user) }}" class="font-medium text-gray-900 hover:text-indigo-600 transition">
                                                {{ $comment->user->name }}
                                            </a>
                                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="text-gray-700">
                                            {!! nl2br(e($comment->body)) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No comments yet. Be the first to comment!</p>
                        @endforelse
                    </div>

                    <!-- Comment Form -->
                    @auth
                        <div class="border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Leave a Comment</h3>
                            <div class="flex space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                        <span class="text-sm font-bold text-indigo-600">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <form action="{{ route('news.comments.store', $newsItem) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <textarea name="body" rows="3" required maxlength="1000"
                                                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                      placeholder="Write a comment..."></textarea>
                                            @error('body')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                                                Post Comment
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="border-t pt-6 text-center">
                            <p class="text-gray-600">
                                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Log in</a> to leave a comment.
                            </p>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
