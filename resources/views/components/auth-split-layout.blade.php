<!-- Final Build Trigger: 2026-04-27 22:38 -->
<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ 
    darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) 
}" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NexoraByte') }} - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }

        .login-bg {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
            background-size: 400% 400%;
            animation: gradient-animation 15s ease infinite;
        }
        .dark .login-bg {
            background: linear-gradient(135deg, #312e81 0%, #581c87 50%, #831843 100%);
            background-size: 400% 400%;
            animation: gradient-animation 15s ease infinite;
        }
        @keyframes gradient-animation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .mesh-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2v-4h4v-2h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2v-4h4v-2H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="antialiased font-['Inter'] overflow-hidden no-scrollbar login-bg min-h-screen transition-colors duration-500">
    <!-- Theme Toggle -->
    <div class="fixed top-8 right-8 z-[100]">
        <button @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light')" 
            class="p-3 rounded-2xl bg-white/20 backdrop-blur-xl border border-white/30 text-white shadow-xl hover:scale-110 transition-all active:scale-95 group">
            <template x-if="!darkMode">
                <svg class="h-6 w-6 text-amber-400 group-hover:rotate-90 transition-transform duration-500" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zM2 13h2c.55 0 1-.45 1-1s-.45-1-1-1H2c-.55 0-1 .45-1 1s.45 1 1 1zm18 0h2c.55 0 1-.45 1-1s-.45-1-1-1h-2c-.55 0-1 .45-1 1s.45 1 1 1zM11 2v2c0 .55.45 1 1 1s1-.45 1-1V2c0-.55-.45-1-1-1s-1 .45-1 1zm0 18v2c0 .55.45 1 1 1s1-.45 1-1v-2c0-.55-.45-1-1-1s-1 .45-1 1zM5.99 4.58a.996.996 0 00-1.41 0 .996.996 0 000 1.41l1.06 1.06c.39.39 1.03.39 1.41 0s.39-1.03 0-1.41L5.99 4.58zm12.37 12.37a.996.996 0 00-1.41 0 .996.996 0 000 1.41l1.06 1.06c.39.39 1.03.39 1.41 0s.39-1.03 0-1.41l-1.06-1.06zm1.06-10.96a.996.996 0 00-1.41 0l-1.06 1.06c-.39.39-.39 1.03 0 1.41s1.03.39 1.41 0l1.06-1.06a.996.996 0 000-1.41zM7.05 18.36a.996.996 0 00-1.41 0l-1.06 1.06c-.39.39-.39 1.03 0 1.41s1.03.39 1.41 0l1.06-1.06a.996.996 0 000-1.41z"/>
                </svg>
            </template>
            <template x-if="darkMode">
                <svg class="h-6 w-6 text-indigo-200 group-hover:-rotate-12 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </template>
        </button>
    </div>

    <div class="fixed inset-0 mesh-pattern pointer-events-none opacity-30"></div>
    <div class="min-h-screen flex items-center justify-center p-4 lg:p-8 relative z-10">
        {{ $slot }}
    </div>
</body>
</html>
