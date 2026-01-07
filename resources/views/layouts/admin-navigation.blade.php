<nav x-data="{ open: false }" class="bg-stone-900 border-b border-stone-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-stone-100 font-serif font-bold text-xl tracking-wider">
                        PageTurner <span class="text-amber-600">Admin</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.dashboard') ? 'border-amber-500 text-amber-500' : 'border-transparent text-stone-400 hover:text-stone-100 hover:border-amber-500' }} text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out">
                        {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('admin.books.index') }}" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.books.*') ? 'border-amber-500 text-amber-500' : 'border-transparent text-stone-400 hover:text-stone-100 hover:border-amber-500' }} text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out">
                        {{ __('Books') }}
                    </a>
                    <a href="{{ route('admin.news.index') }}" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.news.*') ? 'border-amber-500 text-amber-500' : 'border-transparent text-stone-400 hover:text-stone-100 hover:border-amber-500' }} text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out">
                        {{ __('News') }}
                    </a>
                    
                    <a href="{{ route('admin.users.index') }}" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.users.*') ? 'border-amber-500 text-amber-500' : 'border-transparent text-stone-400 hover:text-stone-100 hover:border-amber-500' }} text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out">
                        {{ __('Users') }}
                    </a>
                    
                    <a href="{{ route('admin.book-clubs.index') }}" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.book-clubs.*') ? 'border-amber-500 text-amber-500' : 'border-transparent text-stone-400 hover:text-stone-100 hover:border-amber-500' }} text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out">
                        {{ __('Book Clubs') }}
                    </a>
                    
                    <!-- FAQ Dropdown -->
                    <div class="relative flex items-center" x-data="{ faqOpen: false }">
                        <button @click="faqOpen = !faqOpen" 
                                class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.faq.*') ? 'border-amber-500 text-amber-500' : 'border-transparent text-stone-400 hover:text-stone-100 hover:border-amber-500' }} text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out h-full">
                            {{ __('FAQ') }}
                            <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="faqOpen" 
                             @click.away="faqOpen = false"
                             x-transition
                             style="display: none;"
                             class="absolute left-0 top-14 w-48 rounded-md shadow-lg bg-stone-800 ring-1 ring-black ring-opacity-5 z-50 border border-stone-700">
                            <div class="py-1">
                                <a href="{{ route('admin.faq.categories.index') }}" 
                                   class="block px-4 py-2 text-sm text-stone-300 hover:bg-stone-700 hover:text-amber-500">
                                    Categories
                                </a>
                                <a href="{{ route('admin.faq.items.index') }}" 
                                   class="block px-4 py-2 text-sm text-stone-300 hover:bg-stone-700 hover:text-amber-500">
                                    FAQ Items
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Custom Dropdown implementation -->
                <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                    <div @click="open = ! open">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-stone-300 hover:text-white focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }} (Admin)</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </div>

                    <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0"
                            style="display: none;"
                            @click="open = false">
                        <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-stone-800 border border-stone-700">
                            <a href="{{ route('dashboard') }}" class="block w-full px-4 py-2 text-start text-sm leading-5 text-stone-300 hover:bg-stone-700 hover:text-amber-500 focus:outline-none transition duration-150 ease-in-out">
                                {{ __('User Dashboard') }}
                            </a>
                            
                            <a href="{{ route('profile.edit') }}" class="block w-full px-4 py-2 text-start text-sm leading-5 text-stone-300 hover:bg-stone-700 hover:text-amber-500 focus:outline-none transition duration-150 ease-in-out">
                                {{ __('Profile') }}
                            </a>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="{{ route('logout') }}" 
                                   onclick="event.preventDefault(); this.closest('form').submit();"
                                   class="block w-full px-4 py-2 text-start text-sm leading-5 text-stone-300 hover:bg-stone-700 hover:text-amber-500 focus:outline-none transition duration-150 ease-in-out">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-stone-400 hover:text-stone-100 hover:bg-stone-800 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-stone-900 border-t border-stone-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.books.index')" :active="request()->routeIs('admin.books.*')">
                {{ __('Books') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.news.index')" :active="request()->routeIs('admin.news.*')">
                {{ __('News') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                {{ __('Users') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.book-clubs.index')" :active="request()->routeIs('admin.book-clubs.*')">
                {{ __('Book Clubs') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.faq.categories.index')" :active="request()->routeIs('admin.faq.*')">
                {{ __('FAQ') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-stone-800">
            <div class="px-4">
                <div class="font-medium text-base text-stone-100">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-stone-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')">
                    {{ __('User Dashboard') }}
                </x-responsive-nav-link>
                
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
