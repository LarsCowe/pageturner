<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-xl overflow-hidden">
                <!-- Header -->
                <div class="px-8 py-6 border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-900">Edit Profile</h1>
                </div>

                <!-- Profile Information Form -->
                <div class="px-8 py-6">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password Section -->
            <div class="mt-6 bg-white shadow-sm sm:rounded-xl overflow-hidden">
                <div class="px-8 py-6">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="mt-6 bg-white shadow-sm sm:rounded-xl overflow-hidden">
                <div class="px-8 py-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
