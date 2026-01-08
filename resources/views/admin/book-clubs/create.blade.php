<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-stone-100 leading-tight font-serif">
            {{ __('Create New Book Club') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-900 border border-stone-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.book-clubs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div class="md:col-span-2">
                                <label for="name" class="block text-sm font-medium text-stone-300 mb-2">
                                    Name <span class="text-amber-500">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name') }}"
                                       required
                                       class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 placeholder-stone-500 focus:border-amber-500 focus:ring-amber-500">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Creator -->
                            <div class="md:col-span-2">
                                <label for="creator_id" class="block text-sm font-medium text-stone-300 mb-2">
                                    Creator <span class="text-amber-500">*</span>
                                </label>
                                <select name="creator_id" 
                                        id="creator_id" 
                                        required
                                        class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 focus:border-amber-500 focus:ring-amber-500">
                                    <option value="">-- Select a creator --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('creator_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('creator_id')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-stone-300 mb-2">
                                    Description
                                </label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="5"
                                          class="w-full rounded-lg border-stone-700 bg-stone-950 text-stone-100 placeholder-stone-500 focus:border-amber-500 focus:ring-amber-500">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Image -->
                            <div class="md:col-span-2">
                                <label for="image" class="block text-sm font-medium text-stone-300 mb-2">
                                    Image
                                </label>
                                <input type="file" 
                                       name="image" 
                                       id="image" 
                                       accept="image/jpeg,image/jpg,image/png,image/webp"
                                       class="w-full text-stone-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-stone-800 file:text-stone-300 hover:file:bg-stone-700 file:transition-colors">
                                <p class="mt-1 text-sm text-stone-500">Max 2MB. Accepted formats: JPEG, PNG, WebP</p>
                                @error('image')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Is Private -->
                            <div class="md:col-span-2">
                                <div class="flex items-center p-4 rounded-lg border border-stone-800 bg-stone-950/50">
                                    <input type="checkbox" 
                                           name="is_private" 
                                           value="1"
                                           {{ old('is_private') ? 'checked' : '' }}
                                           class="rounded border-stone-700 bg-stone-900 text-amber-600 focus:ring-amber-500 transition">
                                    <span class="ml-3 text-sm text-stone-300">Private book club (only members can see)</span>
                                </div>
                                @error('is_private')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between mt-6 pt-6 border-t border-stone-800">
                            <a href="{{ route('admin.book-clubs.index') }}" 
                               class="px-4 py-2 text-stone-400 hover:bg-stone-800 rounded-lg transition border border-transparent hover:border-stone-700">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-500 transition shadow-lg shadow-amber-900/20">
                                Create Book Club
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
