<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Welcome to PageTurner Admin Panel! 📚</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <!-- Stats Card -->
                        <div class="bg-indigo-50 p-6 rounded-lg">
                            <div class="text-3xl font-bold text-indigo-600">{{ \App\Models\User::count() }}</div>
                            <div class="text-gray-600 mt-2">Total Users</div>
                        </div>
                        
                        <div class="bg-green-50 p-6 rounded-lg">
                            <div class="text-3xl font-bold text-green-600">{{ \App\Models\User::where('is_admin', true)->count() }}</div>
                            <div class="text-gray-600 mt-2">Admin Users</div>
                        </div>
                        
                        <div class="bg-yellow-50 p-6 rounded-lg">
                            <div class="text-3xl font-bold text-yellow-600">0</div>
                            <div class="text-gray-600 mt-2">Books</div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-lg font-semibold mb-4">Quick Actions</h4>
                        <div class="space-y-2">
                            <p class="text-gray-600">✅ Authentication system is set up</p>
                            <p class="text-gray-600">✅ Admin middleware is working</p>
                            <p class="text-gray-600">✅ Default admin account created (admin@ehb.be)</p>
                            <p class="text-gray-600">⏳ Next: Create Book models and database structure</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
