<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-stone-100 leading-tight font-serif">
                {{ __('User Management') }}
            </h2>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-500 transition shadow-lg shadow-amber-900/20">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create New User
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-900 border border-stone-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Filters -->
                    <div class="mb-6 flex gap-4">
                        <form method="GET" action="{{ route('admin.users.index') }}" class="flex gap-4 flex-1">
                            <input type="text" 
                                   name="search" 
                                   placeholder="Search by name, email, or username..." 
                                   value="{{ request('search') }}"
                                   class="flex-1 rounded-lg border-stone-700 bg-stone-950 text-stone-100 placeholder-stone-500 focus:border-amber-500 focus:ring-amber-500">
                            
                            <select name="role" 
                                    class="rounded-lg border-stone-700 bg-stone-950 text-stone-100 focus:border-amber-500 focus:ring-amber-500">
                                <option value="">All Roles</option>
                                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admins</option>
                                <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>Regular Users</option>
                            </select>
                            
                            <button type="submit" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-500 transition shadow-md shadow-amber-900/20">
                                Filter
                            </button>
                            
                            @if(request('search') || request('role'))
                                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-stone-800 text-stone-300 rounded-lg hover:bg-stone-700 border border-stone-700">
                                    Clear
                                </a>
                            @endif
                        </form>
                    </div>

                    <!-- Users Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-stone-800">
                            <thead class="bg-stone-950">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                        User
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                        Username
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-stone-400 uppercase tracking-wider">
                                        Joined
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-stone-400 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-stone-900 divide-y divide-stone-800">
                                @forelse($users as $user)
                                    <tr class="hover:bg-stone-800/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    @if($user->avatar)
                                                        <img class="h-10 w-10 rounded-full object-cover ring-2 ring-stone-800" src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}">
                                                    @else
                                                        <div class="h-10 w-10 rounded-full bg-stone-800 flex items-center justify-center ring-2 ring-stone-800">
                                                            <span class="text-sm font-semibold text-amber-500">
                                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-stone-200">{{ $user->name }}</div>
                                                    <div class="text-sm text-stone-500">{{ $user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-stone-300">{{ $user->username ?? '-' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($user->is_admin)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-fuchsia-900/30 text-fuchsia-400 border border-fuchsia-800">
                                                    Admin
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-stone-800 text-stone-400 border border-stone-700">
                                                    User
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-500">
                                            {{ $user->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                @if($user->id !== auth()->id())
                                                    <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" 
                                                                class="px-3 py-1 {{ $user->is_admin ? 'bg-amber-900/30 text-amber-500 hover:bg-amber-900/50 border border-amber-800' : 'bg-emerald-900/30 text-emerald-500 hover:bg-emerald-900/50 border border-emerald-800' }} rounded transition"
                                                                onclick="return confirm('Are you sure you want to {{ $user->is_admin ? 'demote' : 'promote' }} this user?')">
                                                            {{ $user->is_admin ? 'Demote' : 'Promote' }}
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                <a href="{{ route('admin.users.edit', $user) }}" 
                                                   class="px-3 py-1 bg-sky-900/30 text-sky-500 border border-sky-800 rounded hover:bg-sky-900/50 transition">
                                                    Edit
                                                </a>
                                                
                                                @if($user->id !== auth()->id())
                                                    <form action="{{ route('admin.users.destroy', $user) }}" 
                                                          method="POST" 
                                                          class="inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-3 py-1 bg-red-900/30 text-red-500 border border-red-800 rounded hover:bg-red-900/50 transition">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-stone-500">
                                            <svg class="mx-auto h-12 w-12 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            <h3 class="mt-2 text-sm font-medium text-stone-300">No users found</h3>
                                            <p class="mt-1 text-sm text-stone-500">Try adjusting your search or filter criteria.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
