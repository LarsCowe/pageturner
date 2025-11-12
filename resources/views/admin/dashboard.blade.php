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
                            <div class="text-3xl font-bold text-green-600">{{ \App\Models\Book::count() }}</div>
                            <div class="text-gray-600 mt-2">Books in Library</div>
                        </div>
                        
                        <div class="bg-yellow-50 p-6 rounded-lg">
                            <div class="text-3xl font-bold text-yellow-600">{{ \App\Models\BookClub::count() }}</div>
                            <div class="text-gray-600 mt-2">Book Clubs</div>
                        </div>

                        <div class="bg-purple-50 p-6 rounded-lg">
                            <div class="text-3xl font-bold text-purple-600">{{ \App\Models\NewsItem::count() }}</div>
                            <div class="text-gray-600 mt-2">News Items</div>
                        </div>

                        <div class="bg-pink-50 p-6 rounded-lg">
                            <div class="text-3xl font-bold text-pink-600">{{ \App\Models\Genre::count() }}</div>
                            <div class="text-gray-600 mt-2">Genres</div>
                        </div>

                        <div class="bg-blue-50 p-6 rounded-lg">
                            <div class="text-3xl font-bold text-blue-600">{{ \App\Models\Mood::count() }}</div>
                            <div class="text-gray-600 mt-2">Moods</div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-lg font-semibold mb-4">Database Overview</h4>
                        <div class="space-y-2">
                            <p class="text-gray-600">✅ Authentication system with admin roles</p>
                            <p class="text-gray-600">✅ {{ \App\Models\Book::count() }} books with genres and moods</p>
                            <p class="text-gray-600">✅ {{ \App\Models\FaqCategory::count() }} FAQ categories with {{ \App\Models\FaqItem::count() }} items</p>
                            <p class="text-gray-600">✅ {{ \App\Models\NewsItem::count() }} news items published</p>
                            <p class="text-gray-600">✅ {{ \App\Models\BookClub::count() }} book clubs created</p>
                            <p class="text-gray-600">✅ Many-to-many relationships (Books ↔ Genres, Books ↔ Moods, Users ↔ Books, Users ↔ BookClubs)</p>
                            <p class="text-gray-600">✅ One-to-many relationships (Users → Reviews, Books → Reviews, Categories → FAQs)</p>
                        </div>
                        
                        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded">
                            <h5 class="font-semibold text-blue-900 mb-2">🎯 Next Steps:</h5>
                            <ul class="list-disc list-inside text-blue-800 space-y-1">
                                <li>Create controllers and views for Books, News, FAQ</li>
                                <li>Implement search and filtering functionality</li>
                                <li>Build book club management system</li>
                                <li>Add contact form with email notifications</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
