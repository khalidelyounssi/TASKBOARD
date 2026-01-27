<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TaskBoard Premium</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-indigo-50 via-white to-purple-100 min-h-screen font-sans antialiased overflow-hidden">

    <nav class="absolute top-0 w-full p-6 flex justify-between items-center z-50 animate-fade-in-down">
        <a href="/" class="text-2xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 flex items-center gap-2 hover:scale-105 transition-transform">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
            </svg>
            <span>TaskBoard</span>
        </a>
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="px-6 py-3 bg-white/80 backdrop-blur-md border border-indigo-100 text-indigo-600 font-semibold rounded-full hover:bg-indigo-50 hover:shadow-lg transition-all duration-300 active:scale-95">
                Sign In
            </a>
        </div>
    </nav>

    <div class="min-h-screen flex">
        
        <div class="hidden lg:block w-1/2 relative overflow-hidden">
             <div class="absolute inset-0 bg-cover bg-center animate-zoom-slow" 
                  style="background-image: url('https://images.unsplash.com/photo-1634092753776-78092da5a179?q=80&w=2070&auto=format&fit=crop');">
            </div>
             <div class="absolute inset-0 bg-gradient-to-t from-indigo-900/80 to-purple-900/40 mix-blend-multiply"></div>
            
            <div class="absolute bottom-0 left-0 p-16 text-white z-20 animate-fade-in-up delay-300">
                <h1 class="text-5xl font-extrabold mb-4 leading-tight">Start Your Journey.</h1>
                <p class="text-xl text-indigo-100 max-w-md">Join thousands of users organizing their life with TaskBoard.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center px-8 relative py-20 lg:py-0">
            
            <div class="w-full max-w-[450px] bg-white/70 backdrop-blur-xl p-10 rounded-3xl shadow-2xl shadow-indigo-500/10 border border-white/50 animate-fade-in-up delay-150 z-10 mt-16 lg:mt-0">
                
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-bold text-gray-800">Create Account</h2>
                    <p class="text-gray-500 mt-2">It's free and takes less than a minute</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div class="group">
                         <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 ml-1 transition-colors group-focus-within:text-indigo-600">Full Name</label>
                        <div class="relative">
                              <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                             </span>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                   class="w-full pl-12 pr-4 py-3.5 bg-white/50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all duration-300 hover:border-indigo-300"
                                   placeholder="John Doe">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="group">
                         <label for="email" class="block text-sm font-semibold text-gray-700 mb-2 ml-1 transition-colors group-focus-within:text-indigo-600">Email Address</label>
                        <div class="relative">
                              <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" /><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" /></svg>
                             </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full pl-12 pr-4 py-3.5 bg-white/50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all duration-300 hover:border-indigo-300"
                                   placeholder="name@company.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="group">
                         <label for="password" class="block text-sm font-semibold text-gray-700 mb-2 ml-1 transition-colors group-focus-within:text-indigo-600">Password</label>
                        <div class="relative">
                              <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                             </span>
                            <input id="password" type="password" name="password" required
                                   class="w-full pl-12 pr-4 py-3.5 bg-white/50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all duration-300 hover:border-indigo-300"
                                   placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="group">
                         <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2 ml-1 transition-colors group-focus-within:text-indigo-600">Confirm Password</label>
                        <div class="relative">
                              <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                             </span>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                   class="w-full pl-12 pr-4 py-3.5 bg-white/50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all duration-300 hover:border-indigo-300"
                                   placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 hover:scale-[1.02] active:scale-95 transition-all duration-300">
                        Create Account
                    </button>
                </form>
            </div>

             <div class="absolute bottom-8 text-center text-sm text-gray-500 animate-fade-in-up delay-500 lg:w-[450px]">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-800 transition-colors ml-1">Log in</a>
            </div>
        </div>
    </div>
</body>
</html>