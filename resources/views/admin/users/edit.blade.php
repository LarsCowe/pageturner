<x-admin-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="flex items-center text-sm mb-6">
                <a href="{{ route('admin.dashboard') }}" class="text-stone-500 hover:text-amber-500 transition-colors">Admin</a>
                <span class="text-stone-600 mx-2">/</span>
                <a href="{{ route('admin.users.index') }}" class="text-stone-500 hover:text-amber-500 transition-colors">Users</a>
                <span class="text-stone-600 mx-2">/</span>
                <span class="text-stone-200 font-medium">Edit User</span>
            </div>

            <div class="bg-stone-900 border border-stone-800 rounded-lg shadow-sm overflow-hidden">
                <div class="p-8">
                    <h1 class="text-2xl font-bold text-stone-100 mb-2 font-serif">Edit User: {{ $user->name }}</h1>
                    <p class="text-stone-400 mb-6">Update user account information.</p>

                    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-stone-300 mb-2">Name <span class="text-amber-500">*</span></label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $user->name) }}"
                                   required
                                   class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 placeholder-stone-500 focus:border-amber-500 focus:ring-amber-500 @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-stone-300 mb-2">Username</label>
                            <input type="text" 
                                   name="username" 
                                   id="username" 
                                   value="{{ old('username', $user->username) }}"
                                   class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 placeholder-stone-500 focus:border-amber-500 focus:ring-amber-500 @error('username') border-red-500 @enderror">
                            @error('username')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-stone-300 mb-2">Email <span class="text-amber-500">*</span></label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email', $user->email) }}"
                                   required
                                   class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 placeholder-stone-500 focus:border-amber-500 focus:ring-amber-500 @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-stone-300 mb-2">New Password</label>
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 placeholder-stone-500 focus:border-amber-500 focus:ring-amber-500 @error('password') border-red-500 @enderror">
                            <p class="mt-1 text-sm text-stone-500">Leave blank to keep current password</p>
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-stone-300 mb-2">Confirm New Password</label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation" 
                                   class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 placeholder-stone-500 focus:border-amber-500 focus:ring-amber-500">
                        </div>

                        <!-- Birthday -->
                        <div>
                            <label for="birthday" class="block text-sm font-medium text-stone-300 mb-2">Birthday</label>
                            <input type="date" 
                                   name="birthday" 
                                   id="birthday" 
                                   value="{{ old('birthday', $user->birthday?->format('Y-m-d')) }}"
                                   class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 placeholder-stone-500 focus:border-amber-500 focus:ring-amber-500 @error('birthday') border-red-500 @enderror">
                            @error('birthday')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bio -->
                        <div>
                            <label for="bio" class="block text-sm font-medium text-stone-300 mb-2">Bio</label>
                            <textarea name="bio" 
                                      id="bio" 
                                      rows="4"
                                      class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 placeholder-stone-500 focus:border-amber-500 focus:ring-amber-500 @error('bio') border-red-500 @enderror">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Admin Status Info -->
                        <div class="bg-stone-950 border border-stone-800 p-4 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-stone-200">Admin Status</p>
                                    <p class="text-sm text-stone-500">
                                        This user is currently {{ $user->is_admin ? 'an administrator' : 'a regular user' }}
                                    </p>
                                </div>
                                @if($user->id !== auth()->id())
                                    <a href="#" 
                                       onclick="event.preventDefault(); if(confirm('Are you sure you want to {{ $user->is_admin ? 'demote' : 'promote' }} this user?')) { document.getElementById('toggle-admin-form-{{ $user->id }}').submit(); }"
                                       class="px-4 py-2 {{ $user->is_admin ? 'bg-amber-900/30 text-amber-500 hover:bg-amber-900/50 border border-amber-800' : 'bg-emerald-900/30 text-emerald-500 hover:bg-emerald-900/50 border border-emerald-800' }} rounded-lg transition inline-block">
                                        {{ $user->is_admin ? 'Demote to User' : 'Promote to Admin' }}
                                    </a>
                                @else
                                    <span class="text-sm text-stone-500 italic">You cannot change your own status</span>
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end gap-4 pt-6 border-t border-stone-800">
                            <a href="{{ route('admin.users.index') }}" 
                               class="px-6 py-2 border border-stone-700 rounded-lg text-stone-400 hover:bg-stone-800 transition">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-500 transition shadow-lg shadow-amber-900/20">
                                Update User
                            </button>
                        </div>
                    </form>

                    @if($user->id !== auth()->id())
                        <!-- Separate form for toggle admin (outside main form) -->
                        <form id="toggle-admin-form-{{ $user->id }}" 
                              action="{{ route('admin.users.toggle-admin', $user) }}" 
                              method="POST" 
                              class="hidden">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
