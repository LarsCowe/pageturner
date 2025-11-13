<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-4xl font-bold text-gray-900 mb-8">Latest News</h1>

                    <div class="space-y-6">
                        @forelse($newsItems as $item)
                            <a href="{{ route('news.show', $item) }}" class="block hover:bg-gray-50 transition rounded-lg p-4">
                                <div class="flex gap-6">
                                    @if($item->image)
                                        <div class="flex-shrink-0">
                                            <img src="{{ Storage::url($item->image) }}" 
                                                 alt="{{ $item->title }}"
                                                 class="w-40 h-40 object-cover rounded-lg">
                                        </div>
                                    @else
                                        <div class="flex-shrink-0">
                                            <div class="w-40 h-40 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                                                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                                </svg>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="flex-1">
                                        <div class="text-sm text-gray-500 mb-2">
                                            By {{ $item->author->name }} • {{ $item->published_at->format('F j, Y') }}
                                        </div>
                                        <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $item->title }}</h2>
                                        <p class="text-gray-600 line-clamp-2">
                                            {{ Str::limit(strip_tags($item->content), 200) }}
                                        </p>
                                    </div>
                                </div>
                            </a>

                            @if(!$loop->last)
                                <hr class="my-6">
                            @endif
                        @empty
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No news yet</h3>
                                <p class="mt-1 text-sm text-gray-500">Check back later for updates.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($newsItems->hasPages())
                        <div class="mt-8">
                            {{ $newsItems->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
