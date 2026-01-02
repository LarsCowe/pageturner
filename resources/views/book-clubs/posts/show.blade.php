<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Back Link -->
            <div class="mb-6">
                <a href="{{ route('book-clubs.show', $bookClub) }}" 
                   class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to {{ $bookClub->name }}
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <!-- Post Header -->
                <div class="p-6 border-b">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $post->title }}</h1>
                    <div class="flex items-center text-sm text-gray-500 space-x-4">
                        <a href="{{ route('profile.show', $post->user) }}" class="flex items-center hover:text-indigo-600 transition">
                            <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center mr-2">
                                <span class="text-xs font-bold text-indigo-600">
                                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                </span>
                            </div>
                            {{ $post->user->name }}
                        </a>
                        <span>{{ $post->created_at->format('M d, Y H:i') }}</span>
                    </div>
                </div>

                <!-- Post Body -->
                <div class="p-6 prose max-w-none">
                    {!! nl2br(e($post->body)) !!}
                </div>

                <!-- Comments Section -->
                <div class="bg-gray-50 p-6 border-t">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Comments ({{ $post->comments->count() }})</h3>

                    <!-- Comment List -->
                    <div class="space-y-6 mb-8">
                        @foreach($post->comments as $comment)
                            <div class="flex space-x-4">
                                <div class="flex-shrink-0">
                                    <a href="{{ route('profile.show', $comment->user) }}" class="block hover:opacity-80 transition">
                                        <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-xs font-bold text-gray-600">
                                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="flex-1">
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
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
                        @endforeach
                    </div>

                    <!-- Reply Form -->
                    <div class="flex space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                <span class="text-xs font-bold text-indigo-600">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <form action="{{ route('book-clubs.comments.store', $post) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <textarea name="body" rows="3" required
                                              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                              placeholder="Write a comment..."></textarea>
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
            </div>
        </div>
    </div>
</x-app-layout>
