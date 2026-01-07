<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-stone-100 mb-3 font-serif">Get in Touch</h1>
                <p class="text-stone-400 text-lg">
                    Have a question or feedback? Fill out the form below and we'd love to hear from you.
                </p>
            </div>

            <!-- Contact Form Card -->
            <div class="bg-stone-900 rounded-xl shadow-sm border border-stone-800 overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                        @csrf

                        <!-- Name and Email Row -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-stone-300 mb-2">
                                    Name
                                </label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    value="{{ old('name') }}"
                                    required
                                    maxlength="255"
                                    class="w-full px-4 py-3 bg-stone-950 border border-stone-800 text-stone-100 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition placeholder-stone-600 @error('name') border-red-500 @enderror"
                                    placeholder="Enter your name">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-stone-300 mb-2">
                                    Email Address
                                </label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    value="{{ old('email') }}"
                                    required
                                    maxlength="255"
                                    class="w-full px-4 py-3 bg-stone-950 border border-stone-800 text-stone-100 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition placeholder-stone-600 @error('email') border-red-500 @enderror"
                                    placeholder="Enter your email address">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Subject -->
                        <div>
                            <label for="subject" class="block text-sm font-medium text-stone-300 mb-2">
                                Subject
                            </label>
                            <input 
                                type="text" 
                                name="subject" 
                                id="subject" 
                                value="{{ old('subject') }}"
                                required
                                maxlength="255"
                                class="w-full px-4 py-3 bg-stone-950 border border-stone-800 text-stone-100 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition placeholder-stone-600 @error('subject') border-red-500 @enderror"
                                placeholder="What is this about?">
                            @error('subject')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-stone-300 mb-2">
                                Your Message
                            </label>
                            <textarea 
                                name="message" 
                                id="message" 
                                rows="6"
                                required
                                maxlength="5000"
                                class="w-full px-4 py-3 bg-stone-950 border border-stone-800 text-stone-100 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition resize-none placeholder-stone-600 @error('message') border-red-500 @enderror"
                                placeholder="Tell us more...">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button 
                                type="submit" 
                                class="w-full px-6 py-3 bg-amber-600 hover:bg-amber-500 text-white font-semibold rounded-lg transition duration-200 shadow-lg shadow-amber-900/20">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
