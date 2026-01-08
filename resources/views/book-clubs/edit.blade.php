<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Back Link -->
            <div class="mb-6">
                <a href="{{ route('book-clubs.show', $bookClub) }}" 
                   class="inline-flex items-center text-stone-400 hover:text-amber-500 font-medium transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to {{ $bookClub->name }}
                </a>
            </div>

            <div class="bg-stone-900 rounded-lg shadow-sm p-8 border border-stone-800">
                <h2 class="text-3xl font-bold font-serif text-stone-100 mb-6">Edit Book Club</h2>

                <form action="{{ route('book-clubs.update', $bookClub) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- Name -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-bold text-stone-300 mb-2">
                            Club Name <span class="text-amber-500">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name', $bookClub->name) }}"
                               required
                               class="w-full px-4 py-3 bg-stone-950 border border-stone-700 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-stone-100 placeholder-stone-600">
                        @error('name')
                            <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-bold text-stone-300 mb-2">
                            Description <span class="text-amber-500">*</span>
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="6"
                                  required
                                  class="w-full px-4 py-3 bg-stone-950 border border-stone-700 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-stone-100 placeholder-stone-600 resize-none leading-relaxed">{{ old('description', $bookClub->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between pt-6 border-t border-stone-800">
                        <a href="{{ route('book-clubs.show', $bookClub) }}" 
                           class="px-6 py-2 text-stone-400 hover:text-stone-200 hover:bg-stone-800 rounded-lg transition font-medium">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-8 py-3 bg-amber-600 text-stone-900 font-bold rounded-lg hover:bg-amber-500 transition shadow-lg">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
