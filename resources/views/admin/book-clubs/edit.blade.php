<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Book Club') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.book-clubs.update', $bookClub) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div class="md:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name', $bookClub->name) }}"
                                       required
                                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Creator -->
                            <div class="md:col-span-2">
                                <label for="creator_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Creator <span class="text-red-500">*</span>
                                </label>
                                <select name="creator_id" 
                                        id="creator_id" 
                                        required
                                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('creator_id', $bookClub->creator_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('creator_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Description
                                </label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="5"
                                          class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $bookClub->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Current Image -->
                            @if($bookClub->image)
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Current Image
                                    </label>
                                    <img src="{{ Storage::url($bookClub->image) }}" 
                                         alt="{{ $bookClub->name }}"
                                         class="w-32 h-32 object-cover rounded">
                                </div>
                            @endif

                            <!-- Image -->
                            <div class="md:col-span-2">
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ $bookClub->image ? 'Replace Image' : 'Image' }}
                                </label>
                                <input type="file" 
                                       name="image" 
                                       id="image" 
                                       accept="image/jpeg,image/jpg,image/png,image/webp"
                                       class="w-full">
                                <p class="mt-1 text-sm text-gray-500">Max 2MB. Accepted formats: JPEG, PNG, WebP</p>
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Is Private -->
                            <div class="md:col-span-2">
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           name="is_private" 
                                           value="1"
                                           {{ old('is_private', $bookClub->is_private) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-700">Private book club (only members can see)</span>
                                </label>
                                @error('is_private')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between mt-6 pt-6 border-t">
                            <a href="{{ route('admin.book-clubs.index') }}" 
                               class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                Update Book Club
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
