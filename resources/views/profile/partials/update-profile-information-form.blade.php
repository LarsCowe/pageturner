<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Avatar Upload Section -->
        <div class="flex items-start gap-6 pb-6 border-b border-gray-200">
            <div class="flex-shrink-0">
                @if($user->avatar)
                    <img src="{{ Storage::url($user->avatar) }}" alt="Current avatar" class="w-20 h-20 rounded-full object-cover border-2 border-gray-200">
                @else
                    <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-2xl font-semibold text-gray-500">
                            {{ strtoupper(substr($user->username ?? $user->name, 0, 1)) }}
                        </span>
                    </div>
                @endif
            </div>
            <div class="flex-grow">
                <h3 class="text-base font-semibold text-gray-900">Profile Photo</h3>
                <p class="text-sm text-gray-500 mt-1">Upload a new photo.</p>
                <div class="mt-3">
                    <label for="avatar" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 cursor-pointer transition">
                        Upload
                    </label>
                    <input id="avatar" name="avatar" type="file" accept="image/*" class="hidden" />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            </div>
        </div>

        <!-- Form Fields -->
        <!-- Name (full width) -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-900 mb-2">Name</label>
            <input id="name" name="name" type="text" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                   value="{{ old('name', $user->name) }}" required />
            <x-input-error class="mt-1" :messages="$errors->get('name')" />
        </div>

        <!-- Email (full width) -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-900 mb-2">Email</label>
            <input id="email" name="email" type="email" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                   value="{{ old('email', $user->email) }}" required />
            <x-input-error class="mt-1" :messages="$errors->get('email')" />
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="text-sm mt-1 text-gray-600">
                    Your email address is unverified.
                    <button form="send-verification" class="underline text-blue-600 hover:text-blue-800">
                        Click here to re-send the verification email.
                    </button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-1 text-sm text-green-600">
                        A new verification link has been sent to your email address.
                    </p>
                @endif
            @endif
        </div>

        <div class="grid grid-cols-2 gap-6">
            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-900 mb-2">Username</label>
                <input id="username" name="username" type="text" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                       value="{{ old('username', $user->username) }}" />
                <x-input-error class="mt-1" :messages="$errors->get('username')" />
            </div>

            <!-- Birthday -->
            <div>
                <label for="birthday" class="block text-sm font-medium text-gray-900 mb-2">Birthday</label>
                <input id="birthday" name="birthday" type="date" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                       value="{{ old('birthday', $user->birthday?->format('Y-m-d')) }}" />
                <x-input-error class="mt-1" :messages="$errors->get('birthday')" />
            </div>
        </div>

        <!-- Bio -->
        <div>
            <label for="bio" class="block text-sm font-medium text-gray-900 mb-2">Bio</label>
            <textarea id="bio" name="bio" rows="4" 
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                      placeholder="A lifelong learner and book lover. Always looking for my next great adventure between the pages...">{{ old('bio', $user->bio) }}</textarea>
            <div class="flex justify-between items-center mt-1">
                <x-input-error :messages="$errors->get('bio')" />
                <span class="text-xs text-gray-500">{{ strlen($user->bio ?? '') }}/1000 characters</span>
            </div>
        </div>

        <!-- Favorite Genres -->
        <div>
            <label class="block text-sm font-medium text-gray-900 mb-3">Favorite Genres</label>
            <div class="flex flex-wrap gap-2">
                @foreach($genres as $genre)
                    @php
                        $isSelected = in_array($genre->id, old('favorite_genres', $user->favorite_genres ?? []));
                    @endphp
                    <label class="inline-flex items-center genre-tag">
                        <input type="checkbox" name="favorite_genres[]" value="{{ $genre->id }}" 
                               class="hidden genre-checkbox"
                               {{ $isSelected ? 'checked' : '' }}>
                        <span class="genre-label px-4 py-2 rounded-lg text-sm font-medium cursor-pointer transition">
                            {{ $genre->name }}
                            <span class="genre-x ml-1">×</span>
                        </span>
                    </label>
                @endforeach
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('favorite_genres')" />
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
            <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                Save Changes
            </button>
        </div>

        @if (session('status') === 'profile-updated')
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                 class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
                Profile updated successfully!
            </div>
        @endif
    </form>
</section>

<script>
    // Character counter for bio
    document.getElementById('bio').addEventListener('input', function() {
        const counter = this.nextElementSibling.querySelector('.text-xs');
        if (counter) {
            counter.textContent = this.value.length + '/1000 characters';
        }
    });

    // Genre tag styling and interaction
    document.addEventListener('DOMContentLoaded', function() {
        const genreTags = document.querySelectorAll('.genre-tag');
        
        // Update initial states
        function updateGenreStyles() {
            genreTags.forEach(tag => {
                const checkbox = tag.querySelector('.genre-checkbox');
                const label = tag.querySelector('.genre-label');
                const x = tag.querySelector('.genre-x');
                
                if (checkbox.checked) {
                    label.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                    label.classList.add('bg-blue-100', 'text-blue-700');
                    x.style.display = 'inline';
                } else {
                    label.classList.remove('bg-blue-100', 'text-blue-700');
                    label.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                    x.style.display = 'none';
                }
            });
        }
        
        // Initial update
        updateGenreStyles();
        
        // Add click handlers
        genreTags.forEach(tag => {
            const checkbox = tag.querySelector('.genre-checkbox');
            const label = tag.querySelector('.genre-label');
            
            label.addEventListener('click', function(e) {
                e.preventDefault();
                checkbox.checked = !checkbox.checked;
                updateGenreStyles();
            });
        });
    });
</script>
