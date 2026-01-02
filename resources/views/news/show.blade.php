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
        </div>
    </div>
</x-app-layout>
