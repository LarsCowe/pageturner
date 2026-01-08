<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-stone-100 leading-tight font-serif">
                {{ __('Book Management') }}
            </h2>
            <a href="{{ route('admin.books.create') }}" class="inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-500 transition shadow-lg shadow-amber-900/20">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Book
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-900 border border-stone-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Search -->
                    <div class="mb-6">
                        <form method="GET" class="flex gap-4">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Search by title, author, or ISBN..."
                                   class="flex-1 rounded-lg border-stone-700 bg-stone-950 text-stone-100 placeholder-stone-500 focus:border-amber-500 focus:ring-amber-500">
                            <button type="submit" class="px-4 py-2 bg-stone-800 text-stone-300 rounded-lg hover:bg-stone-700 border border-stone-700">
                                Search
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.books.index') }}" class="px-4 py-2 bg-stone-800 text-stone-300 rounded-lg hover:bg-stone-700 border border-stone-700">
                                    Clear
                                </a>
                            @endif
                        </form>
                    </div>

                    <!-- Books Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-stone-800">
                            <thead class="bg-stone-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                        Cover
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                        Author
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                        ISBN
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                        Reviews
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-stone-400 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-stone-900 divide-y divide-stone-800">
                                @forelse($books as $book)
                                    <tr class="hover:bg-stone-800/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($book->cover_image)
                                                <img src="{{ Storage::url($book->cover_image) }}" 
                                                     alt="{{ $book->title }}"
                                                     class="w-12 h-16 object-cover rounded shadow-md shadow-black/40">
                                            @else
                                                <div class="w-12 h-16 bg-stone-800 rounded flex items-center justify-center border border-stone-700">
                                                    <svg class="w-6 h-6 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-stone-100 font-serif">{{ $book->title }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-stone-400">{{ $book->author }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-stone-400">{{ $book->isbn ?? '-' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-stone-400">{{ $book->reviews_count }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('books.show', $book) }}" 
                                                   class="text-stone-400 hover:text-stone-100 transition-colors"
                                                   title="View">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('admin.books.edit', $book) }}" 
                                                   class="text-amber-500 hover:text-amber-400 transition-colors"
                                                   title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.books.destroy', $book) }}" 
                                                      method="POST" 
                                                      class="inline"
                                                      x-data
                                                      @submit.prevent="if(confirm('Are you sure you want to delete this book? This will also delete all reviews and shelf entries.')) { $el.submit(); }">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-500 hover:text-red-400 transition-colors"
                                                            title="Delete">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-stone-500">
                                            <svg class="mx-auto h-12 w-12 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                            <p class="mt-2">No books found.</p>
                                            <a href="{{ route('admin.books.create') }}" class="mt-4 inline-block text-amber-500 hover:text-amber-400 font-medium">
                                                Add your first book
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($books->hasPages())
                        <div class="mt-6">
                            {{ $books->appends(['search' => request('search')])->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
