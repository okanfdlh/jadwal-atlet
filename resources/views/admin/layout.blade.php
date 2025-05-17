<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard | IoT Fitness')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#4f46e5',  // indigo-600
                        secondary: '#9333ea', // purple-600
                        bgLight: '#f3f4f6', // gray-100
                        sidebar: '#4f46e5'  // indigo-600
                    }
                }
            }
        }
    </script>

    <!-- Scrollbar Styling -->
    <style>
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #e5e7eb;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #9333ea;
            border-radius: 5px;
        }
        html, body {
            height: 100%;
        }
    </style>
</head>
<body class="bg-bgLight min-h-screen flex text-gray-800 font-inter">

    <!-- Sidebar -->
    <aside class="w-64 min-h-screen bg-gradient-to-b from-primary to-blue-400 text-white p-6 shadow-xl sticky top-0">
        <h1 class="text-2xl font-bold text-center mb-10 tracking-wide"> IoT Fitness</h1>

        <nav class="grid gap-5">
            <!-- Card Chinning Up -->
            <a href="{{ route('chinning') }}"
               class="bg-gradient-to-r from-indigo-500 to-indigo-300 text-white rounded-xl p-4 shadow-md hover:shadow-xl transition duration-300 flex items-center space-x-3">
                <div class="text-2xl">🤸‍♀️</div>
                <div class="font-semibold">Chinning Up</div>
            </a>

            <!-- Card Pull Up -->
            <a href="{{ route('pullup.index') }}"
               class="bg-gradient-to-r from-purple-500 to-purple-300 text-white rounded-xl p-4 shadow-md hover:shadow-xl transition duration-300 flex items-center space-x-3">
                <div class="text-2xl">🤸‍♂️</div>
                <div class="font-semibold">Pull Up</div>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <!-- Main Content -->
<main class="flex-1 p-8 overflow-y-auto">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-blue-800 drop-shadow">👨‍🏫 Dashboard Pengawas</h2>
            <p class="text-gray-600 mt-1 text-lg">Formulir Input & Analisis Data Atlet</p>
        </div>

        <!-- Tombol Logout -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 11-6 0v-1m0-8v1a3 3 0 006 0V7" />
                </svg>
                Logout
            </button>
        </form>
    </div>

    <!-- Konten halaman -->
    <div class="bg-white p-6 rounded-lg shadow">
        @yield('content')
    </div>
</main>


</body>
</html>
