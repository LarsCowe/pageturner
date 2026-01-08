<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-stone-100 leading-tight font-serif">
                {{ __('News Management') }}
            </h2>
            <a href="{{ route('admin.news.create') }}" class="inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-500 transition shadow-lg shadow-amber-900/20">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create New Post
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-900 border border-stone-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Search and Filters -->
                    <div class="mb-6 flex gap-4">
                        <form method="GET" class="flex-1 flex gap-4">
                            <div class="flex-1">
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Search by title..."
                                       class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 placeholder-stone-500 focus:border-amber-500 focus:ring-amber-500">
                            </div>
                            <button type="submit" class="px-4 py-2 bg-stone-800 text-stone-300 rounded-lg hover:bg-stone-700 border border-stone-700">
                                Search
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.news.index') }}" class="px-4 py-2 bg-stone-800 text-stone-300 rounded-lg hover:bg-stone-700 border border-stone-700">
                                    Clear
                                </a>
                            @endif
                        </form>
                    </div>

                    <!-- News Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-stone-800">
                            <thead class="bg-stone-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                        Author
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                        Published Date
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-stone-400 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-stone-900 divide-y divide-stone-800">
                                @forelse($newsItems as $item)
                                    <tr class="hover:bg-stone-800/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-stone-100 font-serif">{{ $item->title }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-stone-400">{{ $item->author->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($item->published_at->isPast())
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-900/50 text-emerald-400 border border-emerald-800">
                                                    Published
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-900/50 text-amber-500 border border-amber-800">
                                                    Draft
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-400">
                                            {{ $item->published_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('news.show', $item) }}" 
                                                   target="_blank"
                                                   class="px-3 py-1 bg-stone-800 text-stone-300 rounded hover:bg-stone-700 transition border border-stone-700">
                                                    View
                                                </a>
                                                <a href="{{ route('admin.news.edit', $item) }}" 
                                                   class="px-3 py-1 bg-amber-700/50 text-amber-200 rounded hover:bg-amber-600/50 transition border border-amber-700/50">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.news.destroy', $item) }}" 
                                                      method="POST" 
                                                      class="inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this news item?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-3 py-1 bg-red-900/40 text-red-300 rounded hover:bg-red-800/60 transition border border-red-900/50">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-stone-500">
                                            <svg class="mx-auto h-12 w-12 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                            </svg>
                                            <p class="mt-2">No news items found.</p>
                                            <a href="{{ route('admin.news.create') }}" class="mt-4 inline-block text-amber-500 hover:text-amber-400 font-medium">
                                                Create your first news item
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($newsItems->hasPages())
                        <div class="mt-6">
                            {{ $newsItems->links() }}
                        </div>
                    @endif

                    <div class="mt-6 text-sm text-stone-500">
                        Showing {{ $newsItems->firstItem() ?? 0 }} to {{ $newsItems->lastItem() ?? 0 }} of {{ $newsItems->total() }} results
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
