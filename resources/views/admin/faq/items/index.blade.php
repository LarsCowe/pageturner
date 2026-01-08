<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-stone-100 leading-tight font-serif">
                {{ __('FAQ Items') }}
            </h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2 text-sm text-stone-500">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-amber-500 transition-colors">Admin</a>
                    </li>
                    <li>/</li>
                    <li>FAQ Items</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Actions -->
            <div class="mb-6 flex justify-end">
                <a href="{{ route('admin.faq.items.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-amber-600 text-white text-sm font-medium rounded-lg hover:bg-amber-500 transition shadow-lg shadow-amber-900/20">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    New Question
                </a>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 bg-emerald-900/30 border border-emerald-800 text-emerald-300 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filters -->
            <div class="mb-6 bg-stone-900 rounded-xl shadow-sm border border-stone-800 p-6">
                <form method="GET" action="{{ route('admin.faq.items.index') }}" class="flex gap-4">
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-stone-300 mb-2">
                            Search
                        </label>
                        <input type="text" 
                               id="search"
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Search in questions or answers..."
                               class="w-full px-4 py-2 border border-stone-700 bg-stone-950 text-stone-100 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-stone-500">
                    </div>
                    
                    <div class="w-64">
                        <label for="category" class="block text-sm font-medium text-stone-300 mb-2">
                            Category
                        </label>
                        <select id="category"
                                name="category" 
                                class="w-full px-4 py-2 border border-stone-700 bg-stone-950 text-stone-100 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                            <option value="">All Categories</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="self-end">
                        <button type="submit" class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-500 transition shadow-md shadow-amber-900/20">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Items Table -->
            <div class="bg-stone-900 rounded-xl shadow-sm border border-stone-800 overflow-hidden">
                @if ($items->count() > 0)
                    <table class="min-w-full divide-y divide-stone-800">
                        <thead class="bg-stone-950">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                    Question
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                    Category
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                    Order
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-stone-400 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-stone-900 divide-y divide-stone-800">
                            @foreach ($items as $item)
                                <tr class="hover:bg-stone-800/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-stone-200">{{ $item->question }}</div>
                                        <div class="text-sm text-stone-500 mt-1 line-clamp-2">{{ Str::limit($item->answer, 100) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-sky-900/30 text-sky-400 border border-sky-800">
                                            {{ $item->category->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-300">
                                        {{ $item->order }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.faq.items.edit', $item->id) }}" 
                                               class="px-3 py-1 bg-sky-900/30 text-sky-500 border border-sky-800 rounded hover:bg-sky-900/50 transition">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.faq.items.destroy', $item->id) }}" 
                                                  method="POST" 
                                                  class="inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this FAQ item?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-red-900/30 text-red-500 border border-red-800 rounded hover:bg-red-900/50 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-stone-800">
                        {{ $items->links() }}
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-stone-300">No FAQ items found</h3>
                        <p class="mt-2 text-sm text-stone-500">
                            @if(request('search') || request('category'))
                                Try adjusting your filters or search query.
                            @else
                                Get started by creating your first FAQ item.
                            @endif
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
