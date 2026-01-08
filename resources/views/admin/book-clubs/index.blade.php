<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-stone-100 leading-tight font-serif">
                {{ __('Book Club Management') }}
            </h2>
            <a href="{{ route('admin.book-clubs.create') }}" class="inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-500 transition shadow-lg shadow-amber-900/20">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                New Book Club
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-900 border border-stone-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <form method="GET" class="flex gap-4">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Search by name, description or creator..."
                                   class="flex-1 rounded-lg border-stone-700 bg-stone-950 text-stone-100 placeholder-stone-500 focus:border-amber-500 focus:ring-amber-500">
                            <button type="submit" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-500 transition shadow-md shadow-amber-900/20">
                                Search
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.book-clubs.index') }}" class="px-4 py-2 bg-stone-800 text-stone-300 rounded-lg hover:bg-stone-700 border border-stone-700">
                                    Clear
                                </a>
                            @endif
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-stone-800">
                            <thead class="bg-stone-950">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase">Image</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase">Creator</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase">Members</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase">Created</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-stone-900 divide-y divide-stone-800">
                                @forelse($bookClubs as $bookClub)
                                    <tr class="hover:bg-stone-800/50 transition-colors">
                                        <td class="px-6 py-4">
                                            @if($bookClub->image)
                                                <img src="{{ Storage::url($bookClub->image) }}" alt="{{ $bookClub->name }}" class="w-16 h-16 object-cover rounded ring-1 ring-stone-800">
                                            @else
                                                <div class="w-16 h-16 bg-stone-800 rounded flex items-center justify-center ring-1 ring-stone-700">
                                                    <svg class="w-8 h-8 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-medium text-stone-200">{{ $bookClub->name }}</span>
                                                @if($bookClub->is_private)
                                                    <span class="px-2 py-1 text-xs font-semibold text-stone-400 bg-stone-800 border border-stone-700 rounded">Private</span>
                                                @endif
                                            </div>
                                            @if($bookClub->description)
                                                <div class="text-sm text-stone-500 truncate max-w-xs">{{ Str::limit($bookClub->description, 50) }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-stone-400">{{ $bookClub->creator->name }}</div></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-stone-400">
                                                {{ $bookClub->members_count }}
                                                @if($bookClub->members_count === 1)
                                                    <span class="text-xs text-stone-500">(creator)</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-stone-400">{{ $bookClub->created_at->format('d/m/Y') }}</div></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('book-clubs.show', $bookClub) }}" class="text-stone-500 hover:text-stone-300" title="View">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('admin.book-clubs.edit', $bookClub) }}" class="text-sky-600 hover:text-sky-400" title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.book-clubs.destroy', $bookClub) }}" method="POST" class="inline" x-data @submit.prevent="if(confirm('Are you sure you want to delete this book club?')) { $el.submit(); }">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-400" title="Delete">
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
                                            <p>No book clubs found.</p>
                                            <a href="{{ route('admin.book-clubs.create') }}" class="mt-4 inline-block text-amber-500 hover:text-amber-400">Add your first book club</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($bookClubs->hasPages())
                        <div class="mt-6">{{ $bookClubs->appends(['search' => request('search')])->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
